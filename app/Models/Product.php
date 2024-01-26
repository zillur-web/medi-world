<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Categroy::class, 'category_id', 'id');
    }
    public function subcategory(){
        return $this->belongsTo(SubCategory::class, 'subcategory_id', 'id');
    }

    public function featuredImages(){
        return $this->hasMany(ProductFeaturedImage::class, 'product_id');
    }
    public function product_info(){
        return $this->hasMany(ProductExtaInfo::class, 'product_id');
    }
    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }
    public function origin(){
        return $this->belongsTo(Origin::class, 'origin_id', 'id');
    }
}
