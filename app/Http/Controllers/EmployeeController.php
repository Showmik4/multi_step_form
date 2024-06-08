<?php

namespace App\Http\Controllers;

use App\Mail\FormMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Answer;
use App\Models\Employee;
use App\Models\PeopleInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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
      // Validate the incoming request data
      $validated = $request->validate([
          'first_name' => 'required',
          'last_name' => 'required',
          'email' => 'required|email',          
      ]);

      DB::beginTransaction();
      try {
          // Create a new PeopleInfo record
          $people_info = PeopleInfo::create([
              'first_name' => $validated['first_name'],
              'last_name' => $validated['last_name'],      
              'email' => $validated['email'],        
          ]);

          // Collect answers
          $answers = [
              '1' => $request->input('marks1'),
              '2' => $request->input('marks2'),
              '3' => $request->input('marks3'),
              '4' => $request->input('marks4'),
              '5' => $request->input('marks5'),
              '6' => $request->input('marks6'),
          ];

          $total_marks = [
            '1' => $request->input('total_marks1'),
            '2' => $request->input('total_marks2'),
            '3' => $request->input('total_marks3'),
            '4' => $request->input('total_marks4'),
            '5' => $request->input('total_marks5'),
            '6' => $request->input('total_marks6'),
        ];


          $totalMarks = 0;
          $totalPossibleScore=0;
          $answerDetails = [];
        
          foreach ($answers as $key => $answer) {
              if ($answer !== null) {
                  $totalMarks += (int)$answer;
                  $totalPossibleScore+=(int)$total_marks[$key];
                  $answerDetails[] = Answer::create([
                      'people_id' => $people_info->id,
                      'question' => $key,
                      'marks' => $answer,
                      'total_marks'=>$total_marks[$key],
                  ]);
              }
          }

          $totalAverageMarks = $totalPossibleScore > 0 ? ($totalMarks / $totalPossibleScore) * 100 : 0;

          $people_info->update([
            'total_marks'=>$totalAverageMarks,
          ]);

          DB::commit(); 
          Mail::to($validated['email'])->send(new FormMail($answerDetails, $people_info, $validated['email']));
          return redirect()->back()->with('success', 'Survey answers saved successfully and email sent!');
      } catch (\Exception $e) {
          DB::rollBack(); 
          return redirect()->back()->with('error', 'Failed to save survey answers.');
      }
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
