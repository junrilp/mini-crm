<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Mail\CompanyEmailNotification;
use App\Models\Employee;
use Illuminate\Support\Facades\Mail;
use Storage;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the company.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::where(function ($query) {
            $query->where('name', 'like', '%'.request('q').'%');
        })->paginate();

        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new company.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', new Company);

        return view('companies.create');
    }

    /**
     * Store a newly created company in storage.
     *
     * @param \App\Http\Requests\CompanyCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyCreateRequest $request)
    {
        try {
            $newCompany = $request->validated();

            $fileName = $request->logo->getClientOriginalName();

            if (Storage::disk('public')->exists($fileName)) {
                Storage::disk('public')->delete($fileName);
            }

            $request->logo->move(public_path('images'), $fileName);

            $newCompany['logo'] = $fileName;
            $company = Company::create($newCompany);

            Mail::to('junril090693@gmail.com')->send(new CompanyEmailNotification($request->name));

            flash()->success('Your item has been saved successfully!');

            return redirect()->route('companies.index', $company);
        } catch(\Exception $e) {
            dd($e->getMessage());
        }

    }

    /**
     * Display the specified company.
     *
     * @param \App\Company $company
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $employees = $company->employees()->where(function ($query) {
            $searchQuery = request('q');
            $query->where('first_name', 'like', '%'.$searchQuery.'%');
            $query->orWhere('last_name', 'like', '%'.$searchQuery.'%');
        })->paginate();

        return view('companies.show', compact('company', 'employees'));
    }

    /**
     * Show the form for editing the specified company.
     *
     * @param \App\Company $company
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        $this->authorize('update', $company);

        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified company in storage.
     *
     * @param \App\Http\Requests\CompanyUpdateRequest $request
     * @param \App\Company                            $company
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyUpdateRequest $request, Company $company)
    {
        $newCompany = $request->validated();

        $fileName = $company->logo;

        if($request->file('logo') != null) {
            $fileName = $request->logo->getClientOriginalName();

            if (Storage::disk('public')->exists($fileName)) {
                Storage::disk('public')->delete($fileName);
            }

            $request->logo->move(public_path('images'), $fileName);

            $newCompany['logo'] = $fileName;
        }

        $company->update($newCompany);


        flash()->success('Your item has been updated successfully!');

        return redirect()->route('companies.index', $company);
    }

    /**
     * Remove the specified company from storage.
     *
     * @param \App\Company $company
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $this->authorize('delete', $company);

        $this->validate(request(), [
            'company_id' => 'required',
        ]);

        flash()->deleted('Your item has been deleted successfully!');

        if (request('company_id') == $company->id && $company->delete()) {
            Employee::where('company_id', $company->id)->delete();
            return redirect()->route('companies.index');
        }

        return back();
    }
}
