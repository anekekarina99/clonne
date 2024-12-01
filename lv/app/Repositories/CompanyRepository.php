<?php

namespace App\Repositories;

use App\Models\Company;

class CompanyRepository
{
    protected $model;

    public function __construct(Company $model)
    {
        $this->model = $model;
    }

    public function allPaginated($perPage = 15)
    {
        return $this->model->paginate($perPage);
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($company, array $data)
    {
        return $company->update($data);
    }

    public function delete($company)
    {
        return $company->delete();
    }

    public function show($id)
    {
        return $this->find($id); // Bisa lebih kompleks jika ada relasi
    }
}
