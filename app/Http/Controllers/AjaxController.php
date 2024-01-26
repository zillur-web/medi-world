<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Categroy;
use App\Models\Origin;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Countries;

class AjaxController extends Controller
{
    public function get_category(){
        $data = Categroy::all();
        return response()->json($data);
    }
    public function get_subcategory($id){
        $data = SubCategory::where('category_id', $id)->get();
        return response()->json($data);
    }
    public function get_brand(){
        $data = Brand::all();
        return response()->json($data);
    }
    public function get_origin(){
        $data = Origin::all();
        return response()->json($data);
    }
    public function get_country(){
        $data = Countries::getList('en');
        return response()->json($data);
    }
}
