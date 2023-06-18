<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;

    //fillable fields
    protected $fillable = [
        'patient_id',
        'ctscan_id',
        'mri_id',
    ];
}
