<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Str;
use App\Models\User;

class AdminActivityController extends Controller
{
    public function activityPage(Request $request)
    {
        $queryPendaftar = Company::query()->where('status', 'pending');
        $queryHistory = Company::query()
            ->whereIn('status', ['accepted', 'rejected']);

        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
            $queryPendaftar->where('name', 'like', $searchTerm);
            $queryHistory->where('name', 'like', $searchTerm);
        }

        $sortOrder = $request->get('sort') === 'oldest' ? 'asc' : 'desc';
        $pendaftarCompanies = $queryPendaftar->orderBy('created_at', $sortOrder)->get();
        $historyCompanies = $queryHistory->orderBy('updated_at', $sortOrder)->get();

        return view('AdminSide.activity', compact('pendaftarCompanies', 'historyCompanies'));
    }

    public function approveCompany($id)
    {
        $company = Company::findOrFail($id);
        $company->update(['status' => 'accepted']);

        $user = User::where('email', $company->name . '@example.com')->first();
        if ($user) {
            $user->update(['is_active' => true]);
        }

        return response()->json(['message' => 'Company approved successfully.', 'status' => 'accepted'], 200);
    }

    public function rejectCompany($id)
    {
        $company = Company::findOrFail($id);
        $company->update(['status' => 'rejected']);

        $user = User::where('email', $company->name . '@example.com')->first();
        if ($user) {
            $user->update(['is_active' => false]);
        }

        return response()->json(['message' => 'Company rejected.', 'status' => 'rejected'], 200);
    }

    public function checkCompanyStatusApi($id)
    {
        $company = Company::find($id);

        if (!$company) {
            return response()->json(['message' => 'Company record not found.'], 404);
        }

        return response()->json([
            'status' => $company->status,
            'company_name' => $company->name
        ]);
    }
}
