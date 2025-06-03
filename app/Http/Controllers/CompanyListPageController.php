<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Category;
use Illuminate\Http\Request;

class CompanyListPageController extends Controller
{
    //

    public function index(){
        return view('listcompany',['companyCard' => Company::filter(request(['search','category']))->latest()->paginate(9)->withQueryString(),'categories' => Category::orderBy('name', 'asc')->get()]);
    }

    public function show(Company $company){
        return view('companydetail',['detail'=>$company]);
    }
}
