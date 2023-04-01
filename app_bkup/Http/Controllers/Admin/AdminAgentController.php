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

class AdminAgentController extends Controller
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
    public function index(Request $request)
    {
		abort_unless(\Gate::allows('agent_access'), 403);
		$data = Agent::with('parentUser')->orderBy('id','DESC')->paginate(10);
		return view('admin.admin_agent.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()	
    {		
			abort_unless(\Gate::allows('agent_create'), 403);
			  
			return view('admin.admin_agent.create');		  
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	 
		abort_unless(\Gate::allows('agent_create'), 403);
		try{
		 //pr($request->all());
			$this->validate($request, [ 
				'name' => 'required',				 			  
				'userStatus' => 'required', 
				 
			]);
			 
			$username = substr(str_shuffle(str_repeat('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', 36)), 0, 6); 
			$password = substr(str_shuffle(str_repeat('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', 36)), 0, 6);
			 
			
			$insertData = array(
					'admin_id' => Auth::guard('misadmin')->id(),
					'name' => $request->name,					 
					'username' => $username,
					'user_password' => $password, 
					'is_active' => $request->userStatus,					 
					'token' => random_string(45),
				);
		    
			$user = Agent::create($insertData);
			// $user->roles()->attach(3);
			 
			/* $emailData = ([
				 
				 'name' => $request->name,
				 'email' => $request->email,
				 'password' => $request->password_test,
				  
				 ]);	 */
	
			//$welcomeEmailSent = Mail::to($request->email)->send(new WelcomeMail($emailData));
			 
			Alert::success('Success', 'Agent created successfully');
			return redirect()->route('admin.admin-agents.index');
		  
		}catch(\Swift_TransportException $transportExp){
			Alert::success('Success', 'Agent created successfully but email not sent!!');
			return redirect()->route('admin.admin-agents.index');
		}catch(Exception $e){
			Alert::error('Error', $e->getMessage());
			\Log::error($e->getMessage());
			abort(404);
		 }catch (\Illuminate\Database\QueryException $exception) {
			  Alert::error('Error', $exception->getMessage());
			  \Log::error($exception->getMessage());
			  Alert::error('error', "Query Exception");
			  return redirect()->back();               
		}
    }
 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		abort_unless(\Gate::allows('agent_show'), 403);
                $user = Agent::find($id);
		$states = getState();
		$roles = Role::whereNotIn('name',['Super Admin'])->pluck('name','name')->all();

		$userRole = $user->roles->pluck('name','name')->all();
		$application_modules = ApplicationModulesMaster::all();
        return view('admin.admin_agent.show',compact('user','roles','userRole','application_modules','states'));
    }  


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	abort_unless(\Gate::allows('agent_edit'), 403);
        $user = Agent::find($id);
        
        return view('admin.admin_agent.edit',compact('user'));
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
		abort_unless(\Gate::allows('agent_edit'), 403);
		try{
				$this->validate($request, [				  
					'name' => 'required',					 					 
					'userStatus' => 'required', 					 
					
                ]);
				
				 

				$updateData = array(					 
					'name' => $request->name,					 
					'is_active' => $request->userStatus,
					 
					 
				);
				$user = Agent::find($id);
				$user->update($updateData);
                 
			Alert::success('Success', 'Agent updated successfully');
			return redirect()->route('admin.admin-agents.index');
		
		}catch(Exception $e){
			Alert::error('Error', $e->getMessage());
			\Log::error($e->getMessage());
			abort(404);
		 }catch (\Illuminate\Database\QueryException $exception) {
			  Alert::error('Error', $exception->getMessage());
			  \Log::error($exception->getMessage());
			  Alert::error('error', "Query Exception");
			  return redirect()->back();               
		}
    }
	
	

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		abort_unless(\Gate::allows('agent_delete'), 403);
        Agent::find($id)->delete();
        return redirect()->route('admin.admin-agents.index')
                        ->with('success','Agent deleted successfully');
    }
	
  
}
