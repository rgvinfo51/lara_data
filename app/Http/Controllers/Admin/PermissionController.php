<?php


namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission; 
use DB;


class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		abort_unless(\Gate::allows('permission_access'), 403);
        $permissions = Permission::orderBy('id','DESC')->paginate(10);
        return view('admin.permissions.index',compact('permissions'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		abort_unless(\Gate::allows('permission_create'), 403);
        $permission = Permission::get();
        return view('admin.permissions.create',compact('permission'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		abort_unless(\Gate::allows('permission_create'), 403);
        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
             
        ]);


        $role = Permission::create(['name' => $request->input('name')]);
        // $role->syncPermissions($request->input('permission'));


        return redirect()->route('admin.permissions.index')
                        ->with('success','Role created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		abort_unless(\Gate::allows('permission_show'), 403);
        $permission = Permission::find($id);  
        return view('admin.permissions.show',compact('permission'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         abort_unless(\Gate::allows('permission_edit'), 403);
        $permission = Permission::find($id); 
        return view('admin.permissions.edit',compact('permission'));
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
		 abort_unless(\Gate::allows('permission_edit'), 403);
        $this->validate($request, [
            'name' => 'required',
           
        ]);

        $role = Permission::find($id);
        $role->name = $request->input('name');
        $role->save();
 
        return redirect()->route('admin.permissions.index')
                        ->with('success','Role updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		 abort_unless(\Gate::allows('permission_delete'), 403);
        DB::table("permissions")->where('id',$id)->delete();
        return redirect()->route('admin.permissions.index')
                        ->with('success','Role deleted successfully');
    }
}