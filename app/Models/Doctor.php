<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function clinicals()
    {
        return $this->hasMany(Clinical::class);
    }

    public function reservationDoctors()
    {
        return $this->hasMany(ReservationDoctor::class);
    }
}
