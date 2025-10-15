<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginate_companies = Company::paginate(10);

        return view('company.index', [
            'companies' => $paginate_companies
        ]);
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


        $imagePath = null; // Initialize the path variable

        if ($request->hasFile('logo')) {
            // Only run store() if the file exists and passed validation
            $imagePath = $request->file('logo')->store('companies', 'public');
        }

        $company = new Company;

        $company->name = $validated['name'];
        $company->email = $validated['email'];
        $company->website = $validated['website'];
        $company->logo = $imagePath;

        $company->save();


        return redirect()->route('companies')->with('success', 'Post created successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Company::findOrFail($id);

        $company = new \stdClass();
        $company->email = $data->email;
        $company->name = $data->name;
        $company->website = $data->website;
        $company->logo = $data->logo;

        return view('company.show', [
            'data' => $company
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
