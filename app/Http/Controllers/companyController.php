<?php

namespace App\Http\Controllers;

use App\company;
use Validator;
use Illuminate\Http\Request;

class companyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = company::orderBy('id', 'ASC')->get();
        return view('companies.home')->with('companies', $companies);
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
        dd($request->input('name'));
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
        //$this->validate($request, $rules, $messages);
        $validator = Validator::make($data, $rules);
        // dd($validator);
        if ($validator -> fails()) {
            return redirect()->back()
              ->withErrors($validator->errors());
        }

        $company = new company($request -> all());
        $file = $request->file('file');
        $name = 'Company_' . time() . '.' . $file->getClientOriginalName();
        $path = storage_path('app/public') . '/logos';
        $file->move($path, $name);
        $company->logo = $name;
        $company->save();

        return redirect()->route('home')
                ->with('notification', '¡Se a Guardado satisfactoriamente!');
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
        $company = company::find($id);

        if (!empty($request->file)) {
            // $file = $request->file('file');
            // $name = 'Company_' . time() . '.' . $file->getClientOriginalName();
            // $path = storage_path('app\public') . '/logos';
            // $file->move($path, $name);

            if (!empty($company->logo)) {
                dd('no esta vacio');
            //   Storage::disk('public')->delete('\images\asesores'."\\".$images[0]->name);
            //   $images[0]->update(['name' => $name]);
            }else{
                dd('si esta vacio');
            //   $images = new image();
            //   $images->name = $name;
            //   $images->advisor_id = $advisor->id;
            //   $images->save();
            }
        }
        $company->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = advisor::find($id);
        $path = '\images\asesores';
        Storage::disk('public')->delete($path."\\".$company->logo);
        $company->delete();
        return redirect()->route('AdvisorAdmin.index')
            ->with('', '');
    }
}
