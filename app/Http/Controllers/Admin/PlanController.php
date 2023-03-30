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
    public function index()
    {
        abort_unless(\Gate::allows($this->module_name.'_list'), 403);
		$module_title = $this->module_title;
        $module_name = $this->module_name;
         $list=$this->model_name::where('deleted_at',NULL)->get();       
        if ($request->ajax()) {

             return Datatables::of($list)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
						$btn = '<a href='.route('superadmin.contact-info.edit', [$row->id]).'><span><i class="mdi mdi-account-edit text-muted fs-16 align-middle me-1" data-toggle="tooltip" title="Edit User"></i></span></a><a href="JavaScript:void(0);" data-href="'.route('superadmin.contact-info.destroy',[$row->id]).'" class="deletedata" data-value="'.$row->id.'"><span><i class="mdi mdi-delete-circle text-muted fs-16 align-middle me-1" data-toggle="tooltip" title="Delete"></i></span></a>';
                        
                        return $btn;
                    })
					->editColumn('level', function ($row) {
                        return $row->level;
                     }) 
					 ->editColumn('designation', function ($row) {
                        return $row->designation;
                     }) 
					  ->editColumn('office_address', function ($row) {
                        return $row->office_address;
                     })
					 ->editColumn('telefax', function ($row) {
                        return $row->telefax;
                     })
					 ->editColumn('email', function ($row) {
                        return $row->email;
                     })
					 ->editColumn('website', function ($row) {
                        return $row->website;
                     })
                     ->addColumn('status', function ($row) {
						 if($row->status == '0')
							return '<i class="ri-checkbox-circle-line align-middle text-success"></i> Active';
						else
						    return '<i class="ri-close-circle-line align-middle text-danger"></i> Inactive';
					 
                        
                     }) 
                    ->rawColumns(['action','status'])
                    ->make(true);
        }
        return view("admin.plan.index",compact('list',"module_title", "module_name")); 
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
