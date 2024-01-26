<?php

use App\Http\Controllers\FileDownloadController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Front  Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/contact-us', [FrontendController::class, 'contact'])->name('home.contact');
Route::get('/about-us', [FrontendController::class, 'aboutUs'])->name('home.aboutus');
Route::get('/director-message', [FrontendController::class, 'directorMessage'])->name('home.director.message');
Route::get('/products', [FrontendController::class, 'products'])->name('home.products');
Route::get('/product/view/{id}/{slug}', [FrontendController::class, 'productView'])->name('home.product.view');

Route::get('product/catelog/download/{id}', [FileDownloadController::class, 'download'])->name('catalog.product.download');
Route::get('product/reagent/download/{id}', [FileDownloadController::class, 'download2'])->name('reagent.product.download');

Route::post('contact-us/send/mail', [FrontendController::class, 'sendMail'])->name('home.contact.sms.send');




