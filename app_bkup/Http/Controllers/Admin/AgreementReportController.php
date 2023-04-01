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
use App\Models\AgreementReport;
use App\Models\Role;
use App\Models\Plan; 
use DB;

class AgreementReportController extends Controller
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
		$data = AgreementReport::with('parentUser')->orderBy('id','DESC')->paginate(10);

		return view('admin.admin_agentreport.pendinglist',compact('data'));
            // ->with('i', (input('page', 1) - 1) * 10);
    }


    public function approved()	
    {		 
        $data = AgreementReport::with('parentUser')->orderBy('id','DESC')->paginate(10);

		return view('admin.admin_agentreport.approved',compact('data'));  
    }


    public function reject()	
    {	
        $data = AgreementReport::with('parentUser')->orderBy('id','DESC')->paginate(10);

		return view('admin.admin_agentreport.reject',compact('data')); 
    }

 
  
}
