<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EmployeeStoreRequest;
use App\Models\Employee;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $reques)
    {
        $term = $request->input('term');

        $employees = Employee::with('company')
            ->when($term, function ($query, $term) {
                $query->where('first_mame', 'LIKE', '%' . $term . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $term . '%')
                    ->orWhere('email', 'LIKE', '%' . $term . '%');
            })
            ->latest()
            ->paginate(10);

        return Inertia::render('Employee/Index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Employee/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeStoreRequest $request)
    {
        $validatedData = $request->validated();

        
        Employee::create($validatedData);

        return redirect()->route('employees.index')->with('success', 'Employee has been created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $getEmployee = Employee::findOrFail($id);

        return Inertia::render('Employee/Show', compact('getEmployee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::findOrFail($id);

        return Inertia::render('Employee/Edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Employee::where('id', $id)->update($request->all());

        return redirect('/employees')->with('success', 'Employee has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Employee::destroy($id);

        return back()->with('delete', 'Employee has been deleted!');
    }
}
