<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publications extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'cat_id',
		'state_id',
		'district',
		'block',
		'year_of_issue',
		'title',
		'number_of_authors',
		'name_of_authors',
		'keywords',
		'thumbnail',
		'file',
		'file_content',
		'description',
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