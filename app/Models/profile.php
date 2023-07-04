<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    use HasFactory;

    protected $fillable =[
        'first_name','last_name','gender','Birthday','address','city',
        'postal_code','province','ccountry_code',

    ];

    public function user()
    {
        return $this->belongsTo(user::class, 'user_id');
    }
    }

