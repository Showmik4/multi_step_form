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

              '7' => $request->input('marks7'),
              '8' => $request->input('marks8'),
              '9' => $request->input('marks9'),
              '10' => $request->input('marks10'),
              '11' => $request->input('marks11'),
              '12' => $request->input('marks12'),

              '13' => $request->input('marks13'),
              '14' => $request->input('marks14'),
              '15' => $request->input('marks15'),
              '16' => $request->input('marks16'),
              '17' => $request->input('marks17'),
              '18' => $request->input('marks18'),

              '19' => $request->input('marks19'),
              '20' => $request->input('marks20'),
              '21' => $request->input('marks21'),
              '22' => $request->input('marks22'),
              '23' => $request->input('marks23'),
              '24' => $request->input('marks24'),

              '25' => $request->input('marks25'),

              '26' => $request->input('marks26'),
              '27' => $request->input('marks27'),
              '28' => $request->input('marks28'),
              '29' => $request->input('marks29'),
              '30' => $request->input('marks30'),

              '31' => $request->input('marks31'),
              '32' => $request->input('marks32'),
              '33' => $request->input('marks33'),
              '35' => $request->input('marks35'),
              '36' => $request->input('marks36'),
              '37' => $request->input('marks37'),

              '38' => $request->input('marks38'),
              '39' => $request->input('marks39'),
              '40' => $request->input('marks40'),
              '41' => $request->input('marks41'),
              '42' => $request->input('marks42'),
              '43' => $request->input('marks43'),

              '44' => $request->input('marks44'),
              '45' => $request->input('marks45'),
              '46' => $request->input('marks46'),
              '47' => $request->input('marks47'),
              '48' => $request->input('marks48'),
              '49' => $request->input('marks49'),

              '50' => $request->input('marks50'),
              '51' => $request->input('marks51'),
              '52' => $request->input('marks52'),
              '53' => $request->input('marks53'),
              '54' => $request->input('marks54'),
              '55' => $request->input('marks55'),

              '56' => $request->input('marks56'),
              '57' => $request->input('marks57'),
              '58' => $request->input('marks58'),
              '59' => $request->input('marks59'),
              '60' => $request->input('marks60'),
              '61' => $request->input('marks61'),

              '62' => $request->input('marks62'),
              '63' => $request->input('marks63'),
              '64' => $request->input('marks64'),
              '65' => $request->input('marks65'),
              '66' => $request->input('marks66'),
              '67' => $request->input('marks67'),

              '68' => $request->input('marks68'),
              '69' => $request->input('marks69'),
              '70' => $request->input('marks70'),
              '71' => $request->input('marks71'),
              '72' => $request->input('marks72'),
              '73' => $request->input('marks73'),

              '74' => $request->input('marks74'),
              '75' => $request->input('marks75'),
              '76' => $request->input('marks76'),
              '77' => $request->input('marks77'),
              '78' => $request->input('marks78'),
              '79' => $request->input('marks79'),

              '80' => $request->input('marks80'),
              '81' => $request->input('marks81'),
              '82' => $request->input('marks82'),
              '83' => $request->input('marks83'),
              '84' => $request->input('marks84'),
              '85' => $request->input('marks85'),

              '86' => $request->input('marks86'),
              '87' => $request->input('marks87'),
              '88' => $request->input('marks88'),
              '89' => $request->input('marks89'),
              '90' => $request->input('marks90'),
              '91' => $request->input('marks91'),

              '92' => $request->input('marks92'),
              '93' => $request->input('marks93'),
              '94' => $request->input('marks94'),
              '95' => $request->input('marks95'),
              '96' => $request->input('marks96'),
              '97' => $request->input('marks97'),

              '98' => $request->input('marks98'),
              '99' => $request->input('marks99'),           
          ];

          $total_marks = [
            '1' => $request->input('total_marks1'),
            '2' => $request->input('total_marks2'),
            '3' => $request->input('total_marks3'),
            '4' => $request->input('total_marks4'),
            '5' => $request->input('total_marks5'),
            '6' => $request->input('total_marks6'),

            '7' => $request->input('total_marks7'),
            '8' => $request->input('total_marks8'),
            '9' => $request->input('total_marks9'),
            '10' => $request->input('total_marks10'),
            '11' => $request->input('total_marks11'),
            '12' => $request->input('total_marks12'),

            '13' => $request->input('total_marks13'),
            '14' => $request->input('total_marks14'),
            '15' => $request->input('total_marks15'),
            '16' => $request->input('total_marks16'),
            '17' => $request->input('total_marks17'),
            '18' => $request->input('total_marks18'),

            '19' => $request->input('total_marks19'),
            '20' => $request->input('total_marks20'),
            '21' => $request->input('total_marks21'),
            '22' => $request->input('total_marks22'),
            '23' => $request->input('total_marks23'),
            '24' => $request->input('total_marks24'),

            '25' => $request->input('total_marks25'),

            '26' => $request->input('total_marks26'),
            '27' => $request->input('total_marks27'),
            '28' => $request->input('total_marks28'),
            '29' => $request->input('total_marks29'),
            '30' => $request->input('total_marks30'),

            '31' => $request->input('total_marks31'),
            '32' => $request->input('total_marks32'),
            '33' => $request->input('total_marks33'),
            '35' => $request->input('total_marks35'),
            '36' => $request->input('total_marks36'),
            '37' => $request->input('total_marks37'),

            '38' => $request->input('total_marks38'),
            '39' => $request->input('total_marks39'),
            '40' => $request->input('total_marks40'),
            '41' => $request->input('total_marks41'),
            '42' => $request->input('total_marks42'),
            '43' => $request->input('total_marks43'),

            '44' => $request->input('total_marks44'),
            '45' => $request->input('total_marks45'),
            '46' => $request->input('total_marks46'),
            '47' => $request->input('total_marks47'),
            '48' => $request->input('total_marks48'),
            '49' => $request->input('total_marks49'),

            '50' => $request->input('total_marks50'),
            '51' => $request->input('total_marks51'),
            '52' => $request->input('total_marks52'),
            '53' => $request->input('total_marks53'),
            '54' => $request->input('total_marks54'),
            '55' => $request->input('total_marks55'),

            '56' => $request->input('total_marks56'),
            '57' => $request->input('total_marks57'),
            '58' => $request->input('total_marks58'),
            '59' => $request->input('total_marks59'),
            '60' => $request->input('total_marks60'),
            '61' => $request->input('total_marks61'),

            '62' => $request->input('total_marks62'),
            '63' => $request->input('total_marks63'),     
            '64' => $request->input('total_marks64'),
            '65' => $request->input('total_marks65'),
            '66' => $request->input('total_marks66'),
            '67' => $request->input('total_marks67'),

            '68' => $request->input('total_marks68'),
            '69' => $request->input('total_marks69'),
            '70' => $request->input('total_marks70'),
            '71' => $request->input('total_marks71'),
            '72' => $request->input('total_marks72'),
            '73' => $request->input('total_marks73'),

            '74' => $request->input('total_marks74'),
            '75' => $request->input('total_marks75'),
            '76' => $request->input('total_marks76'),
            '77' => $request->input('total_marks77'),
            '78' => $request->input('total_marks78'),
            '79' => $request->input('total_marks79'),

            '80' => $request->input('total_marks80'),
            '81' => $request->input('total_marks81'),
            '82' => $request->input('total_marks82'),
            '83' => $request->input('total_marks83'),
            '84' => $request->input('total_marks84'),
            '85' => $request->input('total_marks85'),

            '86' => $request->input('total_marks86'),
            '87' => $request->input('total_marks87'),
            '88' => $request->input('total_marks88'),
            '89' => $request->input('total_marks89'),
            '90' => $request->input('total_marks90'),
            '91' => $request->input('total_marks91'),

            '92' => $request->input('total_marks92'),
            '93' => $request->input('total_marks93'),
            '94' => $request->input('total_marks94'),
            '95' => $request->input('total_marks95'),
            '96' => $request->input('total_marks96'),
            '97' => $request->input('total_marks97'),

            '98' => $request->input('total_marks98'),
            '99' => $request->input('total_marks99'),
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
