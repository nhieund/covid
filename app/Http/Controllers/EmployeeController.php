<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EmployeeService;
use App\Services\CheckinService;
use App\Http\Requests\CheckinRequest;
use App\Models\Employee;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class EmployeeController extends Controller
{
    protected $employeeService;
    protected $checkinService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(EmployeeService $employeeService, CheckinService $checkinService) {
        $this->employeeService = $employeeService;
        $this->checkinService = $checkinService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function findByCodeOrName(Request $request)
    {
        $returnData = array("errCode"=> 404,"errMsg"=>"Bạn muốn trêu đùa mình sao!","data"=>array());
        $search = $request->input("search");
        if(empty($search) || strlen($search) == 0){
            return response()->json($returnData);
        }
        $employee = $this->employeeService->findByCodeOrName($request->input("search"));
        if($employee != null){
            $returnData = array("errCode"=> 0,"errMsg"=>"OK","data"=>$employee);
        }
        return response()->json($returnData);
    }
    public function checkin(CheckinRequest $request)
    {
        $returnData = array("errCode"=> 404,"errMsg"=>"Bạn muốn trêu đùa mình sao!","data"=>array());
        $validatedData = $request->validated();
        $employee_id       = $validatedData['employee_id'];
        $temperature         = $validatedData['temperature'];
        $checkin = $this->checkinService->create($employee_id,$temperature);
        if($checkin != null){
           // $employee = $this->employeeService->findById($checkin->employee->id);
            $returnData = array("errCode"=> 0,"errMsg"=>"OK","data"=> $checkin->employee);
        }
        return response()->json($returnData);
    }
    public function doExport(Request $request){
        $checkins = $this->checkinService->doExport();
        //dd($checkins);
        $daily = array();
        $data = array();
        $item = array();
        $employee = array(
            array("id"=>3,"name"=>"name 3"),
            array("id"=>4,"name"=>"name 4")
        );
        foreach($checkins["items"] as $checkin){
           $daily[$checkin["employee_id"]][$checkin["checkin_at"]] =  $checkin["temperature"];
          //var_dump($checkin);
          //dd($checkin);
        }
        //$date=date_create("2021-10-01");

        //$currentDateTime = Carbon::now();
        //echo date_format($date,"Y-m-d");
        $currentDateTime = Carbon::create(2021, 10, 01, 00, 00, 00); //Tạo 1 datetime
        $header = array("Họ và tên");
        $period = CarbonPeriod::create(Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth());
        foreach($period as $date)
        {
            $header[] = $date->format('Y-m-d');
        }
        // for( $i=0,$n=30; $i <= $n; $i++){
        //     // date_add($date,date_interval_create_from_date_string("1 days"));
        //      $newDateTime = $currentDateTime;
        //    //  $newDateTime = $newDateTime->addDay($i);
        //      //$date = date_format($date,"Y-m-d");
        //      $date = $newDateTime->addDay($i)->format("Y-m-d");
        //      array_push($header,$date);
        //  }
       //  var_dump($header);exit;
        $fileName = "NTA_DO_THAN_NHIET_THANG".$currentDateTime->format('m-Y').".csv";
        // $headers = array(
        //     'Content-Type' => 'text/csv',
        //     'Content-Disposition' => 'attachment; filename="tweets.csv"',
        //     );
            $headers = array(
                'Content-Encoding'=> 'UTF-8',
                "Content-type"        => "text/csv; charset=UTF-8",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0",
                "Content-transfer-encoding"=>" binary"
            );
            $employee = Employee::all()->toArray();
            $callback = function() use($employee, $header, $daily) {
                $file = fopen('php://output', 'w');
                fputs($file, chr(0xEF) . chr(0xBB) . chr(0xBF) );
                fputcsv($file, $header);
                foreach($employee as $e){
                    $item = [];
                    $item[] = $e["name"];
                    for( $i=1,$n=count($header); $i < $n; $i++){
                        $date = $header[$i];
                        if(isset($daily[$e["id"]]) == false || isset($daily[$e["id"]][$date]) == false){
                           // $data[$e["name"]][] = "-";
                           $item[] =  "-";
                        }else{
                            //$data[$e["name"]][] = $daily[$e["id"]][$date];
                           $item[] =  $daily[$e["id"]][$date];
                        }
                    }
                    fputcsv($file, $item);
                }
                fclose($file);
            };
        // our response, this will be equivalent to your download() but
        // without using a local file
        //return Response::make(rtrim($output, "\n"), 200, $headers);
        // return response(rtrim($output, "\n"))
        //     ->header('Content-Type', 'text/csv')
        //     ->header('Content-Disposition',  'attachment; filename="tweets.csv"');
         //$index ++;
         //dd($data);
         return response()->stream($callback, 200, $headers);

    }
}
