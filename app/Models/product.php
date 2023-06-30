<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
//use Illuminate\Support\Eloquent\addGlobalScope;
use Illuminate\Database\Eloquent\Builder\addGlobalScope;

use NumberFormatter;


class product extends Model {
    use HasFactory,SoftDeletes;
    const STATUS_ACTIVE = 'active';
    const STATUS_DRAFT = 'draft';
    const STATUS_ARCHIVED = 'archived';
    protected $fillable = [
        'name','slug' , 'category_id', 'description', 'short_descripion','price',
        'compare_price' , 'image','status','review'
    ];//////////FOR DEFUALT VALUES
    //protected $guarded= []; fillable more secure
    /*protected static function booted()
    {
        static::addGlobalScope('owner',function(Builder $query){
            $query->where('user_id','=',1);});

    }*/
    public function scopeActive(Builder $query){
        $query->where('Status','=','active');

    }
    public function scopeStatus(Builder $query,$status){
        $query->where('Status','=',$status);

    }


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

             public function getPriceFormattedAttribute($value) //للمهندس ضروري
          {
                $formater=new NumberFormatter('en',NumberFormatter::CURRENCY);
                return  $formater->formatCurrency($this->price,'USD');}

             public function getcomparepriceformattedAttribute()
         {


            $formater=new NumberFormatter('en',NumberFormatter::CURRENCY);
                return  $formater->formatCurrency($this->compare_price,'USD');}

             }
