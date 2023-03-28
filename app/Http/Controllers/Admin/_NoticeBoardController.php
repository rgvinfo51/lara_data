<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NoticeBoard;
use RealRashid\SweetAlert\Facades\Alert;

class NoticeBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $data = NoticeBoard::orderBy('id','DESC')->paginate(5);	 
		return view('admin.notice_board.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('admin.notice_board.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        try{
        $this->validate($request, [
            'notice_date' => 'required',
			'notice_text' => 'required',			 
			'status' => 'required', 
        ] );
       
		$insertData = array(
				'notice_date' => $request->notice_date,
				'message' => $request->notice_text,
				'status' => $request->status,				 
				'upload_file' => $request->logo_hidden_images,			 
				
			);
        
         
        NoticeBoard::create($insertData);
		 
		Alert::success('Success', 'Notice message created successfully');
        return redirect()->route('admin.notice-board.index')->with('loader',true);
		
		}catch(Exception $e){
			Alert::error('Error', $e->getMessage());
			\Log::error($e->getMessage());
			abort(404);
		 }catch (\Illuminate\Database\QueryException $exception) {
			  Alert::error('Error', $exception->getMessage());
			  \Log::error($exception->getMessage());
			  Alert::error('error', "Query Exception");
			  return redirect()->back()->with('loader',true);               
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
       $notice  = NoticeBoard::find($id);	
       return view('admin.notice_board.edit',compact('notice'));
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
        try{
        $this->validate($request, [
            'notice_date' => 'required',
			'notice_text' => 'required',			 
			'status' => 'required', 
        ] );
       
		$updateData = array(
				'notice_date' => $request->notice_date,
				'message' => $request->notice_text,
				'status' => $request->status,				 
				'upload_file' => $request->logo_hidden_images,			 
				
			);
        
         
        
		$NoticeBoard = NoticeBoard::find($id);
		$NoticeBoard->update($updateData);	
		 
		Alert::success('Success', 'Notice message updated successfully');
        return redirect()->route('admin.notice-board.index')->with('loader',true);
		
		}catch(Exception $e){
			Alert::error('Error', $e->getMessage());
			\Log::error($e->getMessage());
			abort(404);
		 }catch (\Illuminate\Database\QueryException $exception) {
			  Alert::error('Error', $exception->getMessage());
			  \Log::error($exception->getMessage());
			  Alert::error('error', "Query Exception");
			  return redirect()->back()->with('loader',true);               
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
        //
    }
	
	public function storeMedia(Request $request)
    { 
        try{ 
        $path = 'uploads/notice_board';
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        
        $file = $request->file('file');
        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        /*Custom Validation Vikash Chaudhary 17/11/2020*/

        $file_name = (isset($_FILES['file']['name']) && !empty($_FILES['file']['name'])) ? $_FILES['file']['name'] : "";
        $file_tmp_name = (isset($_FILES['file']['tmp_name']) && !empty($_FILES['file']['tmp_name'])) ? $_FILES['file']['tmp_name'] : "";

        $mime = $file->getMimeType();

        $file_array = array(
            'file_name' => $file_name,
            'file_tmp_name' => $file_tmp_name,
            'file_mime_type' => $mime,
        );
        $data = getimagesize($file_tmp_name);
        if ($data != false) {
            $width = $data[0];
            $height = $data[1];
        }else{
            $width = '';
            $height = '';
        } 
 

        $file->move($path, $name);

        if (in_array($file->getClientOriginalExtension(), ['pdf','png', 'jpg', 'jpeg','PNG','JPG','JPEG'])) {
            $image = str_replace(asset('/'), '', $path . '/' . $name);
            $path = $path . '/' . $name;
            $image = str_replace('', '_', urldecode($image));

            $image = explode('/', $image);
            $name = end($image);

            
             
             
        }else{
            dd('no');
        }

        return response()->json([
            'name' => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
        } catch (Exception $e) {
            Log::error($e);
            return Response::make('File not Uploaded', 400);
            
        }
    }
	
}
