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

    public function create()
    {
        return view('CompanySide.form', [
            'disabilities' => Disability::latest()->get(),
            'seniorities' => Seniority::latest()->get(),
            'company' => Auth::user()->company,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'job_type' => 'required|string|max:255|exists:job_types,id',
            'education_level' => 'required|string|max:255|exists:education_levels,id',
            'location' => 'required|string|max:255|exists:locations,id',
            'work_mode' => 'required',
            'slot' => 'required|integer|min:1',
            'description' => 'required|string',
            'responsibilities' => 'required|string',
            'wage' => 'required|numeric|min:0',
            'disability' => 'required|exists:disabilities,id',
            'seniority' => 'required|exists:seniorities,id',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $companyId = Auth::user()->company->id;
        $job = new Job();
        $job->name = $validatedData['name'];
        $job->job_type_id = $validatedData['job_type'];
        $job->education_level_id = $validatedData['education_level'];
        $job->location_id = $validatedData['location'];
        $job->work_mode = $validatedData['work_mode'];
        $job->slot = $validatedData['slot'];
        $job->description = $validatedData['description'];
        $job->responsibilities = $validatedData['responsibilities'];
        $job->wage = $validatedData['wage'];
        $job->disability_id = $validatedData['disability'];
        $job->seniority_id = $validatedData['seniority'];
        $job->company_id = $companyId;
        $job->created_at = now();
        $job->updated_at = now();
        $job->slug = $validatedData['name'];

        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('job', $imageName);
            $job->banner_image_path = 'storage/job/' . $imageName;
        }
        $job->save();

        return redirect()->route('companyJob.index')->with('success', 'Lowongan kerja berhasil diupload!');
    }

    public function edit(Job $job)
    {
        return view('CompanySide.edit-form', [
            'job' => $job,
            'disabilities' => Disability::latest()->get(),
            'seniorities' => Seniority::latest()->get(),
            'company' => Auth::user()->company,
        ]);
    }

    public function update(Request $request, Job $job)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'job_type' => 'required|string|max:255|exists:job_types,id',
            'education_level' => 'required|string|max:255|exists:education_levels,id',
            'location' => 'required|string|max:255|exists:locations,id',
            'work_mode' => 'required',
            'slot' => 'required|integer|min:1',
            'description' => 'required|string',
            'responsibilities' => 'required|string',
            'wage' => 'required|numeric|min:0',
            'disability' => 'required|exists:disabilities,id',
            'seniority' => 'required|exists:seniorities,id',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $job->name = $validatedData['name'];
        $job->job_type_id = $validatedData['job_type'];
        $job->education_level_id = $validatedData['education_level'];
        $job->location_id = $validatedData['location'];
        $job->work_mode = $validatedData['work_mode'];
        $job->slot = $validatedData['slot'];
        $job->description = $validatedData['description'];
        $job->responsibilities = $validatedData['responsibilities'];
        $job->wage = $validatedData['wage'];
        $job->disability_id = $validatedData['disability'];
        $job->seniority_id = $validatedData['seniority'];
        $job->slug = $validatedData['name'];

        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('job', $imageName);
            $job->banner_image_path = 'storage/job/' . $imageName;
        }

        $job->updated_at = now();
        $job->save();

        return redirect()->route('companyJob.index')->with('success', 'Lowongan kerja berhasil diperbarui!');
    }



    public function destroy(Job $job)
    {
        $job->delete();
        return redirect()->back()->with('success', 'Lowongan berhasil dihapus');
    }
}
