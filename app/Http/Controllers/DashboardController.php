<?php

namespace App\Http\Controllers;

use App\Models\PeopleInfo;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
       
        return view('dashboard');
    }

    public function report_view()
    {
      return view('report');
    }

    public function report_list()
    {
        $report_list = PeopleInfo::query()->get();
        return datatables()->of($report_list)       
             ->setRowAttr([
                'align' => 'center',
            ])           
            ->make(true);
    }
}
