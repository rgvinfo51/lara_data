<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
 

class Datalist extends Authenticatable
{
    use  HasFactory;
	protected $table = 'lara_maindata';
        protected $guarded = [];
    
     
}
