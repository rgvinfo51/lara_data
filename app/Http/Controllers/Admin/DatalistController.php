<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Hash;
use Auth;
use App\Models\Datalist;
 

class DatalistController extends Controller
{
	
	public function __construct()
    {
        // Page Title
        $this->module_title = 'Data List';
        // module name
        $this->module_name = 'datalist';
		$this->model_name = 'App\Models\Datalist';
     
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_unless(\Gate::allows($this->module_name.'_list'), 403);
		$module_title = $this->module_title;
        $module_name = $this->module_name;
        $list=Datalist::paginate(10);   		
        return view("admin.datalist.index",compact('list',"module_title", "module_name"))
            ->with('i', ($request->input('page', 1) - 1) * 10);
			
		 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(\Gate::allows($this->module_name.'_create'), 403);
		$module_title = $this->module_title;
        $module_name = $this->module_name;
		return view('admin.datalist.create', compact('module_title', 'module_name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_unless(\Gate::allows($this->module_name.'_create'), 403);
        $this->validate($request, [
            'name' => 'required',
            'designation' => 'required',
            'mobile_no' => 'required',
            'company_name' => 'required',
            'website' => 'required',
            'address' => 'required',
            'office_contact' => 'required',
            'email' => 'required',
            'linkedin' => 'required',
            'twitter' => 'required',
            'skype' => 'required',
            'qrcode' => 'required',
        ]);
		
		$insertData = array(
				'name' =>  $request->name,
				'designation' => $request->designation,
				'mobile_no' => $request->mobile_no,
				'company_name' => $request->company_name,
				'website' => $request->website,				 
				'address' => $request->address,
				'office_contact' => $request->office_contact,
				'email' => $request->email,
				'linkedin' => $request->linkedin,
				'twitter' => $request->twitter,
				'skype' => $request->skype,
				'qrcode' => $request->qrcode, 
			);
		    
			$user = Datalist::create($insertData);
  
		 Alert::success('Success', 'Data created successfully');
         return redirect()->route('admin.datalist.index')->with('loader', true);
		 
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
        abort_unless(\Gate::allows($this->module_name.'_edit'), 403);
		$module_title = $this->module_title;
        $module_name = $this->module_name;
        $plan = Datalist::find($id); 
        return view('admin.datalist.edit',compact('plan','module_title', 'module_name'));
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
        abort_unless(\Gate::allows($this->module_name.'_edit'), 403);
        $this->validate($request, [
            'plan_name' => 'required',
            'plan_duration' => 'required',
            'plan_total_forms' => 'required',
            'plan_min_accuracy' => 'required',
            'plan_rate_per_form' => 'required',
            'status' => 'required',
           
        ]);

        $role = Plan::find($id);
        $role->plan_name = $request->input('plan_name');
		$role->plan_duration = $request->input('plan_duration');
		$role->plan_total_forms = $request->input('plan_total_forms');
		$role->plan_min_accuracy = $request->input('plan_min_accuracy');
		$role->plan_rate_per_form = $request->input('plan_rate_per_form');
		$role->status = $request->input('status');
        $role->save();
		
		 Alert::success('Success', 'Data updated successfully');
         return redirect()->route('admin.datalist.index')->with('loader', true);
		 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_unless(\Gate::allows($this->module_name.'_delete'), 403);
        Datalist::where('id',$id)->delete();
		Alert::success('Success', 'Data deleted successfully');
         return redirect()->route('admin.datalist.index')->with('loader', true);
         
    }
}
