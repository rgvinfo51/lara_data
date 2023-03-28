<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
	protected $table = 'lara_admin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_name',
        'company_logo',
        'upload_letterhead',
        'admin_email',
        'username',
        'password',
		'contact',
		'gender',
		'address',
		'company_charges',
		'company_stamp',
		'agreement_text',
		'status',
		'is_active',
		'is_deleted',
		'type',
		'admin_id',
		'token',
        'created_at',
        'updated_at'        
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
	
	 

}
