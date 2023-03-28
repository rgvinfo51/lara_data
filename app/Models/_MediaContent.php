<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MediaContent extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'cat_id',
        'state_id',
        'district_id',
        'block',
        'location',
        'x',
        'y',
        'publication_date',
        'keywords',
		'thumbnail',
        'image_caption',
        'description',
        'type_of_file',
        'file',
		'file_content',
        'status',
        'created_at',
        'updated_at',
        'is_deleted',
    ];
	
	public function category()
	{	   
		return $this->hasOne(Category::class,'id','cat_id');
	}

     
}