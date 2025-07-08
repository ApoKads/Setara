<?php

namespace App\Http\Controllers;

use App\Models\CareerHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CareerHistoryController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        $userProfile = Auth::user()->profile;
        $userProfile->careerHistories()->create($validated);

        return back()->with('success', 'Riwayat pekerjaan berhasil ditambahkan!');
    }

    public function update(Request $request, CareerHistory $careerHistory)
    {
        if ($careerHistory->user_profile_id !== Auth::user()->profile->id) {
            abort(403);
        }

        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        $careerHistory->update($validated);

        return back()->with('success', 'Riwayat pekerjaan berhasil diperbarui!');
    }

    public function destroy(CareerHistory $careerHistory)
    {
        if ($careerHistory->user_profile_id !== Auth::user()->profile->id) {
            abort(403);
        }

        $careerHistory->delete();

        return back()->with('success', 'Riwayat pekerjaan berhasil dihapus!');
    }
}
