<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Employee;
use Illuminate\Support\Facades\Storage;
use App\Models\Company;
use DataTables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
        $companies = Employee::query();
        return DataTables::of($companies)
        ->addIndexColumn()
        ->addColumn('action', function($employee){
        return '<a href="'.route('employee.edit', $employee->id).'" class="btn btn-success btn-sm">Edit</a> <button  data-id="'.$employee->id.'" class="btn btn-danger btn-sm delete-it">Delete</button>';
        })
        ->make(true);
        }

        return view('employee.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();

        return view('employee.create', [
            'companies' => $companies
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'string|nullable',
        'phone' => 'string|nullable',
        'company_id' => 'nullable|integer',
        ]);

        $employee = new Employee;

        $employee->first_name = $validated['first_name'];
        $employee->last_name = $validated['last_name'];
        $employee->email = $validated['email'];
        $employee->phone = $validated['phone'];
        $employee->company_id = $validated['company_id'];
        

        $employee->save();


        return redirect()->route('employees')->with('success', 'Employee created successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {

        $data = Employee::findOrFail($id);
        $companies = Company::all();

        return view('employee.edit', [
            'data' => $data,
            'companies' => $companies,
            'id' => $id
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'string|nullable',
        'phone' => 'string|nullable',
        'company_id' => 'string|nullable',
        ]);

        $employee = Employee::findOrFail($id);

        

        

        $employee->update($validated);

       
        return redirect()->route('employee.edit', $employee->id)->with('success', 'Employee updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Employee::findOrFail($id);

        if($company){
            $company->delete();
            return response(['status' => 'success', 'message' => 'Employee deleted succesfully!']);
        }

        return response(['status' => 'failed', 'message' => 'Unable to delete employee!']);
    }
}
