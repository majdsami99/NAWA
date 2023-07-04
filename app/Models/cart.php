<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasUuids; //fpr primmry key and cookie
    use HasFactory;
    protected $fillable =[
        'cookie_id','user_id','product_id','quantity'
    ];
    public function uniqueIds()
    {
        return[
            'id','cookie_id'
        ]; /// وجبت هذه الفنكشن لانه يوجد اكثرمن منغير للuuid
    }
}
