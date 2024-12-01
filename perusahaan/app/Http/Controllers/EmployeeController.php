<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use Barryvdh\Snappy\Facades\SnappyPdf;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::paginate(5);
        return view('employees.index', compact('employees'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        // 1. Validasi otomatis melalui StoreEmployeeRequest
        
        // 2. Proses untuk menyimpan data employee
        $employee = Employee::create([
            'name' => $request->validated()['name'],
            'email' => $request->validated()['email'],
            'company_id' => $request->validated()['company_id'],  // Menyimpan company_id yang valid
        ]);

        // 3. Redirect ke halaman daftar employee setelah berhasil
        return redirect()->route('employees.index')->with('success', 'Employee added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function exportPdf($companyId)
    {
        $company = Company::findOrFail($companyId);
        $employees = $company->employees;
        
        $pdf = SnappyPdf::loadView('employees.pdf', compact('employees', 'company'));
        return $pdf->download('employees_'.$company->name.'.pdf');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);
    
        Excel::import(new EmployeesImport, $request->file('file'));
    
        return back()->with('success', 'Employees imported successfully');
    }
    
}
