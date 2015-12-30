<html><head>    <title>Balance Sheet <?= $account_holder ?></title>    <link href="<?= css()?>bootstrap.min.css" rel="stylesheet"></head><body><style>    table{        font-size: 12px;    }    .multiple_entites{        border-bottom: 1px dashed lightgray;    }</style><div id="page-wrapper" style="min-height: 700px;"><div class="container-fluid"><div class="row"><table class="table table-bordered table-hover table-striped" style="font-size:12px;"><thead style=""><tr>    <th style="width: 75%">Transaction Details</th>    <th style="width: 11%;">Debit</th>    <th style="width: 11%;">Credit</th></tr></thead><tbody><?php$total_debit = 0;$total_credit = 0;$total_assets_balance = 0;$total_liabilities_balance = 0;$total_equity_balance = 0;?><tr>    <th style="text-align: center">Assets</th><td></td><td></td></tr><?php  foreach($balance_sheet['assets'] as $record): ?>    <?php $total_debit += $record->debit; ?>    <?php $total_credit += $record->credit; ?>    <tr style="background-color: rgba(0,255,0,0.1)">        <td>            <?php            $ledger_title = $record->title;            $ledger_account_title_id = $record->account_title_id;            $ledger_ac_type = $record->ac_type;            $related_other_agent_id = $record->related_other_agent;            $related_other_agent_name = $record->other_agent_name;            $related_customer_id =  $record->related_customer;            $related_customer_name = $record->customer_name;            $related_contractor_id =  $record->related_contractor;            $related_contractor_name = $record->contractor_name;            $related_company_id =  $record->related_company;            $related_company_name = $record->company_name;            if(!in_array('title', $group_bys)){                $ledger_title = '*';                $ledger_account_title_id = '*';            }            if(!in_array('ac_type', $group_bys)){                $ledger_ac_type = '*';            }            if(!in_array('related_other_agent', $group_bys)){                $related_other_agent_id = '*';                $related_other_agent_name = '*';                $related_customer_id = '*';                $related_customer_name = '*';                $related_contractor_id = '*';                $related_contractor_name = '*';                $related_company_id = '*';                $related_company_name = '*';            }            $ledger_query = $this->helper_model->merge_query($_SERVER['QUERY_STRING'],                array(                    'ledger_title'=>$ledger_title,                    'ledger_account_title_id'=>$ledger_account_title_id,                    'ledger_ac_type'=>$ledger_ac_type,                    'related_other_agent'=>$related_other_agent_id,                    'ledger_other_agent_name'=>$related_other_agent_name.'',                    'related_customer'=>$related_customer_id,                    'ledger_customer_name'=>$related_customer_name.'',                    'related_contractor'=>$related_contractor_id,                    'ledger_contractor_name'=>$related_contractor_name.'',                    'related_company'=>$related_company_id,                    'ledger_company_name'=>$related_company_name.''));            ?>            <?php            if(in_array('title', $group_bys)){                echo $record->title." ";            }            if(in_array('ac_type', $group_bys)){                echo $record->ac_type." ";            }            if(in_array('related_other_agent', $group_bys)){                echo $record->other_agent_name." ";            }            if(in_array('related_customer', $group_bys)){                echo $record->customer_name." ";            }            if(in_array('related_contractor', $group_bys)){                echo $record->contractor_name." ";            }            if(in_array('related_company', $group_bys)){                echo $record->company_name." ";            }            /*echo $record->title." | ";            echo $record->ac_type." | ";            echo $record->other_agent_name." ";            echo $record->customer_name."";            echo $record->contractor_name."";*/            ?>        </td>        <?php        $total_assets_balance += round(($record->debit - $record->credit), 3);        $balance = round(($record->debit - $record->credit), 3);        ?>        <td><?= (($balance > 0)?$this->helper_model->money($balance):''); ?><?= (($balance == 0)?0:''); ?></td>        <td><?= (($balance < 0)?$this->helper_model->money(($balance * -1)):''); ?><?= (($balance == 0)?0:''); ?></td>    </tr><?php endforeach; ?><tr style="background-color: rgba(0,255,0,0.1)">    <th style="text-align: right;">Total Assets</th>    <th>        <?php        if($total_assets_balance > 0)        {            echo $this->helper_model->money($total_assets_balance);        }        else if($total_assets_balance == 0)        {            echo $total_assets_balance;        }        else if($total_assets_balance < 0)        {            echo "(".$this->helper_model->money($total_assets_balance*-1).")";        }        ?>    </th>    <td></td></tr><tr>    <th style="text-align: center">Liabilities</th><td></td><td></td></tr><?php  foreach($balance_sheet['liabilities'] as $record): ?>    <?php $total_credit += $record->credit; ?>    <?php $total_debit += $record->debit; ?>    <tr style="background-color: rgba(255,0,0,0.1)">        <td>            <?php            $ledger_title = $record->title;            $ledger_account_title_id = $record->account_title_id;            $ledger_ac_type = $record->ac_type;            $related_other_agent_id = $record->related_other_agent;            $related_other_agent_name = $record->other_agent_name;            $related_customer_id =  $record->related_customer;            $related_customer_name = $record->customer_name;            $related_contractor_id =  $record->related_contractor;            $related_contractor_name = $record->contractor_name;            $related_company_id =  $record->related_company;            $related_company_name = $record->company_name;            if(!in_array('title', $group_bys)){                $ledger_title = '*';                $ledger_account_title_id = '*';            }            if(!in_array('ac_type', $group_bys)){                $ledger_ac_type = '*';            }            if(!in_array('related_other_agent', $group_bys)){                $related_other_agent_id = '*';                $related_other_agent_name = '*';                $related_customer_id = '*';                $related_customer_name = '*';                $related_contractor_id = '*';                $related_contractor_name = '*';                $related_company_id = '*';                $related_company_name = '*';            }            $ledger_query = $this->helper_model->merge_query($_SERVER['QUERY_STRING'],                array(                    'ledger_title'=>$ledger_title,                    'ledger_account_title_id'=>$ledger_account_title_id,                    'ledger_ac_type'=>$ledger_ac_type,                    'related_other_agent'=>$related_other_agent_id,                    'ledger_other_agent_name'=>$related_other_agent_name.'',                    'related_customer'=>$related_customer_id,                    'ledger_customer_name'=>$related_customer_name.'',                    'related_contractor'=>$related_contractor_id,                    'ledger_contractor_name'=>$related_contractor_name.'',                    'related_company'=>$related_company_id,                    'ledger_company_name'=>$related_company_name.''));            ?>            <?php            if(in_array('title', $group_bys)){                echo $record->title." ";            }            if(in_array('ac_type', $group_bys)){                echo $record->ac_type." ";            }            if(in_array('related_other_agent', $group_bys)){                echo $record->other_agent_name." ";            }            if(in_array('related_customer', $group_bys)){                echo $record->customer_name." ";            }            if(in_array('related_contractor', $group_bys)){                echo $record->contractor_name." ";            }            if(in_array('related_company', $group_bys)){                echo $record->company_name." ";            }            /*echo $record->title." | ";            echo $record->ac_type." | ";            echo $record->other_agent_name." ";            echo $record->customer_name."";            echo $record->contractor_name."";*/            ?>        </td>        <?php        $total_liabilities_balance += round(($record->debit - $record->credit), 3);        $balance = round(($record->debit - $record->credit), 3);        ?>        <td><?= (($balance > 0)?$this->helper_model->money($balance):''); ?><?= (($balance == 0)?0:''); ?></td>        <td><?= (($balance < 0)?$this->helper_model->money(($balance * -1)):''); ?><?= (($balance == 0)?0:''); ?></td>    </tr><?php endforeach; ?><tr style="background-color: rgba(255,0,0,0.1)">    <th style="text-align: right;">Total Liabilities</th><td></td>    <th>        <?php        if($total_liabilities_balance > 0)        {            echo $this->helper_model->money($total_liabilities_balance);        }        else if($total_liabilities_balance == 0)        {            echo $total_liabilities_balance;        }        else if($total_liabilities_balance < 0)        {            echo "(".$this->helper_model->money($total_liabilities_balance*-1).")";        }        ?>    </th></tr><tr>    <th style="text-align: center">Equity</th><td></td><td></td></tr><?php  foreach($balance_sheet['equity'] as $record): ?>    <?php $total_credit += $record->credit; ?>    <?php $total_debit += $record->debit; ?>    <tr style="background-color: rgba(0,0,255,0.1)">        <td>            <?php            $ledger_title = $record->title;            $ledger_account_title_id = $record->account_title_id;            $ledger_ac_type = $record->ac_type;            $related_other_agent_id = $record->related_other_agent;            $related_other_agent_name = $record->other_agent_name;            $related_customer_id =  $record->related_customer;            $related_customer_name = $record->customer_name;            $related_contractor_id =  $record->related_contractor;            $related_contractor_name = $record->contractor_name;            $related_company_id =  $record->related_company;            $related_company_name = $record->company_name;            if(!in_array('title', $group_bys)){                $ledger_title = '*';                $ledger_account_title_id = '*';            }            if(!in_array('ac_type', $group_bys)){                $ledger_ac_type = '*';            }            if(!in_array('related_other_agent', $group_bys)){                $related_other_agent_id = '*';                $related_other_agent_name = '*';                $related_customer_id = '*';                $related_customer_name = '*';                $related_contractor_id = '*';                $related_contractor_name = '*';                $related_company_id = '*';                $related_company_name = '*';            }            $ledger_query = $this->helper_model->merge_query($_SERVER['QUERY_STRING'],                array(                    'ledger_title'=>$ledger_title,                    'ledger_account_title_id'=>$ledger_account_title_id,                    'ledger_ac_type'=>$ledger_ac_type,                    'related_other_agent'=>$related_other_agent_id,                    'ledger_other_agent_name'=>$related_other_agent_name.'',                    'related_customer'=>$related_customer_id,                    'ledger_customer_name'=>$related_customer_name.'',                    'related_contractor'=>$related_contractor_id,                    'ledger_contractor_name'=>$related_contractor_name.'',                    'related_company'=>$related_company_id,                    'ledger_company_name'=>$related_company_name.''));            ?>            <?php            if(in_array('title', $group_bys)){                echo $record->title." ";            }            if(in_array('ac_type', $group_bys)){                echo $record->ac_type." ";            }            if(in_array('related_other_agent', $group_bys)){                echo $record->other_agent_name." ";            }            if(in_array('related_customer', $group_bys)){                echo $record->customer_name." ";            }            if(in_array('related_contractor', $group_bys)){                echo $record->contractor_name." ";            }            if(in_array('related_company', $group_bys)){                echo $record->company_name." ";            }            /*echo $record->title." | ";            echo $record->ac_type." | ";            echo $record->other_agent_name." ";            echo $record->customer_name."";            echo $record->contractor_name."";*/            ?>        </td>        <?php        $total_equity_balance += round(($record->debit - $record->credit), 3);        $balance = round(($record->debit - $record->credit), 3);        ?>        <td><?= (($balance > 0)?$this->helper_model->money($balance):''); ?><?= (($balance == 0)?0:''); ?></td>        <td><?= (($balance < 0)?$this->helper_model->money(($balance * -1)):''); ?><?= (($balance == 0)?0:''); ?></td>    </tr><?php endforeach; ?><tr style="background-color: rgba(0,0,255,0.1)">    <td>        Net Profit    </td>    <?php    $total_credit += $balance_sheet['net_profit'];    $balance = round(($balance_sheet['net_profit']), 3);    ?>    <td><?= (($balance > 0)?$this->helper_model->money($balance):''); ?><?= (($balance == 0)?0:''); ?></td>    <td><?= (($balance < 0)?$this->helper_model->money(($balance * -1)):''); ?><?= (($balance == 0)?0:''); ?></td></tr><tr style="background-color: rgba(0,0,255,0.1)">    <th style="text-align: right;">Total Equity</th>    <?php    $total_equity_balance += $balance_sheet['net_profit'];    ?>    <th><?= (($total_equity_balance > 0)?$this->helper_model->money($total_equity_balance):''); ?><?= (($total_equity_balance == 0)?0:''); ?></th>    <th><?= (($total_equity_balance < 0)?$this->helper_model->money(($total_equity_balance * -1)):''); ?><?= (($total_equity_balance == 0)?0:''); ?></th></tr></tbody><tfoot><tr style="border-top: 2px solid darkgray;">    <th style="text-align: right; color: blue;">Grand Total</th>    <th style="color: blue; background-color: rgba(0,255,0,0.1);"><?= $this->helper_model->money(round($total_debit, 3)); ?></th>    <th style="color: blue; background-color: rgba(0,255,0,0.1);"><?= $this->helper_model->money(round($total_credit, 3)); ?></th></tr></tfoot></table></div></div></div><script src="<?= js()?>sorttable.js"></script></body></html>