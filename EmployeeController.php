<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::all();

        return view('employee.table',compact('employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchemployee()
    {
        $employee = Employee::get();
        return response()->json([
            'employee' => $employee
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'gender' => 'required',
            'image' => 'required| image | mimes:jpg, jpeg, png| max:4048',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->messages()
            ]);
        } else {
            $employee = new Employee;
            $employee->name = $request->input('name');
            $employee->gender = $request->input('gender');

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('images/employee/', $filename);
                $employee->image = $filename;
            }
            $employee->save();
            return response()->json([
                'status' => 200,
                'message' => 'Employee Data Add Successfully'
            ]);
        };
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
        $employee = Employee::find($id);
        if ($employee) {
            return response()->json([
                'status' => 200,
                'employee' => $employee
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Employee Not Found'
            ]);
        }
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'gender' => 'required',
        ]);
        if ($validator->fails()) 
        {
            return response()->json([
                'status' => 400,
                'error' => $validator->messages()
            ]);
        } 
        else 
        {
            $employee = Employee::find($id);
            if ($employee) {
                $employee->name = $request->input('name');
                $employee->gender = $request->input('gender');

                if ($request->hasFile('image')) {
                    $path = 'images/employee/' . $employee->image;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $file = $request->file('image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('images/employee/', $filename);
                    $employee->image = $filename;
                }
                $employee->save();
                return response()->json([
                    'status' => 200,
                    'message' => 'Employee Data Updated Successfully'
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Employee Not Found'
                ]);
            }
        };
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
        if ($employee) {
            $path = 'images/employee/' . $employee->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $employee->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Employee Data Deleted Successfully'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Employee Not Found'
            ]);
        }
    }
}
