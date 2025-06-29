<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BenificiaryDetails extends Model
{

    protected $table = 'benificiary_details';

    protected $fillable = [
        'disaster_t',
        'relief_grant',
        'relief_type',
        'grants_type',
        'death_person_id',
        'aadhaar_no',
        'beneficiary_name',
        'gender',
        'father_husb_name',
        'age',
        'mobile',
        'residency',
        'address',
        'district',
        'bank_name',
        'branch',
        'account_number',
        'account_holder_name',
        'ifsc',
        'upload_bank_passbook',
        'panchnama_report',
        'postmortem_report',
    ];

    public function deadPerson()
    {
        return $this->belongsTo(DeadPerson::class, 'death_person_id', 'id');
    }

   
}