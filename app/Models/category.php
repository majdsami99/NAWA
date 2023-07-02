<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class category extends Model
{
    /*const STATUS_ACTIVE = 'active';
    const STATUS_DRAFT = 'draft';
    const STATUS_ARCHIVED = 'archived';
    //protected $fillable = [
       // 'name', 'category_id', 'status' ];
       //////////FOR DEFUALT VALUES
    //protected $guarded= []; fillable more secure
    public static function statusOptions()
    {
        return[
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_DRAFT  => 'Draft',
            self::STATUS_ARCHIVED => 'Archived'
        ];
    }*/
    protected $fillable =[
        'name',



    ];
    use HasFactory;
    public function getIamgeUrlAttribute()
    {

      if($this->image){
         return Storage::disk('public')->URL($this->image);

        }
return 'https://fakeimg.pl/600x400';
    }
    public function product(){
        return $this->hasMany(product::class,'category_id');
    }

}

