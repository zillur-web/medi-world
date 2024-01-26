<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AssemblyController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OriginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Models\Origin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'admin','middleware' => ['auth:admin', 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/change-password', [DashboardController::class, 'changePassword'])->name('change.password');
    Route::post('/change-password', [DashboardController::class, 'changePasswordStore'])->name('change.password.store');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');

    Route::get('/sub-categories', [SubCategoryController::class, 'index'])->name('subcategories');
    Route::post('/sub-category/store', [SubCategoryController::class, 'store'])->name('subcategory.store');
    Route::get('/sub-category/delete/{id}', [SubCategoryController::class, 'destroy'])->name('subcategory.destroy');
    Route::get('/sub-category/edit/{id}', [SubCategoryController::class, 'edit'])->name('subcategory.edit');
    Route::post('/sub-category/update/{id}', [SubCategoryController::class, 'update'])->name('subcategory.update');

    Route::get('/brands', [BrandController::class, 'index'])->name('brand.index');
    Route::post('/brand/store', [BrandController::class, 'store'])->name('brand.store');
    Route::get('/brand/delete/{id}', [BrandController::class, 'destroy'])->name('brand.destroy');
    Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
    Route::post('/brand/update/{id}', [BrandController::class, 'update'])->name('brand.update');

    Route::get('/origin', [OriginController::class, 'index'])->name('origin.index');
    Route::post('/origin/store', [OriginController::class, 'store'])->name('origin.store');
    Route::get('/origin/delete/{id}', [OriginController::class, 'destroy'])->name('origin.destroy');
    Route::get('/origin/edit/{id}', [OriginController::class, 'edit'])->name('origin.edit');
    Route::post('/origin/update/{id}', [OriginController::class, 'update'])->name('origin.update');

    Route::get('/assemble', [AssemblyController::class, 'index'])->name('assemble.index');
    Route::post('/assemble/store', [AssemblyController::class, 'store'])->name('assemble.store');
    Route::get('/assemble/delete/{id}', [AssemblyController::class, 'destroy'])->name('assemble.destroy');
    Route::get('/assemble/edit/{id}', [AssemblyController::class, 'edit'])->name('assemble.edit');
    Route::post('/assemble/update/{id}', [AssemblyController::class, 'update'])->name('assemble.update');




    // Products Routes
    Route::prefix('product')->as('product.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::get('/destroy/{id}', [ProductController::class, 'destroy'])->name('destroy');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
        Route::get('/info/item/{id}', [ProductController::class, 'infoItem'])->name('info.item');
        Route::get('/feature/image/remove/{id}', [ProductController::class, 'feature_remove'])->name('feature.image.remove');
        Route::get('/file/remove/{id}/{field_name}', [ProductController::class, 'thumbnail_remove'])->name('thumbnail.image.remove');
        Route::put('/update/{id}', [ProductController::class, 'update'])->name('update');
        Route::get('/indexing/{id}', [ProductController::class, 'indexing'])->name('indexing');

        // Reagent Routes
        Route::get('/reagent/create', [ProductController::class, 'reagentCreate'])->name('reagent.create');
        Route::post('/reagent/store', [ProductController::class, 'reagentStore'])->name('reagent.store');
        Route::get('/reagent/edit/{id}', [ProductController::class, 'reagentEdit'])->name('reagent.edit');
        Route::get('/reagent/file/remove/{id}/{field_name}', [ProductController::class, 'reagent_thumbnail_remove'])->name('reagent.thumbnail.remove');
        Route::put('/reagent/update/{id}', [ProductController::class, 'reagentUpdate'])->name('reagent.update');
    });

    // Products Routes
    Route::prefix('settings')->as('settings.')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('index');
        Route::post('/update', [SettingController::class, 'logoUpdate'])->name('logoUpdate');
        Route::post('/genarel/settings/update', [SettingController::class, 'genarelSetting'])->name('genarelSetting');

        Route::post('/genarel/settings/meta/update', [SettingController::class, 'metaInfoSetting'])->name('metaInfoSetting');
        Route::post('/genarel/settings/policy/update', [SettingController::class, 'policySetting'])->name('policySetting');

        Route::get('/logo/remove/{field}', [SettingController::class, 'logoRemove'])->name('logo.remove');
        Route::post('/socials/store', [SettingController::class, 'socialStore'])->name('social.store');
        Route::get('/pages/about-us', [SettingController::class, 'aboutUs'])->name('pages.about.index');
        Route::post('/pages/about-us/store', [SettingController::class, 'aboutStore'])->name('pages.about.store');

        Route::get('/pages/director-message', [SettingController::class, 'directorMessage'])->name('pages.director_message.index');
        Route::post('/pages/director-message/store', [SettingController::class, 'directorMessageStore'])->name('pages.director_message.store');
    });



    // ajax routes
    Route::get('/get/category', [AjaxController::class, 'get_category'])->name('get.category');
    Route::get('/get/sub-category/{id}', [AjaxController::class, 'get_subcategory'])->name('get.subcategory');
    Route::get('/get/brand', [AjaxController::class, 'get_brand'])->name('get.brand');
    Route::get('/get/origin', [AjaxController::class, 'get_origin'])->name('get.origin');
    Route::get('/get/country', [AjaxController::class, 'get_country'])->name('get.country');
});
Route::get('/test', function () {
    // return Countries::getList('en');
});


require __DIR__.'/adminauth.php';

