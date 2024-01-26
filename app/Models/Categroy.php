<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Categroy extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function products(){
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
    public function subcategory(){
        return $this->hasMany(SubCategory::class, 'category_id', 'id');
    }




}
