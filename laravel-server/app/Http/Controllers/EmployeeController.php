<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Employee as EmployeeResource;
use App\Employee;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EmployeeResource::collection(Employee::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'fullName'=>'required',
            'email'=>'required',
            'mobile'=>'required',
            'city'=>'required',
            'gender'=>'required',
            'departement'=>'required',
            'hireDate'=>'required',
            'status'=>'required'
        ]);
        $employee = new Employee([
            'fullName'=>$request->fullName,
            'email'=>$request->email,
            'mobile'=>$request->mobile,
            'city'=>$request->city,
            'gender'=>$request->gender,
            'departement'=>$request->departement,
            'hireDate'=>$request->hireDate,
            'status'=>$request->status
        ]);
        $employee->save();
        return response()->json([
            'data'=>'Employee created'
        ]);
    }

    public function edit($id)
    {
    return new EmployeeResource(Employee::findOrFail($id));
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
        $request->validate([
            'fullName'=>'required',
            'email'=>'required',
            'mobile'=>'required',
            'city'=>'required',
            'gender'=>'required',
            'departement'=>'required',
            'hireDate'=>'required',
            'status'=>'required'
        ]);
        $employee = Employee::findOrFail($id);
        $employee->fullName = $request->fullName;
        $employee->email = $request->email;
        $employee->mobile = $request->mobile;
        $employee->city = $request->city;
        $employee->gender = $request->gender;
        $employee->departement = $request->departement;
        $employee->hireDate = $request->hireDate;
        $employee->status = $request->status;
        $employee->save();
        return response()->json([
            'data'=>'E mployee updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return response()->json([
            'data' => 'Employee deleted'
        ]);
    }
}
