<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use RealRashid\SweetAlert\Facades\Alert;
use Hash;
use Auth;
use App\Models\TaskReport;
use App\Models\Role;
use App\Models\Plan; 
use DB;

class TaskReportController extends Controller
{
	
	public function __construct()
    {
        //$this->middleware('isBusiness');		 
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function completelist(){ 
        return view('admin.task_report.completelist');
    }

    public function notcompletelist(){
        return view('admin.task_report.notcompletelist');
    }


    public function report(){
        return view('admin.task_report.report');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
 

     

 
  
}
