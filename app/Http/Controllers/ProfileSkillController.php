<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileSkillController extends Controller
{
    public function store(Request $request)
    {
        // PERBAIKAN: Validasi sekarang untuk 'skill_name', bukan 'skill_id'
        $validated = $request->validate([
            'skill_name' => 'required|string|max:255',
            'score' => 'required|integer|min:0|max:100',
        ]);

        $userProfile = Auth::user()->profile;

        // Cari skill berdasarkan nama, atau buat baru jika tidak ada
        $skill = Skill::firstOrCreate(
            ['name' => $validated['skill_name']]
        );

        // Gunakan syncWithoutDetaching untuk menambah/memperbarui skor skill
        $userProfile->skills()->syncWithoutDetaching([
            $skill->id => ['score' => $validated['score']]
        ]);

        return back()->with('success', 'Skill berhasil ditambahkan/diperbarui!');
    }

    public function destroy(Skill $skill)
    {
        $userProfile = Auth::user()->profile;
        $userProfile->skills()->detach($skill->id);

        return back()->with('success', 'Skill berhasil dihapus dari profil.');
    }
}
