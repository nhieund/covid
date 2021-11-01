<?php
namespace App\Services;

use App\Models\Checkin;
use App\Repositories\CheckinRepository;
use App\Services\CheckinServiceInterface;
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

}
