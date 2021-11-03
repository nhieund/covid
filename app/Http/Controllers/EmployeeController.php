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
        $daily = array();
        foreach($checkins["items"] as $checkin){
           $daily[$checkin["employee_id"]][$checkin["checkin_at"]] =  $checkin["temperature"];
        }
        $currentDateTime = Carbon::create(2021, 10, 01, 00, 00, 00); //Tạo 1 datetime
        $header = array("Họ và tên");
        $period = CarbonPeriod::create(Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth());
        foreach($period as $date)
        {
            $header[] = $date->format('Y-m-d');
        }
        return $this->checkinService->generateCsv($header,$daily,$currentDateTime);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function getStatistic(Request $request){
        $data = $this->checkinService->getData($request);
        $employee = Employee::all()->toArray();
        $listDate = $data['listDate'];
        $daily = $data['daily'];
        $monthYear = $data['monthYear'];
        $result = [];
        foreach ($employee as $e) {
            $item = [];
            $item[] = $e["name"];
            for ($i = 0, $n = count($listDate); $i < $n; $i++) {
                $date = $listDate[$i];
                if (isset($daily[$e["id"]]) == false || isset($daily[$e["id"]][$date]) == false) {
                    $item[] = "-";
                } else {
                    $item[] = $daily[$e["id"]][$date];
                }
            }
            $result[] = $item;
        }
        return view('employee_export', compact('monthYear', 'listDate', 'result'));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function exportStatistic(Request $request){
        $data = $this->checkinService->getData($request);
        $daily = $data['daily'];
        $year = $data['year'];
        $month = $data['month'];
        $header = array("Họ và tên");
        $listDate = $data['listDate'];
        $header = array_merge($header,$listDate);
        $currentDateTime = Carbon::create($year, $month, 01, 00, 00, 00);
        return $this->checkinService->generateCsv($header,$daily,$currentDateTime);
    }
}
