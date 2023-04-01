<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefState extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'ref_state';

    protected $fillable = ['id', 'state_code', 'state_name', 'state_hindi', 'ref_zone_id', 'created_by', 'created_at', 'updated_at', 'updated_by', 'is_deleted'];
}
