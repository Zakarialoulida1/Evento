<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'Event_id',
        'user_id',
        'status',
        'ticket_number',
    ];

    public function event()
    {
        return $this->belongsTo(Evenement::class, 'Event_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

   
}
