<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Repositories\EmployeeRepository;
use App\Repositories\CompanyRepository;
use Barryvdh\Snappy\Facades\SnappyPdf;
use App\Models\Employee;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmployeesImport;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected $employeeRepository;
    protected $companyRepository;

    public function __construct(EmployeeRepository $employeeRepository, CompanyRepository $companyRepository)
    {
        $this->employeeRepository = $employeeRepository;
        $this->companyRepository = $companyRepository;
    }

    

    public function index()
    {
        $employees = $this->employeeRepository->allPaginated(5);
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(EmployeeRequest $request)
    {
        $data = $request->validated();
        $this->employeeRepository->store($data);
        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function show($id)
    {
        $employee = $this->employeeRepository->find($id);
        return view('employees.show', compact('employee'));
    }

    public function edit($id)
    {
        $employee = $this->employeeRepository->find($id);
        return view('employees.edit', compact('employee'));
    }

    public function update(EmployeeRequest $request, $id)
    {
        $employee = $this->employeeRepository->find($id);
        $data = $request->validated();
        $this->employeeRepository->update($employee, $data);
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy($id)
    {
        $employee = $this->employeeRepository->find($id);
        $this->employeeRepository->delete($employee);
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }

    public function exportToPDF()
    {
        $employees = Employee::all();

        $pdf = SnappyPdf::loadView('employees.pdf', compact('employees'));

        return $pdf->download('employees.pdf');
    }



  /*  public function importExcel(Request $request)
    {
        $request->validate(['file' => 'required|mimes:xlsx,csv']);
        Excel::import(new EmployeesImport, $request->file('file'));

        return redirect()->back()->with('success', 'Employees imported successfully!');
    }*/


}
