<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    public function reservationClinics()
    {
        return $this->hasMany(ReservationClinical::class);
    }
    public function reservationDoctors()
    {
        return $this->hasMany(ReservationDoctor::class);
    }
}
