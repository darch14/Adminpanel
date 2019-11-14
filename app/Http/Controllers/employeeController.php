<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Company;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class employeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $company = Company::find($id);
        return view('employees.addEmployees')
            ->with('company', $company);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'first_name' =>$request->input('first_name'),
            'last_name' =>$request->input('last_name'),
            'email' =>$request->input('email')
        ];
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'email|max:40'
        ];
        $validator = Validator::make($data, $rules);
        if ($validator -> fails()) {
            return redirect()->back()
              ->withErrors($validator->errors())
              ->withInput();;
        }
        $employee = new Employee($request -> all());
        $employee->save();

        return redirect()->route('listEmployee', $employee->company_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::find($id);
        $employees = $company->employees()->paginate(10);
        return view('employees.listEmployees')
            ->with('company', $company)
            ->with('employees', $employees)
            ->with('render', $employees->render());
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);
        return view('employees.editEmployees')
            ->with('employee', $employee);
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
        $employee = Employee::find($id);
        $data = [
            'first_name' =>$request->input('first_name'),
            'last_name' =>$request->input('last_name'),
            'email' =>$request->input('email')
        ];
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'email|max:40'
        ];
        $validator = Validator::make($data, $rules);
        if ($validator -> fails()) {
            return redirect()->back()
              ->withErrors($validator->errors())
              ->withInput();;
        }
        $employee->update($request->all());
        return redirect()->route('listEmployee', $employee->company_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $company = $employee->company_id;
        $employee->delete();
        return redirect()->route('listEmployee', $company);
    }
}
