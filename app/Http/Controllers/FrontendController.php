<?php

namespace App\Http\Controllers;

use App\Helpers\Constant;
use App\Mail\SendSMSForClient;
use App\Models\AboutUs;
use App\Models\Categroy;
use App\Models\Director;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    public function index(){
        $pageTitle = "Medical Equipment's Importer & Supplier";
        $categories = Categroy::paginate(20);
        $latestProducts = Product::where('type', Constant::PRODUCT_TYPE['normal'])->orderByRaw('indexing IS NOT NULL DESC, COALESCE(indexing, id) ASC')->take(12)->get();
        return view('frontend.index', compact('pageTitle', 'categories', 'latestProducts'));
    }
    public function contact(){
        $pageTitle = "Contact Us";
        return view('frontend.contact', compact('pageTitle'));
    }
    public function aboutUs(){
        $pageTitle = "About Us";
        $data = AboutUs::findOrFail(1);
        return view('frontend.about-us', compact('pageTitle', 'data'));
    }
    public function directorMessage(){
        $pageTitle = "Message From Managing Director";
        $data = Director::findOrFail(1);
        return view('frontend.director-message', compact('pageTitle', 'data'));
    }

    public function products(){
        $pageTitle = "All Products";
        $products = Product::orderBy('id', 'ASC');
        // where('type', Constant::PRODUCT_TYPE['normal'])->
        if(request()->has('category')){
            $cat = Categroy::findOrfail(request()->category);
            $products = $products->where('category_id', request()->category);
            $pageTitle = $cat->category_name." Products";
        }
        else if(request()->has('subcategory')){
            $subcat = SubCategory::findOrfail(request()->subcategory);
            $products = $products->where('subcategory_id', request()->subcategory);
            $pageTitle = $subcat->subcategory." Products";
        }
        else{
            $products = $products;
        }

        $products = $products->paginate(20);
        return view('frontend.products', compact('pageTitle', 'products'));
    }

    public function productView($id, string $string){
        $pageTitle = "Product View";
        $product = Product::findOrFail($id);
        return view('frontend.product-view', compact('pageTitle', 'product'));
    }

    public function sendMail(Request $request){
        $data = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'phone' => ['required'],
            'message' => ['required']
        ]);
        $mailData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message
        ];
        Mail::to('mediworldservice.bd@gmail.com')->send(new SendSMSForClient($mailData));
        return redirect()->back()->with('success', 'Message Sent Successfully!');
    }

}
