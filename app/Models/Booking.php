<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Property;

class Booking extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'property_id',
        'start_date',
        'end_date',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function property(){
        return $this->belongsTo(Property::class,'property_id');
    }
}
