<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Evenement extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'title',
        'description',
        'date',
        'location',
        'categorie_id',
        'available_places',
        'type_of_reservation',
        'status',
        'user_id',
        'image',
    ];

    public function category()
{
    return $this->belongsTo(Categorie::class, 'categorie_id');
}

public function organizer()
{
    return $this->belongsTo(User::class, 'user_id');
}

public function reservations()
{
    return $this->belongsToMany(User::class, 'event_reservations');
}

}
