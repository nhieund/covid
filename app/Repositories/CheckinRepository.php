<?php
namespace App\Repositories;

use App\Models\Checkin;
use App\Repositories\CheckinRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CheckinRepository implements CheckinRepositoryInterface
{
    protected $checkin;

    /**
     * @param object $checkin
     */
    public function __construct(Checkin $checkin) {
        $this->checkin = $checkin;
    }


    public function create(int $employeeId, float $temperature): ?Checkin
    {
        return $this->checkin->create([
            'employee_id' => $employeeId,
            'temperature' => $temperature,
            "checkin_at" => Carbon::now()
        ]);
    }
    public function findAll(): Checkin
    {
        return $this->checkin;
    }

}
