<?php
namespace App\Repositories;

use App\Models\Employee;

interface EmployeeRepositoryInterface
{

    public function findByCodeOrName(string $email): ?Employee;
    public function findAll(): Employee;
    public function findById(int $id): Employee;
}
