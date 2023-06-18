<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecordXrayOption extends Model
{
    use HasFactory;

    //fillable fields
    protected $fillable = [
        'medical_record_id',
        'xray_option_id',
        'xray_option_name'
    ];
}
