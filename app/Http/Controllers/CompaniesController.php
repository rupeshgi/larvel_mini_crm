<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CompaniesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
            $data['companys'] = Companies::orderBy('id','desc')->paginate(10);

            return view('companies.index', $data);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            
        ]);
  
        $input = $request->all();
  
        if ($image = $request->file('company_logo')) {
           

            $file = $request->file('company_logo');
            $filename = $file->getClientOriginalName();
            $file->storeAs('public/images',$filename);

            $input['company_logo'] = "$filename";
        }
    
        Companies::create($input);
     
        return redirect()->route('company.index')
                        ->with('success','companies created successfully.');
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result['companies'] = DB::table('companies')->where('id', $id)->get();
        
        
                return view('companies.edit',$result);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        

         // dd($request);
        $request->validate([
            'name' => 'required',
        ]);
                $company = Companies::find($id);
                
                $company->name = $request->name;
                $company->email = $request->email;
                $company->website = $request->website;
                $company->email = $request->email;

        if ($image = $request->file('company_logo')) {
            $file = $request->file('company_logo');
            $filename = $file->getClientOriginalName();
            $file->storeAs('public/images',$filename);

            $company->company_logo = "$filename";
        }else{
            unset($company->company_logo);
        }
        
                $company->save();

                return redirect()->route('company.index')
                        ->with('success','companies updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('companies')->where('id',$id)->delete();
     
        return redirect()->route('company.index')
                        ->with('success','companies deleted successfully');

    }
}
