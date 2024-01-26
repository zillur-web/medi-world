<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class FileDownloadController extends Controller
{
    public function download($id){
        $product = Product::findOrFail($id);
        $filePath = public_path('uploads/catalog/'.$product->catalog);
        $fileName = $product->catalog;
        return response()->download($filePath, $fileName);
    }
    public function download2($id){
        $product = Product::findOrFail($id);
        $filePath = public_path('uploads/product/reagent/'.$product->thumbnail);
        $fileName = $product->thumbnail;
        return response()->download($filePath, $fileName);
    }
}
