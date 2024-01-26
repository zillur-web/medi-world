<?php

use App\Helpers\Constant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id');
            $table->foreignId('subcategory_id')->nullable();
            $table->foreignId('brand_id')->nullable();
            $table->foreignId('origin_id')->nullable();
            $table->string('country')->nullable();
            $table->string('title');
            $table->string('sub_title')->nullable();
            $table->string('slug');
            $table->string('thumbnail')->nullable();
            $table->string('catalog')->nullable();
            $table->longText('description')->nullable();
            $table->tinyInteger('policy')->default(Constant::POLICY_STATUS['deactive']);
            $table->tinyInteger('terms')->default(Constant::TERMS_STATUS['deactive']);
            $table->tinyInteger('status')->default(Constant::PRODUCT_STATUS['active']);
            $table->timestamps();
            $table->SoftDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
