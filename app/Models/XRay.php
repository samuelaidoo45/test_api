<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class XRay extends Model
{
    use HasFactory;

    //fillable fields
    protected $fillable = [
        'xray_id',
        'name',
    ];
}
