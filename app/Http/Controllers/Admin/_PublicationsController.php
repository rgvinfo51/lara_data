<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\RefBlock;
use App\Models\RefDistrict;
use App\Models\RefState;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Publications;
use RealRashid\SweetAlert\Facades\Alert;
use DB;

class PublicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_unless(\Gate::allows('publication_access'), 403);
        $data = Publications::with('category')->orderBy('id','DESC')->paginate(10);
		return view('admin.publications.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(\Gate::allows('publication_create'), 403);
		$categories = Category::orderBy('name', 'Asc')->get();
		//$blocks = RefBlock::orderBy('block_name', 'Asc')->get();
		//$districts = RefDistrict::orderBy('district_name', 'Asc')->get();
		$states = getStateList();
		return view('admin.publications.create',compact('categories','states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       abort_unless(\Gate::allows('publication_create'), 403);
        try {
            $this->validate($request, [
                'category_id' => 'required',
                'state_id' => 'required',
                'district' => 'required',
                'block' => 'required',
                'year_of_issue' => 'required',
                'title' => 'required',
                'number_of_authors' => 'required',
                'name_of_authors' => 'required',
                'keywords' => 'required',
                'thumbnail' => 'required|mimes:jpeg,jpg,png',
				'thumbnail' => 'mimetypes:image/jpeg,image/png,image/jpg',
                'file' => 'required|mimetypes:application/pdf|max:16000',
                'description' => 'required',
                'status' => 'required',
            ]);


            $thumbnail_path = '';
            if ($request->hasFile('thumbnail')) {

				$name=$request->file('thumbnail')->getClientOriginalName();


					$isValid_Extention_Size = explode('.', $name);
					//print_r(count($isValid_Extention_Size));die;
					if(count($isValid_Extention_Size) <= 2){

						if (in_array(strtolower($request->file('thumbnail')->getClientOriginalExtension()), ['jpg','jpeg','png'])) {
							$documentRootPath = public_path().'/uploads/documents';
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

            $file_path = '';
			$pdfText = '';
            if ($request->hasFile('file')) {
				$name=$request->file('file')->getClientOriginalName();


					$isValid_Extention_Size = explode('.', $name);
					//print_r(count($isValid_Extention_Size));die;
					if(count($isValid_Extention_Size) <= 2){
				$parser = new \Smalot\PdfParser\Parser();
				//$pdf = $parser->parseFile($request->file('file'));
				//$pdfText = $pdf->getText();
                //$pdfText = preg_replace('/[^a-zA-Z0-9_ -]/s',' ',$pdfText);
				//$pdfText = nl2br($pdfText);
				if (in_array(strtolower($request->file('file')->getClientOriginalExtension()), ['pdf'])) {
					$documentRootPath = public_path().'/uploads/documents';
					$file_path = time().rand().'file.'.$request->file('file')->getClientOriginalExtension();
					$request->file('file')->move($documentRootPath, $file_path);
				}else{
					Alert::error('File Error', "Please upload valid pdf File.");
					return redirect()->back()->with('loader',true);
				}
			 }else{

					Alert::error('File Error', "Please rename your file, (.) not allowed!!");
					return redirect()->back()->with('loader',true);
					}
            }

            $insertData = array(
                'cat_id' => $request->category_id,
                'state_id' => implode(',',$request->state_id),
                'district' => implode(',',$request->district),
                'block' => implode(',',$request->block),
                'year_of_issue' => $request->year_of_issue,
                'title' => $request->title,
                'number_of_authors' => $request->number_of_authors,
                'name_of_authors' => $request->name_of_authors,
                'keywords' => $request->keywords,
                'thumbnail' => $thumbnail_path,
                'file' => $file_path,
				'file_content' => $pdfText,
                'description' => $request->description,
                'status' => $request->status,
            );


            Publications::create($insertData);

            Alert::success('Success', 'Publications created successfully');
            return redirect()->route('admin.publications.index')->with('loader', true);

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
        abort_unless(\Gate::allows('publication_edit'), 403);
        $publication = Publications::find($id);
		$categories = Category::orderBy('name', 'Asc')->get();
		//$blocks = RefBlock::orderBy('block_name', 'Asc')->get();
		//$districts = RefDistrict::orderBy('district_name', 'Asc')->get();
		$states = getStateList();
        return view('admin.publications.edit',compact('publication','categories','states'));
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
		abort_unless(\Gate::allows('publication_edit'), 403);
        try {
            $this->validate($request, [
                'category_id' => 'required',
                'state_id' => 'required',
                'district' => 'required',
                'block' => 'required',
                'year_of_issue' => 'required',
                'title' => 'required',
                'number_of_authors' => 'required',
                'name_of_authors' => 'required',
                'keywords' => 'required',
                'thumbnail' => 'mimes:jpeg,jpg,png',
				'thumbnail.*' => 'mimetypes:image/jpeg,image/png,image/jpg',
                'file' => 'mimetypes:application/pdf|max:16000',
                'description' => 'required',
                'status' => 'required',
            ]);

            $LetterOrder = Publications::find($id);

            $thumbnail_path = $LetterOrder->thumbnail;
            if ($request->hasFile('thumbnail')) {

				$name=$request->file('thumbnail')->getClientOriginalName();


					$isValid_Extention_Size = explode('.', $name);
					 
					if(count($isValid_Extention_Size) <= 2){
						if (in_array(strtolower($request->file('thumbnail')->getClientOriginalExtension()), ['jpg','jpeg','png'])) {

							$documentRootPath = public_path().'/uploads/documents/';
							$thumbnail_path = time().rand().'thumbnail.'.$request->file('thumbnail')->getClientOriginalExtension();
							$request->file('thumbnail')->move(
							$documentRootPath, $thumbnail_path);
						}else{
							Alert::error('File Error', "Please upload valid File.");
							return redirect()->back()->with('loader',true);
						}
					} else{

					Alert::error('File Error', "Please upload valid File.");
					return redirect()->back()->with('loader',true);
					}
            }
			$pdfText = '';
            $file_path = $LetterOrder->file;
            if ($request->hasFile('file')) {

				$name=$request->file('file')->getClientOriginalName();


					$isValid_Extention_Size = explode('.', $name);
					//print_r(count($isValid_Extention_Size));die;
					if(count($isValid_Extention_Size) <= 2){

				$parser = new \Smalot\PdfParser\Parser();
				//$pdf = $parser->parseFile($request->file('file'));
				//$pdfText = $pdf->getText();
                //$pdfText = preg_replace('/[^a-zA-Z0-9_ -]/s',' ',$pdfText);
				//$pdfText = nl2br($pdfText);
						if (in_array(strtolower($request->file('file')->getClientOriginalExtension()), ['pdf'])) {
							$documentRootPath = public_path().'/uploads/documents';
							$file_path = time().rand().'file.'.$request->file('file')->getClientOriginalExtension();
							$request->file('file')->move($documentRootPath, $file_path); 
						}else{
							Alert::error('File Error', "Please upload valid pdf File.");
							return redirect()->back()->with('loader',true);
						}
					}
					else{

					Alert::error('File Error', "Please rename your file, (.) not allowed!!");
					return redirect()->back()->with('loader',true);
					}


            }
            $updateData = array(
                'cat_id' => $request->category_id,
                'state_id' => implode(',',$request->state_id),
                'district' => implode(',',$request->district),
                'block' => implode(',',$request->block),
                'year_of_issue' => $request->year_of_issue,
                'title' => $request->title,
                'number_of_authors' => $request->number_of_authors,
                'name_of_authors' => $request->name_of_authors,
                'keywords' => $request->keywords,
                'thumbnail' => $thumbnail_path,
                'file' => $file_path,
				'file_content' => $pdfText,
                'description' => $request->description,
                'status' => $request->status,
            );


            $LetterOrder->update($updateData);

            Alert::success('Success', 'Publications updated successfully');
            return redirect()->route('admin.publications.index')->with('loader', true);

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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		abort_unless(\Gate::allows('publication_delete'), 403);
		Publications::where('id',$id)->delete();
        return redirect()->route('admin.publications.index')
                        ->with('success','Publication deleted successfully');
    }


	public function storeMedia(Request $request)
    {
        try{
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

        /* if (in_array($file->getClientOriginalExtension(), ['pdf','png', 'jpg', 'jpeg','PNG','JPG','JPEG'])) {
            $image = str_replace(asset('/'), '', $path . '/' . $name);
            $path = $path . '/' . $name;
            $image = str_replace('', '_', urldecode($image));

            $image = explode('/', $image);
            $name = end($image);




        }else{
            dd('no');
        } */

        return response()->json([
            'name' => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
        } catch (Exception $e) {
            Log::error($e);
            return Response::make('File not Uploaded', 400);

        }
    }

	public function getDistrictListByStates(Request $request)
	{
		$districtQry = getDistrictList($request->state_ids);
		//$districtQry = DB::table('ref_district')->whereIn('ref_state_id',$request->state_ids)->where('is_deleted', 0)->orderBy('district_name', 'Asc')->get();
		return response()->json($districtQry);
	}

	public function getBlockListByStates(Request $request)
	{
		$districtQry = getBlockList($request->district_ids);
		//$districtQry = DB::table('ref_block')->whereIn('ref_district_id',$request->district_ids)->orderBy('block_name', 'Asc')->get();
		return response()->json($districtQry);
	}

}
