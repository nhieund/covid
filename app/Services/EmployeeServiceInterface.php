<?php
namespace App\Services;

use App\Models\Employee;

interface EmployeeServiceInterface
{

    public function findByCodeOrName(string $email): ?Employee;

    public function findAll(): Employee;

    public function findById(int $id): Employee ;

    public function doExport(): array;
}
