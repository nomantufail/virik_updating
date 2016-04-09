<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/8/2016
 * Time: 7:28 PM
 */


class IrfanTankerReport2 {
    private $ci;
    private $db;
    private $rawReport;
    public $reportGroupedByRoute;
    private $routes;
    private $tankers;
    private $tanker_fuel;
    private $from;
    private $to;
    public function __construct($tankerIds, $from, $to, $routes)
    {
        $this->ci =& get_instance();
        $this->db = $this->ci->db;
        $this->from = $from;
        $this->to = $to;

        $this->rawReport = $this->generateReport($tankerIds, $from, $to);
        $this->reportGroupedByRoute = $this->groupRawReportByRoute($this->rawReport);

        $this->tankers = $this->getTankers($tankerIds);
    }

    public function getTankers($tankerIds)
    {
        $tankers = [];
        $this->db->select('*');
        $this->db->where_in('id', $tankerIds);
        $result = $this->db->get('tankers')->result();

        foreach($result as $record)
        {
            $tankers[$record->id] = $record->truck_number;
        }

        return $tankers;
    }

    public function getTankerNumber($tankerId)
    {
        return $this->tankers[$tankerId];
    }
    public function getRouteTextByIds($routeIds)
    {
        $record = $this->reportGroupedByRoute[$routeIds][0];
        return $record->source." to ".$record->destination;
    }

    public function tanker_by_route($route, $tanker)
    {
        if(!isset($this->reportGroupedByRoute[$route]))
            return [];

        $route_report = $this->reportGroupedByRoute[$route];
        $grouped_by_tanker = Arrays::groupBy($route_report, Functions::extractField('tanker_id'));
        return $grouped_by_tanker[$tanker];
    }

    public function count_trips_of_tanker_by_route($route, $tanker)
    {
        $result = $this->tanker_by_route($route, $tanker);
        return sizeof($this->groupTankerRecordsByTripId($result));
    }

    public function groupTankerRecordsByTripId($tankerRecords)
    {
        return $grouped = Arrays::groupBy($tankerRecords, Functions::extractField('trip_id'));
    }

    public function expense_by_title($route, $tanker, $expense_title)
    {
        $result = $this->tanker_by_route($route, $tanker);
        $expense = 0;
        foreach($result as $record)
        {
            if($record->account_title_id == $expense_title){
                $expense = $record->amount;
                break;
            }
        }
        return $expense;
    }

    public function fuel_consumed($route, $tanker)
    {
        $result = $this->tanker_by_route($route, $tanker);
        $groupedByTripId = $this->groupTankerRecordsByTripId($result);
        $fuel = 0;
        foreach($groupedByTripId as $records)
        {
            $fuel += $records[0]->fuel_consumed;
        }
        return $fuel;
    }

    private function groupRawReportByRoute($report)
    {
        //adding extra_column
        foreach($report as &$record)
        {
            $record->route_product_key = $record->source_id."_".$record->destination_id."_".$record->product_id;
        }
        // grouping by route_product_key and triming
        return $this->trimm_expense_report(Arrays::groupBy($report, Functions::extractField('route_product_key')));
    }

    private function generateReport($tankerIds, $from, $to)
    {
        $this->db->select('
             trips.id as trip_id, tankers.id as tanker_id, trips.fuel_consumed,
              tankers.truck_number as tanker_number,source_city.cityName as source,
              source_city.id as source_id,destination_city.cityName as destination,
               destination_city.id as destination_id, products.productName as product,
                products.id as product_id, account_titles.title as title,
                account_titles.id as account_title_id,
                 sum(voucher_entry.debit_amount) as amount'
        );
        $this->db->join('trips_details','trips_details.trip_id = trips.id','left');
        $this->db->join('cities as source_city','source_city.id = trips_details.source','left');
        $this->db->join('cities as destination_city','destination_city.id = trips_details.destination','left');
        $this->db->join('products','products.id = trips_details.product','left');

        $this->db->join('tankers','tankers.id = trips.tanker_id','left');

        $this->db->join('voucher_journal','voucher_journal.trip_id = trips_details.trip_id','left');
        $this->db->join('voucher_entry','voucher_entry.journal_voucher_id = voucher_journal.id','left');
        $this->db->join('account_titles','account_titles.id = voucher_entry.account_title_id','left');

        $this->db->where_in('trips.tanker_id', $tankerIds);
        $this->db->where('trips.entryDate >=',$from);
        $this->db->where('trips.entryDate <=',$to);

        $this->db->where('account_titles.secondary_type', 'other_expense');
        $this->db->where('voucher_journal.active',1);
        $this->db->where('trips.active',1);
        $this->db->order_by('voucher_journal.trip_id');
        $this->db->group_by('trips_details.trip_id, trips_details.source,
                             trips_details.destination, trips_details.product,
                              voucher_entry.account_title_id');
        $result = $this->db->get('trips')->result();

        return $result;
    }

    private function trimm_expense_report($report)
    {
        $trimmed_report = [];
        foreach($report as $key => $records)
        {
            $key_parts = explode('_',$key);
            $new_key = $key_parts[0].'_'.$key_parts[1];

            if(!isset($trimmed_report[$new_key]))
                $trimmed_report[$new_key] = $records;
        }
        return $trimmed_report;
    }

} 