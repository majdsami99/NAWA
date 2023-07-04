<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{ /// implements MustVerifyEmail  تمت الاضافة فديو ثالث بتاريخ 25/6  عند دقيقة 18
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function profile(){
        return $this->hasOne(profile::class)->withDefault([
            'name'=> 'no NAME',
        ]);
    }
    public function products(){
        return $this->hasMany(product::class);
    }
    // user has many product in the cart

    public function cart(){
        return $this->belongsToMany(
        product::class, ////related model (product)
        'carts',        //ألجدول الوسيط
        'user_id',      //FK current model in pivot table الجدول الوسيط
        'product_id' ,    //FK related model in pivot table
        'id',
        'id' /////////////

        )
        ///مور اضافية ممكن نضيفها للريليشن 
        ->withPivot(['quantity'])
        ->using(cart::class);

    }
}
