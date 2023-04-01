<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class TaskReport extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
	protected $table = 'lara_users';
        protected $guarded = [];
    
    
        public function parentUser()
	{	   
		return $this->hasOne(Admin::class,'id','admin_id');
	}

      

}
