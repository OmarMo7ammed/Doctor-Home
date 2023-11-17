<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationClinical extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function clinical()
    {
        return $this->belongsTo(Clinical::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

}
