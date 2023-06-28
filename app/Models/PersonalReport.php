<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersonalReport extends Model
{
    use HasFactory;

    protected $casts = [
        'report_approved' => 'boolean',
        'report_date' => 'datetime:Y-m-d',
    ];

    protected $fillable = ['waterbody_id', 'poster_name', 'poster_email', 'poster_message', 'report_approved', 'report_date'];

    

    public function waterbody()
    {
        return $this->belongsTo(Waterbody::class);
    }

}