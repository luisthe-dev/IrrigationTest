<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'zone_id',
        'start_time',
        'duration',
        'days',
        'event_status'
    ];

    protected $casts = [
        'days' => 'array',
    ];

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

}
