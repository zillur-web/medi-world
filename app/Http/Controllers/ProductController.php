<?php

namespace App\Http\Controllers;

use App\Helpers\Constant;
use App\Helpers\Traits\RowIndex;
use App\Http\Requests\Rules\ProductThumbnailCheck;
use App\Models\Product;
use App\Models\ProductExtaInfo;
use App\Models\ProductFeaturedImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    use RowIndex;
    public function index(){
        $pageTitle = 'Product List';

        if (request()->ajax()) {
            $data = Product::orderBy('id', 'DESC');

            $dataCollection = $data;
            return DataTables::of($dataCollection)
                ->addColumn('sl', function ($row) {
                    return $this->dt_index($row);
                })
                ->addColumn('product', function ($row) {
                    $cat = $row->category->category_name ?? 'N/A';
                    $subcat = $row->subcategory->subcategory ?? 'N/A';
                    $info = <<<HTML
                        <table class="table table-sm table-bordered mb-0">
                            <tr class="bg-transparent">
                                <td style="width: 100px !important;" class="font-weight-bolder">Title</td>
                                <td style="width: 2px !important;" class="font-weight-bolder">:</td>
                                <td>$row->title</td>
                            </tr>
                            <tr class="bg-transparent">
                                <td style="width: 100px !important;" class="font-weight-bolder">Sub Title</td>
                                <td style="width: 2px !important;" class="font-weight-bolder">:</td>
                                <td>$row->sub_title</td>
                            </tr>
                            <tr class="bg-transparent">
                                <td style="width: 100px !important;" class="font-weight-bolder">Category</td>
                                <td style="width: 2px !important;" class="font-weight-bolder">:</td>
                                <td>$cat</td>
                            </tr>
                            <tr class="bg-transparent">
                                <td style="width: 100px !important;" class="font-weight-bolder">Sub Category</td>
                                <td style="width: 2px !important;" class="font-weight-bolder">:</td>
                                <td>$subcat</td>
                            </tr>
                        </table>
                    HTML;
                    return $info;
                })
                ->addColumn('image', function ($row) {
                    if($row->thumbnail != null){
                        $img = asset('uploads/product/'.$row->thumbnail);
                    }
                    else{
                        $img = asset('uploads/product/'.$row->thumbnail);
                    }
                    $html = '<div class="text-center" uk-lightbox><a href="'.$img.'">
                        <img style="width: 70px; border: 1px solid #ddd; border-radius: 4px; padding: 1px;" src="'. $img .'" alt="">
                    </a></div>';
                    return $html;
                })
                ->addColumn('latest_product', function ($row) {
                    $checked = '';
                    if($row->indexing != null){
                        $checked = 'checked';
                    }

                    $html = <<<HTML
                                <div class="form-check">
                                    <input style="float: none;" name="product_index" type="checkbox" class="form-check-input" id="product_index" onclick="product_index($row->id)" $checked>
                                    <label class="form-check-label" for="product_index">$row->indexing</label>
                                </div>
                            HTML;
                    return $html;
                })
                ->addColumn('action', function ($row) {

                    $btn2 = '<button onclick="destroy('. $row->id .')" type="button" class="btn btn-sm btn-danger " style="padding: 5px 6px;"><i class="bx bxs-message-square-x"></i></button>';

                    if($row->type == Constant::PRODUCT_TYPE['reagent']){
                        $btn1 = '<a href="'.route('product.reagent.edit', $row->id).'"  class="btn btn-sm btn-primary me-2 " style="padding: 5px 6px;"><i class="bx bx-edit"></i></a>';
                    }
                    else{
                        $btn1 = '<a href="'.route('product.edit', $row->id).'"  class="btn btn-sm btn-primary me-2 " style="padding: 5px 6px;"><i class="bx bx-edit"></i></a>';
                    }

                    $btn3 = '<a target="_blank" href="'. route('home.product.view', ['id' => $row->id, 'slug' => $row->slug]) .'" class="btn btn-sm btn-success me-2 " style="padding: 5px 6px;"><i class="bx bxs-show"></i></a>';
                    return $btn3.$btn1.$btn2;
                })
                ->rawColumns(['action', 'image', 'sl', 'product', 'latest_product'])
                ->make(true);
        }

        return view('admin.pages.products.products', compact('pageTitle'));
    }
    public function create(){
        $pageTitle = 'Create Product';
        return view('admin.pages.products.create', compact('pageTitle'));
    }

    public function store(Request $request){
        $data = $request->validate([
            'category_id' => ['required'],
            'subcategory_id' => ['nullable'],
            'brand_id' => ['nullable'],
            'origin_id' => ['nullable'],
            'country' => ['nullable'],
            'title' => ['required'],
            'sub_title' => ['required'],
            'slug' => ['required', 'unique:products'],
            'thumbnail' => ['required', 'mimes:jpg,png,jpeg,gif,svg'],
            'catalog' => ['nullable', 'mimes:jpg,png,jpeg,pdf'],
        ]);

        $slug = Str::slug($request->slug, '-').'-'.rand(1,500);

        $data = new Product;
        $data->category_id = $request->category_id;
        $data->subcategory_id = $request->subcategory_id;
        $data->brand_id = $request->brand_id;
        $data->origin_id = $request->origin_id;
        $data->country = $request->country;
        $data->title = $request->title;
        $data->sub_title = $request->sub_title;
        $data->slug = $slug;
        $data->description = $request->description;
        if($request->policy){
            $data->policy = Constant::POLICY_STATUS['active'];
        }
        if($request->terms){
            $data->terms = Constant::TERMS_STATUS['active'];
        }
        $data->type = Constant::PRODUCT_TYPE['normal'];
        $data->status = Constant::PRODUCT_STATUS['active'];

        if ($request->hasFIle('thumbnail')){
            $thumbnail = $request->file('thumbnail');
            $thumbnail_name = $slug.'.'.$thumbnail->getclientoriginalextension();
            Image::make($thumbnail)->save(public_path('uploads/product/'.$thumbnail_name));
            $data->thumbnail = $thumbnail_name;
        }
        if ($request->hasFIle('catalog')){
            $catalog = $request->file('catalog');
            $catalog_name = $slug.'-catalog.'.$catalog->getclientoriginalextension();
            // Image::make($catalog)->save(public_path('uploads/catalog/'.$catalog_name));
            $catalog->move(public_path('uploads/catalog'), $catalog_name);
            $data->catalog = $catalog_name;
        }

        $data->save();

        if($request->hasFile('featured_image')){
            $featured_image = $request->file('featured_image');
            foreach($featured_image as $value){
                $ga_image_name = $slug.'-featured-image-product-id-'.rand(100,900).'-'.$data->id.'.'.$value->getclientoriginalextension();
                Image::make($value)->save(public_path('uploads/product/'.$ga_image_name));
                $gallery = new ProductFeaturedImage;
                $gallery->product_id = $data->id;
                $gallery->image = $ga_image_name;
                $gallery->save();
            }
        }

        if($request->row_id){
            foreach($request->row_id as $key => $value){
                $extra_info = new ProductExtaInfo;
                $extra_info->product_id = $data->id;
                $extra_info->info_title = $request->info_title[$key];
                $extra_info->info_details = $request->info_details[$key];
                $extra_info->save();
            }
        }

        flash()->addSuccess('Product Added Successfully!');
        return redirect()->route('product.index');
    }

    public function destroy($id){
        $product = Product::findOrFail($id);
        if($product == true){

            $product->featuredImages()->get();
            $product->product_info()->delete();

            $product->delete();
            return response()->json($product);
        }
        return response()->json($product);
    }

    public function edit($id){
        $pageTitle = 'Product Edit';
        $product = Product::findOrFail($id);
        return view('admin.pages.products.edit', compact('pageTitle', 'product'));
    }

    public function infoItem($id){
        $item = ProductExtaInfo::findOrFail($id);
        $item->delete();
        return response()->json($item);
    }
    public function feature_remove($id){
        $item = ProductFeaturedImage::findOrFail($id);
        $item->delete();
        return response()->json($item);
    }
    public function thumbnail_remove(int $id, string $field_name){
        $data = Product::findOrFail($id);

        if($field_name == 'thumbnail'){
            if($data->thumbnail != null){
                $old_img = public_path('uploads/product/'.$data->thumbnail);
                if (file_exists($old_img)) {
                    unlink($old_img);
                }
                $data->thumbnail = null;
                $data->save();
            }
            return response()->json($field_name);
        }

        if($field_name == 'catalog'){
            if($field_name != null){
                $old_catalog = public_path('uploads/catalog/'.$data->catalog);
                if (file_exists($old_catalog)) {
                    unlink($old_catalog);
                }
                $data->catalog = null;
                $data->save();
            }
            return response()->json($field_name);
        }

        return response()->json('error');
    }

    public function update(Request $request, $id){
        $data = $request->validate([
            'category_id' => ['required'],
            'subcategory_id' => ['nullable'],
            'brand_id' => ['nullable'],
            'origin_id' => ['nullable'],
            'country' => ['nullable'],
            'title' => ['required'],
            'sub_title' => ['required'],
            'thumbnail' => ['nullable', 'mimes:jpg,png,jpeg,gif,svg', new ProductThumbnailCheck($id)],
            'catalog' => ['nullable', 'mimes:jpg,png,jpeg,pdf'],
        ]);


        $data = Product::findOrFail($id);
        $data->category_id = $request->category_id;
        $data->subcategory_id = $request->subcategory_id;
        $data->brand_id = $request->brand_id;
        $data->origin_id = $request->origin_id;
        $data->country = $request->country;
        $data->title = $request->title;
        $data->sub_title = $request->sub_title;
        $data->description = $request->description;
        if($request->policy){
            $data->policy = Constant::POLICY_STATUS['active'];
        }
        if($request->terms){
            $data->terms = Constant::TERMS_STATUS['active'];
        }
        $data->status = Constant::PRODUCT_STATUS['active'];

        if ($request->hasFIle('thumbnail')){
            if($data->thumbnail != null){
                $old_img = public_path('uploads/product/'.$data->thumbnail);
                if (file_exists($old_img)) {
                    unlink($old_img);
                }
            }

            $thumbnail = $request->file('thumbnail');
            $thumbnail_name = $data->slug.'-updated-'.rand(100,900).'.'.$thumbnail->getclientoriginalextension();
            Image::make($thumbnail)->save(public_path('uploads/product/'.$thumbnail_name));
            $data->thumbnail = $thumbnail_name;
        }

        if ($request->hasFIle('catalog')){
            if($data->catalog != null){
                $old_img = public_path('uploads/catalog/'.$data->catalog);
                if (file_exists($old_img)) {
                    unlink($old_img);
                }
            }
            $catalog = $request->file('catalog');
            $catalog_name = $data->slug.'-catalog-updated-'.rand(100,900).'.'.$catalog->getclientoriginalextension();
            $catalog->move(public_path('uploads/catalog'), $catalog_name);
            $data->catalog = $catalog_name;
        }

        if($request->hasFile('featured_image')){
            $featured_image = $request->file('featured_image');
            foreach($featured_image as $value){
                $ga_image_name = $data->slug.'-featured-image-product-id-'.rand(100,900).'-updated-'.$data->id.'.'.$value->getclientoriginalextension();
                Image::make($value)->save(public_path('uploads/product/'.$ga_image_name));
                $gallery = new ProductFeaturedImage;

                $gallery->product_id = $data->id;
                $gallery->image = $ga_image_name;
                $gallery->save();
            }
        }

        if($request->row_id){
            ProductExtaInfo::where('product_id', $data->id)->delete();
            foreach($request->row_id as $key => $value){
                $extra_info = new ProductExtaInfo;
                $extra_info->product_id = $data->id;
                $extra_info->info_title = $request->info_title[$key];
                $extra_info->info_details = $request->info_details[$key];
                $extra_info->save();
            }
        }

        $data->save();

        flash()->addSuccess('Product Update Successfully!');
        return redirect()->route('product.index');
    }

    public function reagentCreate(){
        $pageTitle = 'Reagent Product Create';
        return view('admin.pages.products.reagent-create', compact('pageTitle'));
    }

    public function reagentStore(Request $request){
        $data = $request->validate([
            'category_id' => ['required'],
            'subcategory_id' => ['required'],
            'title' => ['required'],
            'sub_title' => ['required'],
            'slug' => ['required', 'unique:products'],
            'thumbnail' => ['required', 'mimes:jpg,png,jpeg,pdf,PDF'],
        ]);

        $slug = Str::slug($request->slug, '-').'-'.rand(1,500);

        $data = new Product;
        $data->category_id = $request->category_id;
        $data->subcategory_id = $request->subcategory_id;
        $data->title = $request->title;
        $data->sub_title = $request->sub_title;
        $data->slug = $slug;
        $data->type = Constant::PRODUCT_TYPE['reagent'];
        $data->status = Constant::PRODUCT_STATUS['active'];

        if ($request->hasFIle('thumbnail')){
            $thumbnail = $request->file('thumbnail');
            $thumbnail_name = $slug.'.'.$thumbnail->getclientoriginalextension();
            $thumbnail->move(public_path('uploads/product/reagent/'), $thumbnail_name);
            $data->thumbnail = $thumbnail_name;
        }
        $data->description = $request->description;
        $data->save();

        flash()->addSuccess('Product Added Successfully!');
        return redirect()->route('product.index');
    }

    public function reagent_thumbnail_remove(int $id, string $field_name){
        $data = Product::findOrFail($id);

        if($field_name == 'thumbnail'){
            if($data->thumbnail != null){
                $old_img = public_path('uploads/product/reagent/'.$data->thumbnail);
                if (file_exists($old_img)) {
                    unlink($old_img);
                }
                $data->thumbnail = null;
                $data->save();
            }
            return response()->json($field_name);
        }

        if($field_name == 'catalog'){
            if($field_name != null){
                $old_catalog = public_path('uploads/catalog/'.$data->catalog);
                if (file_exists($old_catalog)) {
                    unlink($old_catalog);
                }
                $data->catalog = null;
                $data->save();
            }
            return response()->json($field_name);
        }

        return response()->json('error');
    }

    public function reagentEdit($id){
        $pageTitle = 'Reagent Product Edit';
        $product = Product::findOrFail($id);
        return view('admin.pages.products.edit-reagent-create', compact('pageTitle', 'product'));
    }

    public function reagentUpdate(Request $request, $id){
        $data = $request->validate([
            'category_id' => ['required'],
            'subcategory_id' => ['required'],
            'title' => ['required'],
            'sub_title' => ['required'],
            'thumbnail' => ['nullable', 'mimes:jpg,png,jpeg,pdf,PDF', new ProductThumbnailCheck($id)],
        ]);


        $data = Product::findOrFail($id);
        $data->category_id = $request->category_id;
        $data->subcategory_id = $request->subcategory_id;
        $data->title = $request->title;
        $data->sub_title = $request->sub_title;
        $data->status = Constant::PRODUCT_STATUS['active'];

        if ($request->hasFIle('thumbnail')){
            if($data->thumbnail != null){
                $old_img = public_path('uploads/product/reagent/'.$data->thumbnail);
                if (file_exists($old_img)) {
                    unlink($old_img);
                }
            }

            $thumbnail = $request->file('thumbnail');
            $thumbnail_name = $data->slug.'-updated-'.rand(100,900).'.'.$thumbnail->getclientoriginalextension();
            // Image::make($thumbnail)->save(public_path('uploads/product/'.$thumbnail_name));
            $thumbnail->move(public_path('uploads/product/reagent/'), $thumbnail_name);
            $data->thumbnail = $thumbnail_name;
        }
        $data->description = $request->description;
        $data->save();

        flash()->addSuccess('Product Update Successfully!');
        return redirect()->route('product.index');
    }

    public function indexing($id){
        $data = Product::whereNotNull('indexing')->orderBy('indexing', 'DESC')->first();
        $product = Product::findOrFail($id);
        $indexing = null;
        if($data == false){
            $indexing = 1;
        }
        else{
            if($product->indexing == null){
                $indexing = $data->indexing + 1;
            }
        }
        $product->indexing = $indexing;
        $product->save();
        return $indexing;
    }

}
