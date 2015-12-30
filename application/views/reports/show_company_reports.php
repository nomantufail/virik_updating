<style>    table{        font-size: 12px;    }</style><div id="page-wrapper" style="min-height: 700px;">    <div class="container-fluid">    <table class="table">    <tr style="color: green;">        <td colspan=>            <b>Date:</b> <?= $from_date ?> / <?= $to_date ?>        </td>        <td>            <b>Company:</b> <?= ucwords($company) ?>        </td>        <td>            <b>Customer:</b> <?= ucwords($customer) ?>        </td>        <td colspan=>            <b>Contractor:</b> <?= ucwords($contractor) ?>        </td>        <td colspan=>            <b>Tanker:</b> <?= $tanker ?>        </td>    </tr></table><?phpif(sizeof($reports) < 1){    echo "<span style='color: red;margin-left: 5px;'>No results found</span>";    die();}?>        <form name="selection_form" id="selection_form" method="post" action="<?php        if(strpos($this->helper_model->page_url(),'?') == false){            echo $this->helper_model->page_url()."?";        }else{echo $this->helper_model->page_url()."&";}        ?>print"><table class="table table-bordered report_table">    <thead class="">    <tr>        <th><input id="parent_checkbox" onchange="check_boxes();" type="checkbox" style="" checked></th>        <th><div><input id="" type="checkbox" name="column[]" value="date" style="" checked></div>Date</th>        <th><div><input id="" type="checkbox" name="column[]" value="tanker" style="" checked></div>Tanker</th>        <th><div><input id="" type="checkbox" name="column[]" value="customer" style="" checked></div>Customer</th>        <th><div><input id="" type="checkbox" name="column[]" value="route" style="" checked></div>Route</th>        <th><div><input id="" type="checkbox" name="column[]" value="stn" style="" checked></div>STN</th>        <th><div><input id="" type="checkbox" name="column[]" value="quantity" style="" checked></div>Quantity</th>        <th><div><input id="" type="checkbox" name="column[]" value="freight_unit" style="" checked></div>Freight/Liter</th>        <th><div><input id="" type="checkbox" name="column[]" value="total_freight" style="" checked></div>Total Freight</th>    </tr>    </thead>    <tbody>    <?php    $company_total_freight = 0;        foreach($reports as $report)        {        ?>            <tr>                <td><input class="filter_check_box" type="checkbox" name="check[]" style="" checked value="<?= $report->trip_id; ?>"></td>                <td style="vertical-align: middle">                    <?= $this->carbon->createFromFormat('Y-m-d', $report->entry_date)->toFormattedDateString(); ?>                </td>                <td style="vertical-align: middle">                    <?= $report->tanker_number; ?>                </td>                <td style="vertical-align: middle">                    <?= $report->customerName; ?>                </td>                <td style="vertical-align: middle; text-align: center;">                    <?php                    $counter = 0;                    foreach($report->trip_related_details as $trip_detail)                    {                        $counter ++;                        $class = ($counter == sizeof($report->trip_related_details))?"":'multiple_entites';                        echo "<div class=$class>".$trip_detail->sourceCity." To ".$trip_detail->destinationCity."</div>";                    }                    ?>                </td>                <td style="vertical-align: middle; text-align: center;">                    <?php                    $counter = 0;                    foreach($report->trip_related_details as $trip_detail)                    {                        $counter ++;                        $class = ($counter == sizeof($report->trip_related_details))?"":'multiple_entites';                        $stn = ($trip_detail->stn_number == '')?'n/a':$trip_detail->stn_number;                        echo "<div class=$class>".$stn."</div>";                    }                    ?>                </td>                <td style="vertical-align: middle; text-align: center;">                    <?php                    $counter = 0;                    foreach($report->trip_related_details as $trip_detail)                    {                        $counter ++;                        $class = ($counter == sizeof($report->trip_related_details))?"":'multiple_entites';                        echo "<div class=$class>".$trip_detail->product_quantity."</div>";                    }                    ?>                </td>                <td style="vertical-align: middle; text-align: center;">                    <?php                    $counter = 0;                    foreach($report->trip_related_details as $trip_detail)                    {                        $counter ++;                        $class = ($counter == sizeof($report->trip_related_details))?"":'multiple_entites';                        echo "<div class=$class>".$trip_detail->company_freight_unit."</div>";                    }                    ?>                </td>                <td style="vertical-align: middle; text-align: center;">                    <?php                    $counter = 0;                    foreach($report->trip_related_details as $trip_detail)                    {                        $counter ++;                        $company_total_freight += ($trip_detail->product_quantity * $trip_detail->company_freight_unit);                        $class = ($counter == sizeof($report->trip_related_details))?"":'multiple_entites';                        echo "<div class=$class>".($trip_detail->product_quantity * $trip_detail->company_freight_unit)."</div>";                    }                    ?>                </td>            </tr>        <?php        }    ?>    </tbody>    <tfoot>    <tr>        <td colspan="8"><strong>TOTALS</strong></td>        <td><strong><?= $this->helper_model->money($company_total_freight) ?></strong></td>    </tr>    </tfoot></table></form><script src="<?= js()?>sorttable.js"></script>    </div></div>