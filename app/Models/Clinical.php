<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinical extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable  = ['id'];
    protected $table = 'clinicals';

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function reservationClinicals()
    {
        return $this->hasMany(reservationClinical::class);
    }

    public function workDays()
    {
        return $this->hasMany(WorkDays::class,'Clinical_Id' , 'id');
    }
}
