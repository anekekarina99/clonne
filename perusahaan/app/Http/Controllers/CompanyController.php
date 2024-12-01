<?php

namespace App\Http\Controllers;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreCompanyRequest; 


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil daftar companies dan paginate dengan 5 data per halaman
        $companies = Company::paginate(5); // Menampilkan 5 data per halaman
    
        // Kembalikan view dengan data companies
        return view('companies.index', compact('companies'));
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
    public function store(Request $request)
    {
        // Validasi data input termasuk logo
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies,email',
            'logo' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'website' => 'required|url'
        ]);
        
        // Proses upload logo
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('company', 'public');
        }
    
        // Simpan data company
        Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'logo' => $logoPath,
            'website' => $request->website
        ]);
        
        return redirect()->route('companies.index');
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
    
    public function select2(Request $request)
    {
        $companies = Company::paginate(5); // Atur pagination jika diperlukan
        return response()->json($companies);
    }
    
}
