<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyStatus;
use App\Models\Company;
use Illuminate\Support\Str;

class AdminActivityController extends Controller
{
    public function activityPage(Request $request)
    {
        $queryPendaftar = CompanyStatus::query()->where('status', 'pending');
        $queryHistory = CompanyStatus::query()
            ->whereIn('status', ['accepted', 'rejected']);

        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
            $queryPendaftar->where('company_name', 'like', $searchTerm);
            $queryHistory->where('company_name', 'like', $searchTerm);
        }

        $sortOrder = $request->get('sort') === 'oldest' ? 'asc' : 'desc';
        $pendaftarCompanies = $queryPendaftar->orderBy('created_at', $sortOrder)->get();
        $historyCompanies = $queryHistory->orderBy('updated_at', $sortOrder)->get();

        return view('AdminSide.activity', compact('pendaftarCompanies', 'historyCompanies'));
    }

    public function approveCompany($id)
    {
        $companyStatus = CompanyStatus::findOrFail($id);
        $companyStatus->update(['status' => 'accepted']);

        $user = \App\Models\User::where('email', $companyStatus->company_name . '@example.com')->first();

        if ($user && !$user->company) {
            Company::create([
                'user_id' => $user->id,
                'slug' => Str::slug($companyStatus->company_name . '-' . Str::random(5)),
                'name' => $companyStatus->company_name,
                'location' => 'Jakarta, Indonesia',
                'description' => 'Perusahaan yang baru disetujui oleh admin Setara.',
                'path_banner' => null,
                'path_logo' => null,
                'status' => 'accepted',
            ]);
        }

        return response()->json(['message' => 'Company approved successfully.', 'status' => 'accepted'], 200);
    }

    public function rejectCompany($id)
    {
        $companyStatus = CompanyStatus::findOrFail($id);
        $companyStatus->update(['status' => 'rejected']);

        return response()->json(['message' => 'Company rejected.', 'status' => 'rejected'], 200);
    }

    public function checkCompanyStatusApi($id)
    {
        $companyStatus = CompanyStatus::find($id);

        if (!$companyStatus) {
            return response()->json(['message' => 'Company status record not found.'], 404);
        }

        return response()->json([
            'status' => $companyStatus->status,
            'company_name' => $companyStatus->company_name
        ]);
    }
}
