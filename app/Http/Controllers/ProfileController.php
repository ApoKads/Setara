<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function show($userId)
    {
        $user = User::with(['profile', 'jobs', 'educationLevels', 'disabilityProfile', 'applicant.skills', 'applicant.careerHistories'])->findOrFail($userId);
        return view('profile.show', compact('user'));
    }

}
