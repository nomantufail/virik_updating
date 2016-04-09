<style>
    .calculation_sheet_table{
        font-size: 11px;
    }
    .calculation_sheet_heading_area{
        font-size: 15px;
        font-weight: bold;
        font-family: monospace;
    }

    .outer-table .outer-td {
        padding: 2px;
    }
</style>
<div id="page-wrapper" style="min-height: 700px;">
<div class="container-fluid">

<!--body of accounts-->
    <div class="row">

        <div class="col-lg-12">
            <?php echo validation_errors('<div class="alert alert-danger alert-dismissible" role="alert">

                                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

                                            <strong>Error! </strong>', '</div>');
            ?>

            <?php if(is_array($someMessage)){ ?>

                <div class="alert <?= $someMessage['type']; ?> alert-dismissible" role="alert">

                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

                    <?= $someMessage['message']; ?>

                </div>

            <?php } ?>

            <div class="row calculation_sheet_heading_area">
                LHW-123 (04 march 2016 , 04 april 2016)
            </div>

            <table>

            </table>
            <?php
                foreach($report['income'] as $tripId => $incomes){
            ?>
                    <table class="outer-table" border="1" style="margin-top: 10px; min-width: 1000px;">
                        <thead>
                        <tr>
                            <th class="outer-td" colspan="2" style="background-color: darkgray">
                                <?php
                                    echo Carbon::createFromFormat('Y-m-d',$incomes[0]->tripDate)->toFormattedDateString();

                                ?>
                            </th>
                        </tr>
                        <tr>
                            <th style="width: 50%;" class="outer-td">Expenses</th>
                            <th class="outer-td">Income</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $total_expense = 0;
                            $total_income = 0;
                        ?>
                            <tr>
                                <td class="outer-td">
                                    <table style="width: 100%;">
                                        <?php
                                        $expenses = [];
                                        if(isset($report['trips_expenses'][$tripId]))
                                            $expenses = $report['trips_expenses'][$tripId];

                                        foreach($expenses as $expense) {
                                            $total_expense+= $expense->amount;
                                            ?>
                                            <tr>
                                                <td><?= $expense->title ?></td>
                                                <td style="text-align: right"><?= $expense->amount ?></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                </td>
                                <td class="outer-td">
                                    <table style="width: 100%;">
                                        <?php
                                        foreach($incomes as $income) {
                                            $total_income+= $income->income
                                            ?>
                                            <tr>
                                                <td><?= $income->source." to ".$income->destination." (".$income->product.") " ?></td>
                                                <td style="text-align: right"><?= $income->income ?></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="outer-td" style="text-align: right;">
                                    <b><?= $total_expense ?></b>
                                </td>
                                <td class="outer-td" style="text-align: right">
                                    <b><?= $total_income ?></b>
                                </td>
                            </tr>
                        </tbody>
                    </table>
            <?php
                }
            ?>
        </div>
    </div>

</div>

</div>
