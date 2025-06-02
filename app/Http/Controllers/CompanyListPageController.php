<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyListPageController extends Controller
{
    //

    public function index(){
        return view('listcompany',['companyCard' => Company::class::latest()->get()]);
    }
}
