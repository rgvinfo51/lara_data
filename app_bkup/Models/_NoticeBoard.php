<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NoticeBoard extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
	protected $casts = [
        'notice_date' => 'datetime',
    ];
    protected $fillable = [
        'message',
		'upload_file',
		'notice_date',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
    ];

     
}