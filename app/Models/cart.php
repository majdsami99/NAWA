<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class cart extends Pivot
{
    use HasUuids; //fpr primmry key and cookie
    use HasFactory;
    protected  $table ='carts';
    protected $fillable =[
        'cookie_id','user_id','product_id','quantity'
    ]; //uuid عبارة عن  سترينق يجب استخدام التريت لل uuid
    public function user(){
        return $this->belongsTo(user::class)->withDefault();
    }
    public function product(){
        return $this->belongsTo(product::class);
    }
    /* public function uniqueIds()
    {
        return[
            'id',//'cookie_id'
        ]; /// وجبت هذه الفنكشن لانه يوجد اكثرمن منغير للuuid
    } */
}
