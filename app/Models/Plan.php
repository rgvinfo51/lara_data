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
		'status',
        'created_at',
        'updated_at',          
    ];
	
	 
     
}