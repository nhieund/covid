<?php
namespace App\Services;

use App\Models\Checkin;

interface CheckinServiceInterface
{

    public function create(int $employeeId, float $temperature): ?Checkin;
    public function findAll(): Checkin;
    public function doExport(): array;
}
