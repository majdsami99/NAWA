<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use NumberFormatter;


class product extends Model{
    use HasFactory;
    const STATUS_ACTIVE = 'active';
    const STATUS_DRAFT = 'draft';
    const STATUS_ARCHIVED = 'archived';
    protected $fillable = [
        'name','slug' , 'category_id', 'description', 'short_descripion','price',
        'compare_price' , 'image','status'
    ];//////////FOR DEFUALT VALUES
    //protected $guarded= []; fillable more secure
    public static function statusOptions()
    {
        return[
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_DRAFT  => 'Draft',
            self::STATUS_ARCHIVED => 'Archived'
        ];
    }
    ////atripute  accesoceris :image_url | $product->image_url
    public function getIamgeUrlAttribute()
        {

          if($this->image){
             return Storage ::disk('public')->URL($this->image);

            }
    return 'https://fakeimg.pl/600x400';
        }
        public function getNameUrlAttribute($value)
        {


             return ucwords($value) ;}
            /////// public function getPriceFormattedAttribute($value) للمهندس ضروري
         /*    {
                $formater=new NumberFormatter('en',NumberFormatter::CURRENCY);
                return  $formater->formatCurrency($this->price,'USD');



             }*/
}
