<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class AdminController extends Controller
{
    public function dashboard()
    {
    $companies = Company::all();
    return view('dashboard', compact('companies'));
    }
}

