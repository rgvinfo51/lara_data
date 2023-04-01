<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Hash;
use Auth;
use App\Models\Admin;
use App\Models\Role;
use App\Models\Plan; 
use DB;

class PlanController extends Controller
{
	
	public function __construct()
    {
        // Page Title
        $this->module_title = 'Plan Info';
        // module name
        $this->module_name = 'plan';
		$this->model_name = 'App\Models\Plan';
     
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
        $list=Plan::paginate(10);   		
        return view("admin.plan.index",compact('list',"module_title", "module_name"))
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
		return view('admin.plan.create', compact('module_title', 'module_name'));
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
		$module_title = $this->module_title;
        $module_name = $this->module_name;
        $this->validate($request, [
            'plan_name' => 'required',
            'plan_duration' => 'required',
            'plan_total_forms' => 'required',
            'plan_min_accuracy' => 'required',
            'plan_rate_per_form' => 'required',
            'status' => 'required',
           
        ]);
		
		$insertData = array(
				'plan_name' =>  $request->plan_name,
				'plan_duration' => $request->plan_duration,
				'plan_total_forms' => $request->plan_total_forms,
				'plan_min_accuracy' => $request->plan_min_accuracy,
				'plan_rate_per_form' => $request->plan_rate_per_form,				 
				'status' => $request->status,					 
				 
			);
		    
			$user = Plan::create($insertData);
  
		 Alert::success('Success', 'Plan created successfully');
         return redirect()->route('admin.plan.index')->with('loader', true);
		 
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
        $plan = Plan::find($id); 
        return view('admin.plan.edit',compact('plan','module_title', 'module_name'));
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
		$module_title = $this->module_title;
        $module_name = $this->module_name;
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
		
		 Alert::success('Success', 'Plan updated successfully');
         return redirect()->route('admin.plan.index')->with('loader', true);
		 
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
        Plan::where('id',$id)->delete();
		Alert::success('Success', 'Plan deleted successfully');
         return redirect()->route('admin.plan.index')->with('loader', true);
         
    }
}
