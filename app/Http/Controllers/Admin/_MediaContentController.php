<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Models\MediaContent;
use App\Models\RefBlock;
use App\Models\RefDistrict;
use App\Models\RefState;
use Illuminate\Support\Facades\Response;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class MediaContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		 
        abort_unless(\Gate::allows('media_access'), 403);
        $data = MediaContent::with('category')->orderBy('id','DESC')->paginate(10);
		return view('admin.media-content.index',compact('data'))
            ->with('j', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(\Gate::allows('media_create'), 403);
		$users = User::get();
        $categories = Category::orderBy('name', 'Asc')->get();
		//$blocks = RefBlock::orderBy('block_name', 'Asc')->get();
		//$districts = RefDistrict::orderBy('district_name', 'Asc')->get();
		$states = getStateList();
		return view('admin.media-content.create',compact('categories','users','states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_unless(\Gate::allows('media_create'), 403);
        try {
            $this->validate($request, [
                'cat_id' => 'required',
                'state_id' => 'required',
                'district_id' => 'required',
                'block' => 'required',
                'location' => 'required',
                'x' => 'required',
                'y' => 'required',
                'publication_date' => 'required',
                'keywords' => 'required',
				'thumbnail' => 'required|mimes:jpeg,jpg,png',
				'thumbnail.*' => 'mimetypes:image/jpeg,image/png,image/jpg',
                'image_caption' => 'required',
                'description' => 'required',
                'type_of_file' => 'required',
                //'upload_file' => 'required',
                'status' => 'required',
            ]);

			 $thumbnail_path = '';
            if ($request->hasFile('thumbnail')) {
				$name=$request->file('thumbnail')->getClientOriginalName();


					$isValid_Extention_Size = explode('.', $name);
					//print_r(count($isValid_Extention_Size));die;
					if(count($isValid_Extention_Size) <= 2){
						if (in_array(strtolower($request->file('thumbnail')->getClientOriginalExtension()), ['jpg','jpeg','png'])) {
							$documentRootPath = public_path().'/uploads/media_thumb';
							$thumbnail_path = time().rand().'thumbnail.'.$request->file('thumbnail')->getClientOriginalExtension();
							$request->file('thumbnail')->move($documentRootPath, $thumbnail_path);
						}else{
							Alert::error('File Error', "Please upload valid File.");
							return redirect()->back()->with('loader',true);
						}
					}else{

					Alert::error('File Error', "Please upload valid File.");
					return redirect()->back()->with('loader',true);
					}
            }

            $insertData = array(
                'cat_id' => $request->cat_id,
                'state_id' => $request->state_id,
                'district_id' => implode(',',$request->district_id),
                'block' => implode(',',$request->block),
                'location' => $request->location,
                'x' => $request->x,
                'y' => $request->y,
                'publication_date' => $request->publication_date,
                'keywords' => $request->keywords,
				 'thumbnail' => $thumbnail_path,
                'image_caption' => $request->image_caption,
                'description' => $request->description,
                'type_of_file' => $request->type_of_file,
                'file' => $request->upload_file,
                'status' => $request->status,
            );

            MediaContent::create($insertData);

            Alert::success('Success', 'Media Content created successfully');
            return redirect()->route('admin.media-content.index')->with('loader', true);

        } catch (Exception $e) {
            Alert::error('Error', $e->getMessage());
            \Log::error($e->getMessage());
            abort(404);
        } catch (\Illuminate\Database\QueryException $exception) {
            Alert::error('Error', $exception->getMessage());
            \Log::error($exception->getMessage());
            Alert::error('error', "Query Exception");
            return redirect()->back()->with('loader', true);
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
        abort_unless(\Gate::allows('media_edit'), 403);
		$mom = MediaContent::find($id);
		$users = User::get();
        $categories = Category::orderBy('name', 'Asc')->get();
		//$blocks = RefBlock::orderBy('block_name', 'Asc')->get();
		//$districts = RefDistrict::orderBy('district_name', 'Asc')->get();
		$states = getStateList();
        return view('admin.media-content.edit',compact('mom','categories','users','states'));
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
		abort_unless(\Gate::allows('media_edit'), 403);
        try{
            $this->validate($request, [
                'cat_id' => 'required',
                'state_id' => 'required',
                'district_id' => 'required',
                'block' => 'required',
                'location' => 'required',
                'x' => 'required',
                'y' => 'required',
                'publication_date' => 'required',
                'keywords' => 'required',
                'thumbnail' => 'mimes:jpeg,jpg,png',
				'thumbnail.*' => 'mimetypes:image/jpeg,image/png,image/jpg',
                'image_caption' => 'required',
                'description' => 'required',
                'type_of_file' => 'required',
                //'file' => 'required',
                'status' => 'required',
            ]);




			$MinutesOfMeeting = MediaContent::find($id);

			$thumbnail_path = $MinutesOfMeeting->thumbnail;
            if ($request->hasFile('thumbnail')) {
					$name=$request->file('thumbnail')->getClientOriginalName();


					$isValid_Extention_Size = explode('.', $name);
					//print_r(count($isValid_Extention_Size));die;
					if(count($isValid_Extention_Size) <= 2){
						if (in_array(strtolower($request->file('thumbnail')->getClientOriginalExtension()), ['jpg','jpeg','png'])) {
							$documentRootPath = public_path().'/uploads/media_thumb/';
							$thumbnail_path = time().rand().'thumbnail.'.$request->file('thumbnail')->getClientOriginalExtension();
							$request->file('thumbnail')->move($documentRootPath, $thumbnail_path);
						}else{
							Alert::error('File Error', "Please upload valid File.");
							return redirect()->back()->with('loader',true);
						}
					} else{

					Alert::error('File Error', "Please upload valid File.");
					return redirect()->back()->with('loader',true);
					}
            }

            $updateData = array(
                'cat_id' => $request->cat_id,
                'state_id' => $request->state_id,
                'district_id' => implode(',',$request->district_id),
                'block' => implode(',',$request->block),
                'location' => $request->location,
                'x' => $request->x,
                'y' => $request->y,
                'publication_date' => $request->publication_date,
                'keywords' => $request->keywords,
				 'thumbnail' => $thumbnail_path,
                'image_caption' => $request->image_caption,
                'description' => $request->description,
                'type_of_file' => $request->type_of_file,
                'file' => $request->upload_file,
                'status' => $request->status,
            );

		$MinutesOfMeeting->update($updateData);

		Alert::success('Success', 'Media Content updated successfully');
        return redirect()->route('admin.media-content.index')->with('loader',true);

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
        abort_unless(\Gate::allows('media_delete'), 403);
		MediaContent::where('id',$id)->delete();
        return redirect()->route('admin.media-content.index')
                        ->with('success','Media deleted successfully');
    }



	public function storeMedia_old(Request $request)
    {
        try{
         $path = public_path().'/uploads/documents/';
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');
        $name = uniqid() . '_' . trim($file->getClientOriginalName());

             $validator = Validator::make($request->all(), [
            'file' => 'mimes:video/avi,video/mpeg,video/quicktime,jpeg,jpg,png|max:102400',
        ]);
        } catch (Exception $e) {
            Log::error($e);
            return Response::make('File not Uploaded', 400);

        }
    }
	public function storeMedia(Request $request)
    {
        try{
            // $validator = Validator::make($request->all(), [
            //'file' => //'mimetypes:video/avi,video/mpeg,video/quicktime|max:102400|mimes:jpeg,jpg,png',
        //]);

        //if($validator->fails()){
               // return Response::make($validator->errors()->first(), 400);
           // }

        $path = public_path().'/uploads/documents/';
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');
        //$name = uniqid() . '_' . trim($file->getClientOriginalName());
		
		$filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
		$extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
		$name =  uniqid() . '_'.time() . '.' . $extension;

        /*Custom Validation Vikash Chaudhary 17/11/2020*/

        $file_name = (isset($_FILES['file']['name']) && !empty($_FILES['file']['name'])) ? $_FILES['file']['name'] : "";
        $file_tmp_name = (isset($_FILES['file']['tmp_name']) && !empty($_FILES['file']['tmp_name'])) ? $_FILES['file']['tmp_name'] : "";

        $mime = $file->getMimeType();		 
			if(($mime !== 'image/jpeg') && ($mime !== 'image/png') && ($mime !== 'image/jpg') && ($mime !== 'video/mp4') && ($mime !== 'video/x-msvideo') && ($mime !== 'video/x-matroska') ) 
			{
				 dd('This file is not allowed!!');
			}
		 
		if (in_array($file->getClientOriginalExtension(), ['avi','mkv','mp4','jpg','jpeg','png'])) {
            //$image = str_replace(asset('/'), '', $path . '/' . $name);
            $path = $path;
            //$image = str_replace('', '_', urldecode($image));

           // $image = explode('/', $image);
            //$name = end($image);

            
             
             
        }else{
            dd('Extension not allowed!!');
        }
		

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
