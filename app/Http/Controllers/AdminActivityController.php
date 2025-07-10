<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyStatus;
use Illuminate\Support\Str;

class AdminActivityController extends Controller
{

public function activityPage(Request $request)
{
    $queryPendaftar = \App\Models\CompanyStatus::query()->where('status', 'waiting');
    $queryHistory = \App\Models\CompanyStatus::query()
        ->where('status', 'seen')
        ->whereIn('position', ['accepted', 'rejected']);

    if ($request->filled('search')) {
        $queryPendaftar->where('company_name', 'like', '%' . $request->search . '%');
    }

    $sortOrder = $request->get('sort') === 'oldest' ? 'asc' : 'desc';
    $pendaftarCompanies = $queryPendaftar->orderBy('created_at', $sortOrder)->get();
    $historyCompanies = $queryHistory->orderBy('updated_at', $sortOrder)->get();

    return view('AdminSide.activity', compact('pendaftarCompanies', 'historyCompanies'));
}


    public function approveCompany($id)
{
    $companyStatus = CompanyStatus::findOrFail($id);

    $companyStatus->update([
        'status' => 'seen',
        'position' => 'accepted',
    ]);

    $companyStatus = CompanyStatus::findOrFail($id);
    return redirect()->route('company.create', ['prefill' => $companyStatus->company_name]);

    // Simpan nama perusahaan ke session
    session()->flash('approved_company_name', $companyStatus->company_name);

    // Redirect ke halaman form company
    return redirect()->route('company.create');
}

    public function rejectCompany($id)
    {
        $companyStatus = CompanyStatus::findOrFail($id);

        $companyStatus->update([
            'status' => 'seen',
            'position' => 'rejected'
        ]);

        return redirect()->route('admin.activity')->with('success', 'Company rejected.');
    }
    
}
