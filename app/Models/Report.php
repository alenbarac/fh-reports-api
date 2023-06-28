<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'column_value_1', 'column_value_2', 'column_value_3', 'column_value_4', 'column_value_5', 'column_value_6', 'column_value_7', 'column_value_8', 'column_value_9', 'column_value_10', 'column_value_11', 'column_value_12', 'report_date'];

    protected $casts = [
        'report_date' => 'datetime:Y-m-d',
    ];

    public function waterbody()
    {
        return $this->belongsTo(Waterbody::class);
    }
}