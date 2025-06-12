<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobType;
use App\Models\Disability;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        // Hapus job dari database
        // dd($job);
        $job->delete();
        
        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Lowongan berhasil dihapus');
    }
}
