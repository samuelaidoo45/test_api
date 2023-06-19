<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $patient_name;
    public $ctscan_name;
    public $mri_name;
    public $xrays;
    public $ultrasounds;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($medical_record)
    {
        $this->patient_name = $medical_record->patient_name;

        $this->ctscan_name = $medical_record->ctscan_name;

        $this->mri_name = $medical_record->mri_name;

        $this->xrays = $medical_record->xrays;

        $this->ultrasounds =  $medical_record->ultrasounds;


    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('christianoronald567@gmail.com', 'Samuel Aidoo')
        ->subject('Backend Developer Test')->markdown('emails.email');
    }

}
