<?php

namespace App\Http\Controllers;

use App\Models\Employee;
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
  return view('index');
 }

 public function popup()
 {
  return view('popup');
 }

 public function sendMail()
 {
  return redirect('/');
 }

 /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function create()
 {
  //
 }

 /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
 public function store(Request $request)
 {
  Employee::create($request->all());
  return redirect('popup');
 }

 /**
  * Display the specified resource.
  *
  * @param  \App\Models\Employee  $employee
  * @return \Illuminate\Http\Response
  */
 public function show(Employee $employee)
 {
  //
 }

 /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Models\Employee  $employee
  * @return \Illuminate\Http\Response
  */
 public function edit(Employee $employee)
 {
  //
 }

 /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Models\Employee  $employee
  * @return \Illuminate\Http\Response
  */
 public function update(Request $request, Employee $employee)
 {
  //
 }

 /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Models\Employee  $employee
  * @return \Illuminate\Http\Response
  */
 public function destroy(Employee $employee)
 {
  //
 }
}
