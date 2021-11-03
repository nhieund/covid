<?php
namespace App\Services;

use App\Models\Checkin;
use App\Models\Employee;
use App\Repositories\CheckinRepository;
use App\Services\CheckinServiceInterface;
use Carbon\CarbonPeriod;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;

class CheckinService implements CheckinServiceInterface
{
    protected $checkinRepository;

    /**
     * @param object $employee
     */
    public function __construct(CheckinRepository $checkinRepository) {

        $this->checkinRepository = $checkinRepository;
    }


    public function create(int $employeeId, float $temperature): ?Checkin
    {
        return $this->checkinRepository->create($employeeId, $temperature);
    }
    public function findAll(): Checkin
    {
        return $this->checkinRepository->findAll();
    }
    public function doExport(): array
    {
        $perPage = 99999;
        $page = 0;
        $results = $this->checkinRepository->findAll();
        $results = $results->orderBy('checkin_at', "ASC")
                    ->paginate($perPage, ['*'], 'page', $page);
        return $this->renderPagination($results, function ($value) {
            return $this->renderCheckin($value);
        });
    }
    private function renderPagination (LengthAwarePaginator $paginator, callable $renderItem): array
    {
        return [
            'items' => $paginator->map($renderItem),
            'total'        => $paginator->total(),
            'has_more'     => $paginator->hasMorePages(),
            'current_page' => $paginator->currentPage(),
            'last_page'    => $paginator->lastPage(),
        ];
    }
    private function renderCheckin(Checkin $checkin): array
    {
        return [
            'id'            => $checkin->id,
            'temperature'   => $checkin->temperature,
            'checkin_at'    => Carbon::parse($checkin->checkin_at)->format('Y-m-d'),
            'employee_id'   => $checkin->employee->id,
            'employee'      => $checkin->employee->toArray()
        ];
    }

    public function getListCheckinByFilter($month, $year)
    {
        $results = $this->checkinRepository->findAll();
        $results = $results->whereMonth('checkin_at', '=', $month)
            ->whereYear('checkin_at', '=', $year)
            ->orderBy('checkin_at', "ASC")
            ->get();
        $results = $results->map(function ($employee) {
            return $this->renderCheckin($employee);
        })->toArray();
        return $results;
    }

    public function getData($request)
    {
        $currentMonth = Carbon::now()->format('Y-m');
        $monthYear = $request->month ? $request->month : $currentMonth;
        $time = explode("-", $monthYear);
        $year = $time[0];
        $month = $time[1];
        $checkins = $this->getListCheckinByFilter($month, $year);
        $daily = array();
        foreach ($checkins as $checkin) {
            $daily[$checkin["employee_id"]][$checkin["checkin_at"]] = $checkin["temperature"];
        }
        $startDate = Carbon::create($year, $month)->startOfMonth()->format('Y-m-d');
        $endDate = Carbon::create($year, $month)->lastOfMonth()->format('Y-m-d');
        $period = CarbonPeriod::create($startDate, $endDate);
        $listDate = [];
        foreach ($period as $date) {
            $listDate[] = $date->format('Y-m-d');
        }
        return ['listDate' => $listDate, 'checkins' => $checkins,
            'monthYear' => $monthYear, 'daily' => $daily,
            'year' => $year, 'month' => $month];
    }

    public function generateCsv($header,$daily,$currentDateTime){
        $employee = Employee::all()->toArray();
        $fileName = "NTA_DO_THAN_NHIET_THANG".$currentDateTime->format('m-Y').".csv";
        $headers = array(
            'Content-Encoding'=> 'UTF-8',
            "Content-type"        => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0",
            "Content-transfer-encoding"=>" binary"
        );
        $callback = function () use ($employee, $header, $daily) {
            $file = fopen('php://output', 'w');
            fputs($file, chr(0xEF) . chr(0xBB) . chr(0xBF));
            fputcsv($file, $header);
            foreach ($employee as $e) {
                $item = [];
                $item[] = $e["name"];
                for ($i = 1, $n = count($header); $i < $n; $i++) {
                    $date = $header[$i];
                    if (isset($daily[$e["id"]]) == false || isset($daily[$e["id"]][$date]) == false) {
                        $item[] = "-";
                    } else {
                        $item[] = $daily[$e["id"]][$date];
                    }
                }
                fputcsv($file, $item);
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
}
