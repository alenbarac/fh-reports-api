<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    //  protected $with = ['waterbodies'];

    protected $fillable = [
        'id',
        'region_name',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function waterbodies()
    {
        return $this->hasMany(Waterbody::class)->orderBy('updated_at', 'desc');
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}