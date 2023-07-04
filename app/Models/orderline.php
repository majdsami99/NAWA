<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderline extends Model
{
    use HasFactory;
    protected  $fillable =[
        'order_id','product_id','product_name','price','quantity',
    ];
    public function order ()
    {
        return $this->belongsTo(order::class);
    }
    public function product ()
    {
        return $this->belongsTo(product::class)->withDefault();

    }

}

