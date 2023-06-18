<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecordUltrasoundOption extends Model
{
    use HasFactory;

    // fillable fields
    protected $fillable = [
        'medical_record_id',
        'ultrasound_option_id',
        'ultrasound_option_name'
    ];
}
