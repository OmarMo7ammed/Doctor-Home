<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkDays extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable  = ['Clinical_Id','Status',
    'Patient_Number','Day','To_Time','From_Time'];
    protected $table = 'work_days';

    public function clinical()
    {
        return $this->belongsTo(Clinical::class);
    }

}
