<?php
namespace App\Repositories;

use App\Models\Employee;
use App\Repositories\EmployeeRepositoryInterface;
use Illuminate\Support\Facades\DB;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    protected $employee;

    /**
     * @param object $employee
     */
    public function __construct(Employee $employee) {
        $this->employee = $employee;
    }


    public function findByCodeOrName(string $search): ?Employee
    {
        //$query = DB::table('employees')->where('code', mb_strtoupper($search));
        //dd($query->toSql());

        return $this->employee
        ->where('code_checkin', $search)
        ->orWhere('name', mb_strtoupper($search))
        ->first();
    }
    public function findAll(): Employee
    {
        return $this->employee;
    }
    public function findById(int $id): Employee
    {
        return $this->employee->find($id);
    }

}
