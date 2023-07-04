<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class order extends Model
{
    use HasFactory;
    protected  $fillable =[
        'user_id',
        'custmer_first_name',
        'custmer_last_name',
        'custmer_email',
       'custmer_phone',
       'custmer_addres',
        'custmer_city',
        'custmer_postal_code',
        'custmer_province',
       'custmer_country_code',
       'status',
        'payment_status'

    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function products(){
        return $this->belongsTo(product::class,'order_lines')
        ->withpivot();
    }

}
