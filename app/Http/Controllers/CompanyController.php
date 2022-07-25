<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $companies = Company::paginate(12);
        return Inertia::render('Company/Index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return Inertia::render('Company/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCompanyRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCompanyRequest $request)
    {
        $company = Company::create($request->validated());
        $this->uploadImage($request, $company);
        return redirect()->route('companies.index')->with('success', 'Create company success.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Company $company
     * @return Response
     */
    public function edit(Company $company)
    {
        return Inertia::render('Company/Edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCompanyRequest $request
     * @param Company $company
     * @return RedirectResponse
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $company->update($request->validated());
        $this->uploadImage($request, $company);
        return redirect()->route('companies.index')->with('success', 'Update company success.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @return RedirectResponse
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Delete company success.');
    }

    /**
     * @param UpdateCompanyRequest|StoreCompanyRequest $request
     * @param Company $company
     * @return void
     */
    protected function uploadImage(UpdateCompanyRequest|StoreCompanyRequest $request, Company $company): void
    {
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $path = $file->store('companies');
            $company->logo = $path;
            $company->save();
        }
    }
}
