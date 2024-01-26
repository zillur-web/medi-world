<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\ComapanyInfo;
use App\Models\Director;
use App\Models\Socials;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function index(){
        $pageTitle = 'Site Settings';
        $company_info = ComapanyInfo::findOrFail(1);
        return view('admin.pages.settings.index', compact('pageTitle', 'company_info'));
    }


    public function logoUpdate(Request $request){
        $data = $request->validate([
            'general_logo' => ['nullable', 'mimes:jpg,jpeg,png,gif'],
            'white_logo' => ['nullable', 'mimes:jpg,jpeg,png,gif,svg'],
            'home_banner' => ['nullable', 'mimes:jpg,jpeg,png,gif,svg'],
            'favicon' => ['nullable', 'mimes:jpg,jpeg,png,gif,svg'],
        ]);

        $data = ComapanyInfo::findOrFail(1);

        if ($request->hasFIle('general_logo')){
            if($data->general_logo != null){
                $old_img1 = public_path('uploads/system/'.$data->general_logo);
                if (file_exists($old_img1)) {
                    unlink($old_img1);
                }
            }
            $general_logo = $request->file('general_logo');
            $general_logo_name = 'website-logo-'.rand(1,500).'.'.$general_logo->getclientoriginalextension();

            Image::make($general_logo)->save(public_path('uploads/system/'.$general_logo_name));
            $data->general_logo = $general_logo_name;
        }

        if ($request->hasFIle('white_logo')){
            if($data->white_logo != null){
                $old_img2 = public_path('uploads/system/'.$data->white_logo);
                if (file_exists($old_img2)) {
                    unlink($old_img2);
                }
            }
            $white_logo = $request->file('white_logo');
            $white_logo_name = Str::slug($data->system_name, '-').'-user-logo-'.rand(1,500).'.'.$white_logo->getclientoriginalextension();

            Image::make($white_logo)->save(public_path('uploads/system/'.$white_logo_name));
            $data->white_logo = $white_logo_name;
        }

        if ($request->hasFIle('home_banner')){
            if($data->home_banner != null){
                $old_img3 = public_path('uploads/system/'.$data->home_banner);
                if (file_exists($old_img3)) {
                    unlink($old_img3);
                }
            }
            $home_banner = $request->file('home_banner');
            $home_banner_name = Str::slug($data->system_name, '-').'-banner-'.rand(1,500).'.'.$home_banner->getclientoriginalextension();
            Image::make($home_banner)->save(public_path('uploads/system/'.$home_banner_name));
            $data->home_banner = $home_banner_name;
        }
        if ($request->hasFIle('favicon')){
            if($data->favicon != null){
                $old_img4 = public_path('uploads/system/'.$data->favicon);
                if (file_exists($old_img4)) {
                    unlink($old_img4);
                }
            }
            $favicon = $request->file('favicon');
            $favicon_name = Str::slug($data->system_name, '-').'-favicon-'.rand(1,500).'.'.$favicon->getclientoriginalextension();
            Image::make($favicon)->save(public_path('uploads/system/'.$favicon_name));
            $data->favicon = $favicon_name;
        }

        $data->save();


        flash()->addSuccess('Website Logo Or Banner Updated.');
        return redirect()->back();
    }

    public function genarelSetting(Request $request){
        $data = $request->validate([
            'company_name' => ['required'],
            'site_mettro' => ['required'],
            'about_company' => ['required'],
            'phone' => ['required'],
            'email' => ['required'],
            'map' => ['required'],
        ]);
        $data = ComapanyInfo::findOrFail(1);

        $data->system_name = $request->company_name;
        $data->company_name = $request->company_name;
        $data->site_mettro = $request->site_mettro;
        $data->about_company = $request->about_company;
        $data->address = $request->address1.',<br>'.$request->address2;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->map = $request->map;
        $data->save();

        flash()->addSuccess('Website Info Updated.');
        return redirect()->back();
    }

    public function logoRemove(string $field_name){
        $data = ComapanyInfo::findOrFail(1);

        if($data->$field_name != null){
            $old_img1 = public_path('uploads/system/'.$data->$field_name);
            if (file_exists($old_img1)) {
                unlink($old_img1);
            }
        }

        $data->$field_name = null;
        $data->save();

        return response()->json($field_name);
    }

    public function socialStore(Request $request){
        $data = Socials::findOrFail(1);

        $data->facebook = $request->facebook;
        $data->instagram = $request->instagram;
        $data->linkedin = $request->linkedin;
        $data->x = $request->x;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->save();
        flash()->addSuccess('Socails Icon Updated.');
        return redirect()->back();
    }

    public function aboutUs(){
        $pageTitle = 'About Us';
        $about_us = AboutUs::findOrFail(1);
        return view('admin.pages.settings.about-us', compact('pageTitle', 'about_us'));
    }

    public function aboutStore(Request $request){
        $data = $request->validate([
            'about_us_content' => ['required'],
        ]);

        $data = AboutUs::findOrFail(1);
        $data->about_us_content = $request->about_us_content;
        $data->save();

        flash()->addSuccess('About Us Page Content Updated.');
        return redirect()->back();
    }

    public function directorMessage(){
        $pageTitle = 'Director Message';
        $data = Director::findOrFail(1);
        return view('admin.pages.settings.director-message', compact('pageTitle', 'data'));
    }

    public function directorMessageStore(Request $request){
        $data = $request->validate([
            'content' => ['required'],
        ]);
        $data = Director::findOrFail(1);
        if ($request->hasFIle('image')){
            if($data->image != null){
                $old_img1 = public_path('uploads/system/'.$data->image);
                if (file_exists($old_img1)) {
                    unlink($old_img1);
                }
            }
            $image = $request->file('image');
            $image_name = 'director-image-'.rand(1,500).'.'.$image->getclientoriginalextension();

            Image::make($image)->save(public_path('uploads/system/'.$image_name));
            $data->image = $image_name;
        }

        $data->content = $request->content;
        $data->save();

        flash()->addSuccess('Director Content Updated.');
        return redirect()->back();
    }

    public function metaInfoSetting(Request $request){
        $data = $request->validate([
            'meta_title' => ['required', 'string'],
            'meta_des' => ['required', 'string'],
            'meta_keywords' => ['required', 'string'],
            'meta_image' => ['nullable', 'mimes:jpg,jpeg,png'],
        ]);
        $data = ComapanyInfo::findOrFail(1);
        if ($request->hasFIle('meta_image')){
            if($data->meta_image != null){
                $old_img1 = public_path('uploads/system/'.$data->meta_image);
                if (file_exists($old_img1)) {
                    unlink($old_img1);
                }
            }
            $image = $request->file('meta_image');
            $image_name = config('app.name').rand(1,500).'.'.$image->getclientoriginalextension();

            Image::make($image)->save(public_path('uploads/system/'.$image_name));
            $data->meta_image = $image_name;
        }
        $data->meta_title = $request->meta_title;
        $data->meta_des = $request->meta_des;
        $data->meta_keywords = $request->meta_keywords;
        $data->save();

        flash()->addSuccess('Meta Info Updated.');
        return redirect()->back();
    }

    public function policySetting(Request $request){
        $data = $request->validate([
            'policy' => ['required', 'string'],
        ]);
        $data = ComapanyInfo::findOrFail(1);
        $data->policy = $request->policy;
        $data->save();

        flash()->addSuccess('Policy Policy Updated.');
        return redirect()->back();
    }
}
