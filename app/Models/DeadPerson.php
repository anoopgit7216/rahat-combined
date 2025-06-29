<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeadPerson extends Model
{
    protected $table = 'dead_person';

    protected $guarded = [];

    public function benificiaryDetails()
    {
        return $this->hasMany(BenificiaryDetails::class, 'death_person_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'added_by', 'id');
    }
   
}
