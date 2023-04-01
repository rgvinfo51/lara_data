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
use App\Models\User;
use App\Models\Role;
use App\Models\Plan; 
use DB;

class AdminController extends Controller
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
		abort_unless(\Gate::allows('user_access'), 403);
		$data = User::where('type','=',2)->orderBy('id','DESC')->paginate(10);
		return view('admin.users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()	
    {		
			abort_unless(\Gate::allows('user_create'), 403);
			$users = User::get();	 
			$roles = Role::whereNotIn('title',['Super Admin'])->get();		 
			$plans = Plan::all();
			
			return view('admin.users.create',compact('roles','plans','users'));		  
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	 
		abort_unless(\Gate::allows('user_create'), 403);
		try{
		 //pr($request->all());
			$this->validate($request, [ 
				'company_name' => 'required',
				'admin_email' => 'required|unique:lara_admin,admin_email',
				'contact' => 'required',
				'company_charges' => 'required',
				'address' => 'required',	         
				'agreement_text' => 'required', 
				'userStatus' => 'required', 
				'company_logo' => 'required|mimes:jpeg,jpg,png', 
				'upload_letterhead' => 'required|mimes:jpeg,jpg,png',
				'company_stamp' => 'required|mimes:jpeg,jpg,png',
			]);
			
			$company_logo = '';
            if ($request->hasFile('company_logo')) {
				$name=$request->file('company_logo')->getClientOriginalName();
					$isValid_Extention_Size = explode('.', $name);					 
					if(count($isValid_Extention_Size) <= 2){
						if (in_array(strtolower($request->file('company_logo')->getClientOriginalExtension()), ['jpg','jpeg','png'])) {
							$documentRootPath = public_path().'/uploads/admin/company/';
							$company_logo = time().rand().'company_logo.'.$request->file('company_logo')->getClientOriginalExtension();
							$request->file('company_logo')->move($documentRootPath, $company_logo);
						}else{
							Alert::error('File Error', "Please upload valid File.");
							return redirect()->back()->with('loader',true);
						}
				}else{
					Alert::error('File Error', "Please upload valid File.");
					return redirect()->back()->with('loader',true);
					}
            }
			
			$upload_letterhead = '';			
            if ($request->hasFile('upload_letterhead')) {
				$name=$request->file('upload_letterhead')->getClientOriginalName();
					$isValid_Extention_Size = explode('.', $name);					 
					if(count($isValid_Extention_Size) <= 2){
						if (in_array(strtolower($request->file('upload_letterhead')->getClientOriginalExtension()), ['jpg','jpeg','png'])) {
							$documentRootPath = public_path().'/uploads/admin/company/';
							$upload_letterhead = time().rand().'upload_letterhead.'.$request->file('upload_letterhead')->getClientOriginalExtension();
							$request->file('upload_letterhead')->move($documentRootPath, $upload_letterhead);
						}else{
							Alert::error('File Error', "Please upload valid File.");
							return redirect()->back()->with('loader',true);
						}
				}else{
					Alert::error('File Error', "Please upload valid File.");
					return redirect()->back()->with('loader',true);
					}
            }
			
			$company_stamp = '';			
            if ($request->hasFile('company_stamp')) {
				$name=$request->file('company_stamp')->getClientOriginalName();
					$isValid_Extention_Size = explode('.', $name);					 
					if(count($isValid_Extention_Size) <= 2){
						if (in_array(strtolower($request->file('company_stamp')->getClientOriginalExtension()), ['jpg','jpeg','png'])) {
							 $documentRootPath = public_path().'/uploads/admin/company/';
							 $company_stamp = time().rand().'company_stamp.'.$request->file('company_stamp')->getClientOriginalExtension();
							$request->file('company_stamp')->move($documentRootPath, $company_stamp);
						}else{
							Alert::error('File Error', "Please upload valid File.");
							return redirect()->back()->with('loader',true);
						}
				}else{
					Alert::error('File Error', "Please upload valid File.");
					return redirect()->back()->with('loader',true);
					}
            }
			$username = substr(str_shuffle(str_repeat('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', 36)), 0, 6); 
			$password = substr(str_shuffle(str_repeat('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', 36)), 0, 6);
			 
			
			$insertData = array(
					'type' => 2,
					'company_name' => $request->company_name,
					'admin_email' => $request->admin_email,
					'username' => $username,
					'password' => $password,
					'contact' => $request->contact,					
					'company_charges' => $request->company_charges,
					'address' => $request->address,
					'status' => $request->userStatus,
					'agreement_text' => $request->agreement_text,
					'company_logo' => $company_logo,
					'upload_letterhead' => $upload_letterhead,
					'company_stamp' => $company_stamp,
					'token' => random_string(45),
				);
		    
			$user = User::create($insertData);
			 $user->roles()->attach(2);
			 
			/* $emailData = ([
				 
				 'name' => $request->name,
				 'email' => $request->email,
				 'password' => $request->password_test,
				  
				 ]);	 */
	
			//$welcomeEmailSent = Mail::to($request->email)->send(new WelcomeMail($emailData));
			 
			Alert::success('Success', 'Admin created successfully');
			return redirect()->route('admin.users.index');
		  
		}catch(\Swift_TransportException $transportExp){
			Alert::success('Success', 'Admin created successfully but email not sent!!');
			return redirect()->route('admin.users.index');
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
		abort_unless(\Gate::allows('user_show'), 403);
        $user = User::find($id);
		$states = getState();
		$roles = Role::whereNotIn('name',['Super Admin'])->pluck('name','name')->all();

		$userRole = $user->roles->pluck('name','name')->all();
		$application_modules = ApplicationModulesMaster::all();
        return view('admin.users.show',compact('user','roles','userRole','application_modules','states'));
    }  


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		abort_unless(\Gate::allows('user_edit'), 403);
        $user = User::find($id);
        $users = User::get();
        $roles = Role::whereNotIn('title',['Super Admin'])->get();
        
        return view('admin.users.edit',compact('user','users','roles'));
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
		abort_unless(\Gate::allows('user_edit'), 403);
		try{
				$this->validate($request, [
				  
					'company_name' => 'required',
					'admin_email' => 'required|unique:lara_admin,admin_email,'.$id,
					'contact' => 'required',
					'company_charges' => 'required',
					'address' => 'required',	         
					'agreement_text' => 'required', 
					'userStatus' => 'required', 
					'company_logo' => 'mimes:jpeg,jpg,png', 
					'upload_letterhead' => 'mimes:jpeg,jpg,png',
					'company_stamp' => 'mimes:jpeg,jpg,png',
					
                ]);
				
				$company_logo = '';
            if ($request->hasFile('company_logo')) {
				$name=$request->file('company_logo')->getClientOriginalName();
					$isValid_Extention_Size = explode('.', $name);					 
					if(count($isValid_Extention_Size) <= 2){
						if (in_array(strtolower($request->file('company_logo')->getClientOriginalExtension()), ['jpg','jpeg','png'])) {
							$documentRootPath = public_path().'/uploads/admin/company/';
							$company_logo = time().rand().'company_logo.'.$request->file('company_logo')->getClientOriginalExtension();
							$request->file('company_logo')->move($documentRootPath, $company_logo);
						}else{
							Alert::error('File Error', "Please upload valid File.");
							return redirect()->back()->with('loader',true);
						}
				}else{
					Alert::error('File Error', "Please upload valid File.");
					return redirect()->back()->with('loader',true);
					}
            }else{
				$company_logo = $request->company_logo_edit;
			}
			
			$upload_letterhead = '';			
            if ($request->hasFile('upload_letterhead')) {
				$name=$request->file('upload_letterhead')->getClientOriginalName();
					$isValid_Extention_Size = explode('.', $name);					 
					if(count($isValid_Extention_Size) <= 2){
						if (in_array(strtolower($request->file('upload_letterhead')->getClientOriginalExtension()), ['jpg','jpeg','png'])) {
							$documentRootPath = public_path().'/uploads/admin/company/';
							$upload_letterhead = time().rand().'upload_letterhead.'.$request->file('upload_letterhead')->getClientOriginalExtension();
							$request->file('upload_letterhead')->move($documentRootPath, $upload_letterhead);
						}else{
							Alert::error('File Error', "Please upload valid File.");
							return redirect()->back()->with('loader',true);
						}
				}else{
					Alert::error('File Error', "Please upload valid File.");
					return redirect()->back()->with('loader',true);
					}
            }else{
				$upload_letterhead = $request->upload_letterhead_edit;
			}
			
			$company_stamp = '';			
            if ($request->hasFile('company_stamp')) {
				$name=$request->file('company_stamp')->getClientOriginalName();
					$isValid_Extention_Size = explode('.', $name);					 
					if(count($isValid_Extention_Size) <= 2){
						if (in_array(strtolower($request->file('company_stamp')->getClientOriginalExtension()), ['jpg','jpeg','png'])) {
							 $documentRootPath = public_path().'/uploads/admin/company/';
							 $company_stamp = time().rand().'company_stamp.'.$request->file('company_stamp')->getClientOriginalExtension();
							$request->file('company_stamp')->move($documentRootPath, $company_stamp);
						}else{
							Alert::error('File Error', "Please upload valid File.");
							return redirect()->back()->with('loader',true);
						}
				}else{
					Alert::error('File Error', "Please upload valid File.");
					return redirect()->back()->with('loader',true);
					}
            }else{
				$company_stamp = $request->company_stamp_edit;
			}

				$updateData = array( 
					'company_name' => $request->company_name,
					'admin_email' => $request->admin_email,					 
					'contact' => $request->contact,					
					'company_charges' => $request->company_charges,
					'address' => $request->address,
					'status' => $request->userStatus,
					'agreement_text' => $request->agreement_text,
					'company_logo' => $company_logo,
					'upload_letterhead' => $upload_letterhead,
					'company_stamp' => $company_stamp,
					 
				);
				$user = User::find($id);
				$user->update($updateData);
                //DB::table('role_user')->where('user_id',$id)->delete();
                //$user->roles()->attach($request->user_type);
				 
			Alert::success('Success', 'Admin updated successfully');
			return redirect()->route('admin.users.index');
		
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
		abort_unless(\Gate::allows('user_delete'), 403);
        User::find($id)->delete();
        return redirect()->route('admin.users.index')
                        ->with('success','Admin deleted successfully');
    }
	
	
	/**
     * Getting district list by using state it AJAX
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
	 
     */
	 public function getDistrict(Request $request){ 
        $data = getDistrict($request->state);
        return json_encode(array('data'=>$data));

    }
}
