<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaContent;
use App\Models\Publications;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class DashboardController extends Controller
{
    //

    public function dashboard()
    {
		$data = array();
        /*  $data['images'] = MediaContent::where('type_of_file',0)->get();
        $data['videos'] = MediaContent::where('type_of_file',1)->get();
        $data['medias'] = MediaContent::orderBy('id','desc')->limit(10)->get();
        $data['pendingMedia'] = MediaContent::where('status',0)->count();
        $data['pendingPublication'] = Publications::where('status',0)->count();
        $data['publications'] = Publications::orderBy('id','desc')->limit(10)->get();
	 
	 
	  
		$publications_allmonth = Publications::select(DB::raw('MONTH(created_at) as month'),DB::raw(' COUNT(*) as count'))
				->where(DB::raw('YEAR(created_at)'),date('Y'))->groupBy(DB::raw('MONTH(created_at)'))->get();
		
		$monthTotals = [];
		foreach($publications_allmonth as $month)
		{
			$monthTotals[$month["month"]] = $month["count"];
		}
		$chartJSCompat = [];
		for($i = 0;$i < 12;$i++){
			if(isset($monthTotals[$i+1]))
				$chartJSCompat[$i] = $monthTotals[$i+1];
			else
				$chartJSCompat[$i] = 0;
		}		 
		$data['publications_allmonth'] = 	json_encode($chartJSCompat);
		
		 
		$publications_allmonth = MediaContent::select(DB::raw('MONTH(created_at) as month'),DB::raw(' COUNT(*) as count'))
				->where(DB::raw('YEAR(created_at)'),date('Y'))->groupBy(DB::raw('MONTH(created_at)'))->get();
		
		$monthTotals = [];
		foreach($publications_allmonth as $month)
		{
			$monthTotals[$month["month"]] = $month["count"];
		}
		$chartJSCompat = [];
		for($i = 0;$i < 12;$i++){
			if(isset($monthTotals[$i+1]))
				$chartJSCompat[$i] = $monthTotals[$i+1];
			else
				$chartJSCompat[$i] = 0;
		}		 
		$data['media_allmonth'] = 	json_encode($chartJSCompat);
		 */
        return view('admin.dashboard',$data);
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function changePassword()
    {
        return view('admin.change-password');
    }

    public function changePasswordPost(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);
        try {
            if ($request->current_password != $request->new_password) {
                if ($request->new_password == $request->new_password_confirmation) {
                    $user = User::find(Auth::guard('misadmin')->user()->id);
                    $user->password = $request->new_password;
                    $user->save();

                    return redirect()->back()->with('success', __('message.changed_success'));
                } else {
                    return redirect()->back()->with('error', __('message.not_match'));
                }
            } else {
                return redirect()->back()->with('error', __('message.both_password_same'));
            }
        } catch (Exception $e) {
            Log::error($e);

            return redirect()->back()->with('error', 'Invalid Credentials.');
        }
    }


     

    public function documents()
    {
        return view('admin.documents');
    } 

    public function minutesOfMeeting()
    {
        return view('admin.minutes_of_meetings');
    } 
    public function mousMoa()
    {
        return view('admin.mous_moa');
    } 
}
