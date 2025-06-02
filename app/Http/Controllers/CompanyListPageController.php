<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyListPageController extends Controller
{
    //

    public function index(){
        return view('listcompany',['companyCard' => Company::class::filter(request(['search']))->latest()->get()]);
    }

    public function show(Company $company){
        return view('companydetail',['detail'=>$company]);
    }
}
