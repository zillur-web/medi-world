<?php
    function categories(){
        return App\Models\Categroy::all();
    }
    function product_count_for_cat_id($cat_id){
        return App\Models\Product::where('category_id', $cat_id)->get()->count();
    }

    function latest_product(){
        return App\Models\Product::latest()->limit(8)->get();
    }
    function companyInfo(){
        return App\Models\ComapanyInfo::findOrFail(1);
    }
    function socials(){
        return App\Models\Socials::findOrFail(1);
    }
?>
