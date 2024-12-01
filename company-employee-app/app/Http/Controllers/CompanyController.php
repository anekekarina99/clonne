<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    protected $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function index()
    {
        $companies = $this->companyRepository->allPaginated(5);
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(CompanyRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('company', 'public');
        }

        $this->companyRepository->store($data);
        return redirect()->route('companies.index')->with('success', 'Company created successfully.');
    }

    public function show($id)
    {
        $company = $this->companyRepository->show($id);
        return view('companies.show', compact('company'));
    }

    public function edit($id)
    {
        $company = $this->companyRepository->find($id);
        return view('companies.edit', compact('company'));
    }

    public function update(CompanyRequest $request, $id)
    {
        $company = $this->companyRepository->find($id);
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('company', 'public');
        }

        $this->companyRepository->update($company, $data);
        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }

    public function destroy($id)
    {
        $company = $this->companyRepository->find($id);
        $this->companyRepository->delete($company);
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }
}
