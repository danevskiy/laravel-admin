<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\CompanyEmail;
use DataTables;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
        $companies = Company::query();
        return DataTables::of($companies)
        ->addIndexColumn()
        ->addColumn('action', function($company){
        return '<a href="'.route('company.edit', $company->id).'" class="btn btn-success btn-sm">Edit</a> <button  data-id="'.$company->id.'" class="btn btn-danger btn-sm delete-it">Delete</button>';
        })
        ->make(true);
        }

        return view('company.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create', [
            'data' => []
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
        'name' => 'required',
        'email' => 'string|nullable',
        'website' => 'string|nullable',
        'logo' => [
            'nullable',
            'image',
            'mimes:jpeg,png,jpg,gif,svg',
            'dimensions:min_width=100,min_height=100', 
        ],
        ]);


        $imagePath = null;

        if ($request->hasFile('logo')) {
            $imagePath = $request->file('logo')->store('companies', 'public');
        }

        $company = new Company;

        $company->name = $validated['name'];
        $company->email = $validated['email'];
        $company->website = $validated['website'];
        $company->logo = $imagePath;

        $company->save();

        Mail::to('danewskiy.work@gmail.com')->send(new CompanyEmail());


        return redirect()->route('companies')->with('success', 'Company created successfully!');

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

        $data = Company::findOrFail($id);

        return view('company.edit', [
            'data' => $data,
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
        'name' => 'required',
        'email' => 'string|nullable',
        'website' => 'string|nullable',
        'logo' => [
            'nullable',
            'image',
            'mimes:jpeg,png,jpg,gif,svg',
            'dimensions:min_width=100,min_height=100', 
        ],
        ]);


        $imagePath = null;

        if ($request->hasFile('logo')) { 
             $imagePath = $request->file('logo')->store('companies', 'public');   
             $validated['logo'] = $imagePath;
        }

        $company = Company::findOrFail($id);

        

        

        $company->update($validated);

       
        return redirect()->route('company.edit', $company->id)->with('success', 'Company updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);

        if($company){
            $company->delete();
            return response(['status' => 'success', 'message' => 'Company deleted succesfully!']);
        }

         return response(['status' => 'failed', 'message' => 'Unable to delete company!']);
    }
}
