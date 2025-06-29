<?php

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'telepon' => 'required|string',
            'email' => 'required|email',
            'website' => 'nullable|url',
            'jalan' => 'required|string',
            'provinsi' => 'required|string',
            'kota' => 'required|string',
            'kode_pos' => 'nullable|string',
            'nib' => 'required|string',
            'npwp' => 'required|string',
            'akta' => 'required|file|mimes:pdf,png,jpeg,jpg',
            'tdp' => 'required|file|mimes:pdf,png,jpeg,jpg',
            'nama_hrd' => 'required|string',
            'telepon_hrd' => 'required|string',
        ]);

        $aktaPath = $request->file('akta')->store('legalitasCompany', 'public');
        $tdpPath = $request->file('tdp')->store('legalitasCompany', 'public');

        $company = new Company();
        $company->name = $validated['name'];
        $company->telepon = $validated['telepon'];
        $company->email = $validated['email'];
        $company->website = $validated['website'];
        $company->jalan = $validated['jalan'];
        $company->provinsi = $validated['provinsi'];
        $company->kota = $validated['kota'];
        $company->kode_pos = $validated['kode_pos'];
        $company->nib = $validated['nib'];
        $company->npwp = $validated['npwp'];
        $company->akta = $aktaPath;
        $company->tdp = $tdpPath;
        $company->nama_hrd = $validated['nama_hrd'];
        $company->telepon_hrd = $validated['telepon_hrd'];
        $company->save();

        return redirect()->back()->with('success', 'Data perusahaan berhasil disimpan.');
    }
}