<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use App\Http\Requests\EmployeeCreateRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the employee.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $editableEmployee = null;
        $companyList = Company::pluck('name', 'id');

        $employeeQuery = Employee::where(function ($query) {
            $searchQuery = request('q');
            $query->where('first_name', 'like', '%'.$searchQuery.'%');
            $query->orWhere('last_name', 'like', '%'.$searchQuery.'%');
        });

        if ($companyId = request('company_id')) {
            $employeeQuery->where('company_id', $companyId);
        }

        $employees = $employeeQuery->with('company')->paginate();

        if (in_array(request('action'), ['edit', 'delete']) && request('id') != null) {
            $editableEmployee = Employee::find(request('id'));
        }

        return view('employees.index', compact('employees', 'editableEmployee', 'companyList'));
    }

    /**
     * Show the form for creating a new employee.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', new Employee);
        $company = Company::all();
        return view('employees.create')->with(['companies' => $company]);
    }

    /**
     * Store a newly created employee in storage.
     *
     * @param \App\Http\Requests\EmployeeCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeCreateRequest $request)
    {
        $newEmployee = $request->validated();
        
        Employee::create($newEmployee);

        flash()->success('Your item has been saved successfully!');

        return redirect()->route('employees.index');
    }

     /**
     * Show the form for editing the specified employee.
     *
     * @param \App\Employee $employee
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        $this->authorize('update', $employee);
        $company = Company::all();

        return view('employees.edit', compact('employee'))->with(['companies' => $company]);;
    }

    /**
     * Update the specified employee in storage.
     *
     * @param \App\Http\Requests\EmployeeUpdateRequest $request
     * @param \App\Employee                            $employee
     *
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeUpdateRequest $request, Employee $employee)
    {
        $this->authorize('update', $employee);

        $employeeData = $request->validated();
        $employee->update($employeeData);

        flash()->success('Your item has been updated successfully!');

        return redirect()->route('employees.index');
    }

    /**
     * Remove the specified employee from storage.
     *
     * @param \App\Employee $employee
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $this->authorize('delete', $employee);

        $this->validate(request(), [
            'employee_id' => 'required',
        ]);

        flash()->deleted('Your item has been deleted successfully!');

        if (request('employee_id') == $employee->id && $employee->delete()) {
            return redirect()->route('employees.index');
        }

        return back();
    }
}
