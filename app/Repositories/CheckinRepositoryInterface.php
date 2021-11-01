<?php
namespace App\Repositories;

use App\Models\Checkin;

interface CheckinRepositoryInterface
{

    public function create(int $employeeId, float $temperature): ?Checkin;
    public function findAll(): Checkin;
}
