<?php
namespace App\Services;

use App\Models\Employee;
use App\Repositories\EmployeeRepository;
use App\Services\EmployeeServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class EmployeeService implements EmployeeServiceInterface
{
    protected $employeeRepository;

    /**
     * @param object $employee
     */
    public function __construct(EmployeeRepository $employeeRepository) {

        $this->employeeRepository = $employeeRepository;
    }


    public function findByCodeOrName(string $search): ?Employee
    {
        return $this->employeeRepository->findByCodeOrName($search);
    }
    public function findAll(): Employee
    {
        return $this->employeeRepository->findAll();
    }
    public function findById(int $id): Employee
    {
        return $this->employeeRepository->findById($id);
    }
    public function doExport(): array
    {
        return array();

    }
}
