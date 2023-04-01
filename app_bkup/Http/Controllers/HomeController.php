<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MediaContent;
use App\Models\Publications;
use App\Models\RefBlock;
use App\Models\RefDistrict;
use App\Models\RefState;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home(Request $request)
    {
		$media_contents = Category::with('categoryMedia')->orderBy('id','ASC')->get();
		$publication_content = Category::with('categoryPublication')->orderBy('id','ASC')->get();	 
			
		$data['media_contents'] = $media_contents;
		$data['publication_content'] = $publication_content;
		 
        $data['images'] = MediaContent::where('type_of_file',0)->get();
        $data['videos'] = MediaContent::where('type_of_file',1)->get();
        //$data['medias'] = MediaContent::all();
        //$data['publications'] = Publications::all();
        $data['categories'] = Category::orderBy('name','ASC')->get();
        //$data['blocks'] = RefBlock::orderBy('block_name','ASC')->get();
        //$data['districts'] = RefDistrict::orderBy('district_name','ASC')->get();
        $data['states'] = getStateList();
		
        return view('home',$data);
    }

    public function media(Request $request)
    {
		if($request->type == 1)
			{
			$search_result = array();
			$cat_id = $request->cat_id;
			$state_id = $request->state_id;
			$district_id = $request->district_id;
			$year_of_issue = $request->year_of_issue;
			$name_of_author = $request->name_of_author;
			$keywords = $request->media_keywords;
			 
			$media_search = MediaContent::query();
				$media_search->when($cat_id != '',function($q) use ($cat_id){
					return $q->where('cat_id','=', $cat_id);
				});
				$media_search->when($state_id != '',function($q) use ($state_id){
					if($state_id != "All")
					{
					return $q->where('state_id','=', $state_id);
					}
				});
				$media_search->when($district_id != '',function($q) use ($district_id){
					if($district_id != "All")
					{
						return $q->whereRaw("find_in_set('".$district_id."',district_id)");						 
					}
				});
				//$media_search->when($year_of_issue != '',function($q) use ($year_of_issue){
					//return $q->where('year_of_issue','=', $year_of_issue);
				//});
				//$media_search->when($name_of_author != '',function($q) use ($name_of_author){
					//return $q->where('name_of_authors','=', $name_of_author);
							 
				//});
				$media_search->when($keywords != '',function($q) use ($keywords){
					return $q->where('keywords','like', '%' .$keywords. '%')
							 //->orWhere('title','like', '%' .$keywords. '%')
							// ->orWhere('file_content','like', '%' .$keywords. '%')
							 ->orWhere('description','like', '%' .$keywords. '%');
				});
				$search_result = $media_search->paginate(12);
			 
				$data['medias'] = $search_result;
			}else{
				$data['medias'] = MediaContent::paginate(12);
			}	
				
		
		$data['categories'] = Category::orderBy('name','ASC')->get();
        //$data['blocks'] = RefBlock::orderBy('block_name','ASC')->get();
        //$data['districts'] = RefDistrict::orderBy('district_name','ASC')->get();
        $data['states'] = getStateList();
        
        return view('media',$data);
    }

    public function mediaDetail($id)
    {		
        $data['media'] = MediaContent::where('id',$id)->first();
        return view('media-detail',$data);
    }

    public function publicationDetail($id)
    {
        $data['publication'] = Publications::where('id',$id)->first();
        return view('publication-detail',$data);
    }

    public function publications(Request $request)
    {
		if($request->type == 2)
		{
			$search_result = array();
			$cat_id = $request->cat_id;
			$state_id = $request->state_id;
			$district_id = $request->district_id;
			$year_of_issue = $request->year_of_issue;
			$name_of_author = $request->name_of_author;
			$keywords = $request->keywords;
			 
			$publication_search = Publications::query();
				$publication_search->when($cat_id != '',function($q) use ($cat_id){
					return $q->where('cat_id','=', $cat_id);
				});
				$publication_search->when($state_id != '',function($q) use ($state_id){
					if($state_id != "All")
					{
					return $q->where('state_id','=', $state_id);
					}
				});
				$publication_search->when($district_id != '',function($q) use ($district_id){
					if($district_id != "All")
					{
						return $q->whereRaw("find_in_set('".$district_id."',district)");						 
					}
				});
				$publication_search->when($year_of_issue != '',function($q) use ($year_of_issue){
					return $q->where('year_of_issue','=', $year_of_issue);
				});
				$publication_search->when($name_of_author != '',function($q) use ($name_of_author){
					return $q->where('name_of_authors','like', '%' .$name_of_author. '%');
							 
				});
				$publication_search->when($keywords != '',function($q) use ($keywords){
					return $q->where('keywords','like', '%' .$keywords. '%')
							 ->orWhere('title','like', '%' .$keywords. '%')
							 ->orWhere('file_content','like', '%' .$keywords. '%')
							 ->orWhere('description','like', '%' .$keywords. '%');
				});
		 
			$data['publications'] = $publication_search->paginate(12);		 
		}else{
			 $data['publications'] = Publications::paginate(12);
		}
		
		$data['categories'] = Category::orderBy('name','ASC')->get();
       // $data['blocks'] = RefBlock::orderBy('block_name','ASC')->get();
        //$data['districts'] = RefDistrict::orderBy('district_name','ASC')->get();
        $data['states'] = getStateList();
       
        return view('publications',$data);
    }

    public function getSearchResult(Request $request){
        try {
            $this->validate($request, [
                'type' => 'required',
                //'keyword' => 'required',
            ]);
            $html = '';
            $type = $request->type;
            $keyword = $request->keyword;
            if($type == 'media'){
                $datas = MediaContent::where(function ($query) use($keyword){
                    $query->where('keywords', 'like', '%' . $keyword . '%')
                        ->orWhere('image_caption', 'like', '%' . $keyword . '%')
                        ->orWhere('description', 'like', '%' . $keyword . '%');
                })->get();
                if($datas->count() > 0) {
                    foreach ($datas as $data) {
                        $html .= '<div class="list-element">
                            <h5 class="mb-1"><a href="javascript:void(0);">' . $data->keywords . '</a></h5>
                            <div class="d-flex flex-column flex-sm-row">
                                <div class="flex-shrink-0">';
                        if ($data->type_of_file == 1) {
                            $html .= '<video width="320" height="240" controls>
                                            <source src="' . url('/public/uploads/documents/' . $data->file) . '" type="video/' . explode(".", $data->file)[1] . '">
                                        </video>';
                        } else {
                            $html .= '<img src="' . url('/public/uploads/documents/' . $data->file) . '" style="width: 250px; height: 200px;"/>';
                        }
                        $html .= '</div>
                                <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                    <p class="text-muted mb-0">' . $data->description . '</p>
                                    <div class="border border-dashed mb-1 mt-3"></div>
                                    <a href="' . route('mediaDetail', [$data->id]) . '" class="btn btn-primary" style="float: left;">Read More</a>
									
                                </div>
                            </div>
                        </div><hr>';
                    }
                }else{
                    $html = '<h3>No record found</h3>';
                }
            }else{
                $datas = Publications::where(function ($query) use($keyword){
                    $query->where('title', 'like', '%' . $keyword . '%')
                        ->orWhere('name_of_authors', 'like', '%' . $keyword . '%')
                        ->orWhere('keywords', 'like', '%' . $keyword . '%')
                        ->orWhere('description', 'like', '%' . $keyword . '%');
                })->get();
                if($datas->count() > 0) {
                    foreach ($datas as $data) {
                        $html .= '<div class="list-element">
                            <h5 class="mb-1"><a href="javascript:void(0);">' . $data->title . '</a></h5>
                            <div class="d-flex flex-column flex-sm-row">
                                <div class="flex-shrink-0">';
                        $html .= '<a href="' . url('public/uploads/documents/' . $data->file) . '" target="_blank"><img src="' . url('public/uploads/documents/' . $data->thumbnail) . '" style="width: 250px; height: 200px;"/></a>';
                        $html .= '</div>
                                <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                    <p class="text-muted mb-0">' . $data->description . '</p>
                                    <div class="border border-dashed mb-1 mt-3"></div>
                                    <a href="' . route('publicationDetail', [$data->id]) . '" class="btn btn-primary" style="float: left;margin-right: 5px;">Read More</a>
									<a download href="' . url('public/uploads/documents/' . $data->file) . '" class="btn btn-primary" style="float: left;">Download</a>
                                </div>
                            </div>
                        </div><hr>';
                    }
                }else{
                    $html = '<h3>No record found</h3>';
                }
            }

            return $html;
        } catch (Exception $e) {
            Alert::error('Error', $e->getMessage());
            \Log::error($e->getMessage());
            abort(404);
        }
    }
	
	
	public function searchMediaPublication(Request $request)
	{
		try {
			$search_result = array();	 
			 
			if($request->type == 1)
			{
				 
				$cat_id = $request->cat_id;
				$state_id = $request->state_id;
				$district_id = $request->district_id;
				$year_of_issue = $request->year_of_issue;
				$name_of_author = $request->name_of_author;
				$keywords = $request->media_keywords;
				 
				$media_search = MediaContent::query();
					$media_search->when($cat_id != '',function($q) use ($cat_id){
						return $q->where('cat_id','=', $cat_id);
					});
					$media_search->when($state_id != '',function($q) use ($state_id){
						if($state_id != "All")
						{
						return $q->where('state_id','=', $state_id);
						}
					});
					$media_search->when($district_id != '',function($q) use ($district_id){
						if($district_id != "All")
						{
							return $q->whereRaw("find_in_set('".$district_id."',district_id)");						 
						}
					});
					//$media_search->when($year_of_issue != '',function($q) use ($year_of_issue){
						//return $q->where('year_of_issue','=', $year_of_issue);
					//});
					//$media_search->when($name_of_author != '',function($q) use ($name_of_author){
						//return $q->where('name_of_authors','=', $name_of_author);
								 
					//});
					$media_search->when($keywords != '',function($q) use ($keywords){
						return $q->where('keywords','like', '%' .$keywords. '%')
								 //->orWhere('title','like', '%' .$keywords. '%')
								 //->orWhere('file_content','like', '%' .$keywords. '%')
								 ->orWhere('description','like', '%' .$keywords. '%');
					});
				 $search_result = $media_search->paginate(12);
				
				
			}elseif($request->type == 2)
			{
				 
				$cat_id = $request->cat_id;
				$state_id = $request->state_id;
				$district_id = $request->district_id;
				$year_of_issue = $request->year_of_issue;
				$name_of_author = $request->name_of_author;
				$keywords = $request->keywords;
				 
				$publication_search = Publications::query();
					$publication_search->when($cat_id != '',function($q) use ($cat_id){
						return $q->where('cat_id','=', $cat_id);
					});
					$publication_search->when($state_id != '',function($q) use ($state_id){
						if($state_id != "All")
						{
						return $q->where('state_id','=', $state_id);
						}
					});
					$publication_search->when($district_id != '',function($q) use ($district_id){
						if($district_id != "All")
						{
							return $q->whereRaw("find_in_set('".$district_id."',district)");						 
						}
					});
					$publication_search->when($year_of_issue != '',function($q) use ($year_of_issue){
						return $q->where('year_of_issue','=', $year_of_issue);
					});
					$publication_search->when($name_of_author != '',function($q) use ($name_of_author){
						return $q->where('name_of_authors','like', '%' .$name_of_author. '%');
								 
					});
					$publication_search->when($keywords != '',function($q) use ($keywords){
						return $q->where('keywords','like', '%' .$keywords. '%')
								 ->orWhere('title','like', '%' .$keywords. '%')
								 ->orWhere('file_content','like', '%' .$keywords. '%')
								 ->orWhere('description','like', '%' .$keywords. '%');
					});
				 $search_result = $publication_search->paginate(12);		
			}
			
		$data['search_result'] = $search_result;
		 
        $data['images'] = MediaContent::where('type_of_file',0)->get();
        $data['videos'] = MediaContent::where('type_of_file',1)->get();
        $data['medias'] = MediaContent::all();
        $data['publications'] = Publications::all();
        $data['categories'] = Category::orderBy('name','ASC')->get();
       // $data['blocks'] = RefBlock::orderBy('block_name','ASC')->get();
       // $data['districts'] = RefDistrict::orderBy('district_name','ASC')->get();
       $data['states'] = getStateList();
		
        return view('search_media_publication',$data);
			 
		 
			
		} catch (Exception $e) {
            Alert::error('Error', $e->getMessage());
            \Log::error($e->getMessage());
            abort(404);
        }
	}
	
/* 	public function getDistrictListByStates(Request $request)
	{	
		 
		$districtQry = DB::table('ref_district')->whereIn('ref_state_id',$request->state_ids)->where('is_deleted', 0)->orderBy('district_name', 'Asc')->get();
		return response()->json($districtQry);
	}
	
	public function getBlockListByStates(Request $request)
	{		
		$districtQry = DB::table('ref_block')->whereIn('ref_district_id',$request->district_ids)->orderBy('block_name', 'Asc')->get();
		return response()->json($districtQry);
	}
	 */
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
