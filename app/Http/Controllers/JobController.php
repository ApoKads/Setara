<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobType;
use App\Models\Seniority;
use App\Models\Disability;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class JobController extends Controller
{
   

    /**
     * Remove the specified resource from storage.
     */

    public function create(){
        // dd("masuk");

        return view('CompanySide.form',[
            'disabilities'=>Disability::latest()->get(),
            'seniorities'=>Seniority::latest()->get(),
            'company'=>Auth::user()->company,
        ]);
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name'                  => 'required|string|max:255',
            'job_type'              => 'required|string|max:255|exists:job_types,id', // Adjust based on Livewire output
            'education_level'       => 'required|string|max:255|exists:education_levels,id', // Adjust based on Livewire output
            'location'              => 'required|string|max:255|exists:locations,id', // Adjust based on Livewire output
            'work_mode'             => 'required', // Validate against allowed values
            'slot'                  => 'required|integer|min:1',
            'description'           => 'required|string',
            'responsibilities'      => 'required|string',
            'wage'                  => 'required|numeric|min:0',
            'disability'         => 'required|exists:disabilities,id', // Ensure it exists in disabilities table
            'seniority'          => 'required|exists:seniorities,id',   // Ensure it exists in seniorities table
            'banner_image'      => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        
        $companyId = Auth::user()->company->id; // This assumes the authenticated user's ID is the company ID.

        // Create a new Job instance and fill it with validated data
        $job = new Job();
        $job->name = $validatedData['name'];
        $job->job_type_id = $validatedData['job_type']; // This might need adjustment for Livewire
        $job->education_level_id = $validatedData['education_level']; // This might need adjustment for Livewire
        $job->location_id = $validatedData['location']; // This might need adjustment for Livewire
        $job->work_mode = $validatedData['work_mode'];
        $job->slot = $validatedData['slot'];
        $job->description = $validatedData['description'];
        $job->responsibilities = $validatedData['responsibilities'];
        $job->wage = $validatedData['wage'];
        $job->disability_id = $validatedData['disability'];
        $job->seniority_id = $validatedData['seniority'];
        $job->company_id = $companyId; // Assign the company ID
        $job->created_at = now();
        $job->updated_at = now();
        $job->slug = $validatedData['name'];

        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('job', $imageName);
            $job->banner_image_path = 'storage/job/' . $imageName; // Simpan path yang dapat diakses publik
        }
        $job->save();

        return redirect()->route('companyJob.index')->with('success', 'Lowongan kerja berhasil diupload!');
    }

    public function destroy(Job $job)
    {
        // Hapus job dari database
        // dd($job);
        $job->delete();
        
        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Lowongan berhasil dihapus');
    }
}
