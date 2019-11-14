<?php

namespace App\Http\Controllers;

use App\company;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class companyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = company::orderBy('id', 'ASC')->paginate(10);
        return view('companies.home')
            ->with('companies', $companies)
            ->with('render', $companies->render());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.addCompany');
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
            'name' =>$request->input('name'),
            'email' =>$request->input('email'),
            'file' =>$request->file('file')
        ];
        $rules = [
            'name' => 'required',
            'email' => 'email|max:40',
            'file' => 'dimensions:min_width=100,min_height=100'
        ];
        $validator = Validator::make($data, $rules);
        if ($validator -> fails()) {
            return redirect()->back()
              ->withErrors($validator->errors())
              ->withInput();;
        }

        $company = new company($request -> all());
        $file = $request->file('file');
        $name = 'Company_' . time() . '.' . $file->getClientOriginalName();
        $path = storage_path('app/public') . '/logos';
        $file->move($path, $name);
        $company->logo = $name;
        $company->save();

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = company::find($id);
        return view('companies.editCompany')
            ->with('company', $company);
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
        $data = [
            'name' =>$request->input('name'),
            'email' =>$request->input('email'),
            'file' =>$request->file('file')
        ];
        if (!empty($request->file)) {
            $rules = [
                'name' => 'required',
                'email' => 'email|max:40',
                'file' => 'dimensions:min_width=100,min_height=100'
            ];
        }else{
            $rules = [
                'name' => 'required',
                'email' => 'email|max:40'
            ];
        }
        $validator = Validator::make($data, $rules);
        if ($validator -> fails()) {
            return redirect()->back()
              ->withErrors($validator->errors())
              ->withInput();;
        }

        $company = company::find($id);
        if (!empty($request->file)) {
            $file = $request->file('file');
            $name = 'Company_' . time() . '.' . $file->getClientOriginalName();
            $path = storage_path('app\public') . '/logos';
            $file->move($path, $name);

            if (!empty($company->logo)) {
                // dd('1');
                Storage::disk('public')->delete('\logos'."\\".$company->logo);
                $company->update(['logo' => $name]);
            }else{
                // dd('2');
                $company->logo = $name;
            }
        }
        $company->update($request->all());
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = company::find($id);
        $path = '\logos';
        Storage::disk('public')->delete($path."\\".$company->logo);
        $company->delete();
        return redirect()->route('home');
    }
}
