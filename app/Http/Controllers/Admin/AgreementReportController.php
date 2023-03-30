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
use App\Models\Agent;
use App\Models\Role;
use App\Models\Plan; 
use DB;

class AGGREMENTREPORTController extends Controller
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
     


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
 

    public function pendinglist()	
    {		 
			return view('admin.admin_agentreport.pendinglist');		  
    }

    public function approved()	
    {		 
			return view('admin.admin_agentreport.approved');		  
    }


    public function reject()	
    {		 
			return view('admin.admin_agentreport.reject');		  
    }


     
	
  
}
