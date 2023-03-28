<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
	protected $table = 'lara_admin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'user_name',
        'email',
        'password',
        'mobile_no',
        'designation',
		'report_off',
		'status',
		'user_role',
        'created_by',
        'created_at',
        'updated_at',
        'user_type',
		'expired_date',
        'is_deleted',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime', 'expired_date' => 'datetime',
    ];

	public function roles()
	{
	    return $this->belongsToMany(Role::class);
	}
	
	public function parentUser()
	{	   
		return $this->hasOne(User::class,'id','report_off');
	}

}
