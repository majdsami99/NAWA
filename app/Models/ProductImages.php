<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImages extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id', 'image'
    ];

    public function getIUrlAttribute()
    {

        if ($this->image) {
            return Storage::disk('public')->url($this->image);
        }
    }
    public function product()
    {
        return $this -> BelongsTo(product::class,'')->withDefault([
            'name'=>'no images',
            //'image'=>
        ])
        ;
    }
}
