<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waterbody extends Model
{
    use HasFactory;

   protected $fillable = ['region_id','waterbody_name','longitude', 'latitude', 'created_email', 'created_name', 'waterbody_report', 'waterbody_unlisted'];



    public function region()    
    {
        return $this->belongsTo(Region::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class)->orderBy('report_date', 'desc');
    }

    public function latestReport() {
        
    return $this->hasOne(Report::class)->latestOfMany();
    }

    public function personalReports()
    {
        return $this->hasMany(PersonalReport::class)->orderBy('report_date', 'desc');
    }
      
}