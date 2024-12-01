<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');  // Pastikan pengguna sudah login
    }
    
    public function index()
    {
        if (auth()->user()->email !== 'admin@transisi.id') {
            return redirect()->route('home')->with('error', 'Access Denied');
        }
        return view('admin.dashboard');
    }
    
}
