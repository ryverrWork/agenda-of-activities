<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'day',
        'time',
        'name',
        'location',
        'number_of_participants',
        'person_in_charge',
        'phone_number',
        'notes',
        'status',
        'file_url',
        'approved_by'
    ];

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
