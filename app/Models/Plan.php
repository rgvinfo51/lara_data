<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
	protected $table = 'lara_plans';
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'plan_name',
        'plan_duration',
		'plan_total_forms',
		'plan_min_accuracy',
		'plan_rate_per_form',		
        'created_at',
        'updated_at',          
    ];
	
	
/*	public function categoryMedia()
	{	   
		return $this->hasMany(MediaContent::class,'cat_id','id')->latest('id')->limit(4);
	}
	
	public function categoryPublication()
	{	   
		return $this->hasMany(Publications::class,'cat_id','id');
	}
*/
     
}