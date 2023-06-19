@component('mail::message')
# {{ $patient_name }} Medical Record

Patient Name: {{ $patient_name }}

CT Scan Name: {{ $ctscan_name }}

MRI Name: {{ $mri_name }}

X-Rays:
@foreach ($xrays as $xray)

- Name: {{ $xray['name'] }}
@endforeach

Ultrasounds:
@foreach ($ultrasounds as $ultrasound)
- Name: {{ $ultrasound['name'] }}
@endforeach

Thanks
@endcomponent
