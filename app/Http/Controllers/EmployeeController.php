<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\Companies;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data['empl']= Employees::Join('companies', 'employees.company', '=', 'companies.id')
            ->select('employees.*','companies.name')
            ->orderBy('id','desc')->paginate(10);

    
            return view('employee.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $result['company'] = DB::table('companies')->get();

        return view('employee.create',$result);
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
            'first_name' => 'required',
            'last_name' => 'required',
            ]);
            $employee = new Employees;
            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->company = $request->company;
            $employee->email = $request->email;
            $employee->phone = $request->phone;

            $employee->save();

            return redirect()->route('employee.index')
            ->with('success','Employee has been created successfully.');
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $result['emp'] = DB::table('employees')->where('id', $id)->get();

        $result['company'] = DB::table('companies')->get();
        
            return view('employee.edit',$result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
        ]);
                $employee = Employees::find($id);
                
                $employee->first_name = $request->first_name;
                $employee->last_name = $request->last_name;
                $employee->company = $request->company;
                $employee->email = $request->email;
                $employee->phone = $request->phone;

                $employee->save();

                return redirect()->route('employee.index')
                ->with('success','Employee Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        DB::table('employees')->where('id',$id)->delete();

            return redirect()->route('employee.index')
                ->with('success','Employee has been deleted successfully');
    }
}
