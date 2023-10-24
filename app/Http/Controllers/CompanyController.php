<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CompanyStoreRequest;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $reques)
    {
        $term = $request->input('term');

        $companies = Company::all()
            ->when($term, function ($query, $term) {
                $query->where('name', 'LIKE', '%' . $term . '%')
                    ->orWhere('email', 'LIKE', '%' . $term . '%');
            })
            ->latest()
            ->paginate(10);

        return Inertia::render('Company/Index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Company/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyStoreRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('logo')) {
            $avatarPath = $request->file('logo')->store('public/logos');
            $validatedData['avatar'] = Storage::url($avatarPath);
        }
        
        Company::create($validatedData);

        return redirect()->route('companies.index')->with('success', 'Company has been created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $getCompany = User::findOrFail($id);

        return Inertia::render('Company/Show', compact('getCompany'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company = Company::findOrFail($id);

        return Inertia::render('Company/Edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Company::where('id', $id)->update($request->all());

        return redirect('/companies')->with('success', 'Company has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Company::destroy($id);

        return back()->with('delete', 'Company has been deleted!');
    }
}
