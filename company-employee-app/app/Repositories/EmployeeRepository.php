<?php

namespace App\Repositories;

use App\Models\Employee;

class EmployeeRepository
{
    protected $model;

    public function __construct(Employee $model)
    {
        $this->model = $model;
    }

    public function allPaginated($perPage = 15)
    {
        return $this->model->paginate($perPage);
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function update($employee, array $data)
    {
        return $employee->update($data);
    }

    public function delete($employee)
    {
        return $employee->delete();
    }
}
