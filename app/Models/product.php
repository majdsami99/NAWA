<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
//use Illuminate\Support\Eloquent\addGlobalScope;
use Illuminate\Database\Eloquent\Builder\addGlobalScope;
use Illuminate\Support\Facades\Auth;
use NumberFormatter;


class product extends Model {
    use HasFactory,SoftDeletes;
    const STATUS_ACTIVE = 'active';
    const STATUS_DRAFT = 'draft';
    const STATUS_ARCHIVED = 'archived';
    protected $fillable = [
        'name','slug' , 'category_id', 'description', 'short_descripion','price',
        'compare_price' , 'image','status','review','user_id'
    ];//////////FOR DEFUALT VALUES
    //protected $guarded= []; fillable more secure

    protected static function booted()
    {
       /* static::addGlobalScope('owner',function(Builder $query){
            $query->where('user_id','=',Auth::id());});
 ///https://www.youtube.com/watch?v=EELV8At5k_w&list=PL13Ag2mfco65-h--rXY_9o-DYCIPCCuP8&index=47  */

    }
    public function category()
    {
        return $this -> BelongsTo(category::class,'category_id')->withDefault([
            'name'=>'uncategorized',
            //'image'=>
        ])
        ;
    }
    public function user()
    {
        return $this -> BelongsTo(category::class,'user_id')->withDefault([
            'name'=>'no user',
            //'image'=>
        ])
        ;
    }

    public function  gallery(){
        return $this->hasMany(ProductImages::class);
    }
    public function cart(){
        return $this->belongsToMany(
        user::class, ////related model (product)
        'carts',        //ألجدول الوسيط
        'product_id' ,    //FK related model in pivot table
        'user_id',
        'id',
        'id' /////////////

        )
        ///مور اضافية ممكن نضيفها للريليشن
        ->withPivot(['quantity'])
        ->using(cart::class);

    }
    public function scopeActive(Builder $query){
        $query->where('Status','=','active');

    }
    public function scopeStatus(Builder $query,$status){
        $query->where('Status','=',$status);

    }
    public function scopeFilter(Builder $query,$filter){
       $query->when($filter['search'] ?? false,function($query,$value){
            ////$query->where('products.name','like',"%{$value}%");
           // ->orwhere('products.name','like',"%{$value}%");
           $query->where(function($query)use ($value){
            $query->where('products.name','like',"%{$value}%")
           ->orwhere('products.description','like',"%{$value}%");
           });
        })
        ->when($filter['category_id']?? false,function($query,$value){
            $query->where('products.category_id','=',$value);
        })
        ->when($filter['price_min']?? false,function($query,$value){
            $query->where('products.price','>=',$value);
        })
        ->when($filter['price_max'] ?? false,function($query,$value){
            $query->where('products.price','<=',$value);
        });

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
             return Storage ::disk('public')->Url($this->image);

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
