<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Category;
use Illuminate\Http\Request;

class CompanyListPageController extends Controller
{
    //

    public function index(){
        return view('ListCompany.listcompany',[
        'companyCard' => Company::filter(request(['search','category']))->latest()->paginate(9)->withQueryString(),
        'categories' => Category::orderBy('name', 'asc')->get()
    ]);
    }

    public function show(Company $company){
        // Load the company with its categories and user relationship for email
        $company->load(['categories', 'user']);
        
        // Get other companies for recommendations (excluding current company)
        $companies = Company::where('id', '!=', $company->id)
                            ->latest()
                            ->limit(6)
                            ->get();
        
        // Get paginated jobs for this company (6 per page) - using 'jobCard' to match the view
        $jobCard = $company->jobs()
                          ->with(['company', 'location', 'JobType', 'EducationLevel', 'disability', 'seniority'])
                          ->latest()
                          ->paginate(6);
                            
        return view('companydetail', [
            'detail' => $company,
            'companies' => $companies,
            'jobCard' => $jobCard
        ]);
    }
}
