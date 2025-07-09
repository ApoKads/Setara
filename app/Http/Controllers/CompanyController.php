<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Location;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $query = Company::query()->withCount('jobTypes');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $companies = $query->get();

        return view('AdminSide.admin', compact('companies'));
    }

    public function create()
{
    $locations = Location::all();
    $categories = \App\Models\Category::all();

    return view('AdminSide.companyform', [
        'company' => null,
        'locations' => $locations,
        'categories' => $categories
    ]);
}

    public function store(Request $request)
{
    $validated = $request->validate([
        'nama_perusahaan' => 'required|string|max:255',
        'telepon' => 'required|digits_between:10,15',
        'email' => 'required|email',
        'website' => 'nullable|string',
        'jalan' => 'required|string',
        'provinsi' => 'required|string',
        'kota' => 'required|string',
        'kode_pos' => 'nullable|digits:5',
        'nib' => 'required|digits:13',
        'npwp' => 'required|digits:16',
        'akta' => 'required|file|mimes:pdf,png,jpeg,jpg',
        'tdp' => 'required|file|mimes:pdf,png,jpeg,jpg',
        'nama_hrd' => 'required|string',
        'telepon_hrd' => 'required|digits_between:10,15',
        'deskripsi' => 'required|string',
        'categories' => 'required|array',
        'categories.*' => 'exists:categories,id',
    ]);

    $aktaPath = $request->file('akta') ? $request->file('akta')->store('legalitasCompany', 'public') : null;
    $tdpPath = $request->file('tdp') ? $request->file('tdp')->store('legalitasCompany', 'public') : null;

    $company = new Company();
    $company = new Company();
    $company->user_id = auth()->id();
    $company->slug = Str::slug($validated['nama_perusahaan']) . '-' . uniqid();
    $company->name = $validated['nama_perusahaan'];
    $company->telepon = $validated['telepon'];
    $company->email = $validated['email'];
    $company->website = $validated['website'];
    $company->jalan = $validated['jalan'];
    $company->provinsi = $validated['provinsi'];
    $company->kota = $validated['kota'];
    $company->location = $validated['kota'];
    $company->kode_pos = $validated['kode_pos'];
    $company->nib = $validated['nib'];
    $company->npwp = $validated['npwp'];
    $company->akta = $aktaPath;
    $company->tdp = $tdpPath;
    $company->nama_hrd = $validated['nama_hrd'];
    $company->telepon_hrd = $validated['telepon_hrd'];
    $company->description = $validated['deskripsi'];
    $company->save();

    $company->categories()->sync($validated['categories']);

    return redirect()->route('admin.dashboard')->with('success', 'Data perusahaan berhasil disimpan.');
}


    public function show($id)
    {
        $company = Company::findOrFail($id);
        return view('AdminSide.companyshow', compact('company'));
    }

    public function edit($id)
{
    $company = Company::findOrFail($id);
    $locations = Location::all();
    $categories = \App\Models\Category::all();

    return view('AdminSide.companyform', [
        'company' => $company,
        'locations' => $locations,
        'categories' => $categories
    ]);
}

    public function update(Request $request, $id)
{
    $company = Company::findOrFail($id);

    $validated = $request->validate([
        'nama_perusahaan' => 'required|string|max:255',
        'telepon' => 'required|digits_between:10,15',
        'email' => 'required|email',
        'website' => 'nullable|string',
        'jalan' => 'required|string',
        'provinsi' => 'required|string',
        'kota' => 'required|string',
        'kode_pos' => 'nullable|digits:5',
        'nib' => 'required|digits:13',
        'npwp' => 'required|digits:16',
        'akta' => 'required|file|mimes:pdf,png,jpeg,jpg',
        'tdp' => 'required|file|mimes:pdf,png,jpeg,jpg',
        'nama_hrd' => 'required|string',
        'telepon_hrd' => 'required|digits_between:10,15',
        'deskripsi' => 'required|string',
        'categories' => 'required|array',
        'categories.*' => 'exists:categories,id',
    ]);

    $company->slug = Str::slug($validated['nama_perusahaan']) . '-' . uniqid();
    $company->name = $validated['nama_perusahaan'];
    $company->telepon = $validated['telepon'];
    $company->email = $validated['email'];
    $company->website = $validated['website'];
    $company->jalan = $validated['jalan'];
    $company->provinsi = $validated['provinsi'];
    $company->kota = $validated['kota'];
    $company->location = $validated['kota'];
    $company->kode_pos = $validated['kode_pos'];
    $company->nib = $validated['nib'];
    $company->npwp = $validated['npwp'];
    $company->description = $validated['deskripsi'];

    if ($request->hasFile('akta')) {
        $aktaPath = $request->file('akta')->store('legalitasCompany', 'public');
        $company->akta = $aktaPath;
    }

    if ($request->hasFile('tdp')) {
        $tdpPath = $request->file('tdp')->store('legalitasCompany', 'public');
        $company->tdp = $tdpPath;
    }

    $company->nama_hrd = $validated['nama_hrd'];
    $company->telepon_hrd = $validated['telepon_hrd'];
    $company->save();

    $company->categories()->sync($validated['categories']);

    return redirect()->route('admin.dashboard')->with('success', 'Data perusahaan berhasil diperbarui.');
}

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Perusahaan berhasil dihapus.');
    }
}
