<?php


namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use DB;
use App\Models\Role;
use App\Models\Permission; 

class RoleController extends Controller
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
		abort_unless(\Gate::allows('role_access'), 403);
        $roles = Role::orderBy('id','DESC')->paginate(10);
        return view('admin.roles.index',compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		abort_unless(\Gate::allows('role_create'), 403);
        $permission = Permission::get();
        return view('admin.roles.create',compact('permission'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		abort_unless(\Gate::allows('role_create'), 403);
        $this->validate($request, [
            'title' => 'required|unique:roles,title',
            'permission' => 'required',
        ]);


        $role = Role::create(['title' => $request->input('title')]);
         $role->permissions()->sync($request->input('permission'));


        return redirect()->route('admin.roles.index')
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
		abort_unless(\Gate::allows('role_show'), 403);
        $role = Role::find($id);
        $rolePermissions = Permission::join("permission_role","permission_role.permission_id","=","permissions.id")
            ->where("permission_role.role_id",$id)
            ->get();
		$permissions = Permission::all();

        return view('admin.roles.show',compact('role','rolePermissions','permissions'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		abort_unless(\Gate::allows('role_edit'), 403);
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("permission_role")->where("permission_role.role_id",$id)
            ->pluck('permission_role.permission_id','permission_role.permission_id')
            ->all();


        return view('admin.roles.edit',compact('role','permission','rolePermissions'));
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
		abort_unless(\Gate::allows('role_edit'), 403);
        $this->validate($request, [
            'title' => 'required',
            'permission' => 'required',
        ]);


        $role = Role::find($id);
        $role->title = $request->input('title');
        $role->save();
		
		DB::table('permission_role')->where('role_id',$id)->delete(); 

         $role->permissions()->sync($request->input('permission', []));


        return redirect()->route('admin.roles.index')
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
		abort_unless(\Gate::allows('role_delete'), 403);
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('admin.roles.index')
                        ->with('success','Role deleted successfully');
    }
}