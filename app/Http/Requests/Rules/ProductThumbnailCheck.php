<?php

namespace App\Http\Requests\Rules;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ProductThumbnailCheck implements ValidationRule
{
    /**
     * The product ID to check.
     *
     * @var int
     */
    public $product_id;

    /**
     * Create a new rule instance.
     *
     * @param  int  $product_id
     * @return void
     */
    public function __construct($product_id)
    {
        $this->product_id = $product_id;
    }

    /**
     * Validate the given attribute.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure  $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $product = Product::find($this->product_id);

        if ($product->thumbnail == null) {
            if (empty($value)) {
                $fail("Product Thumbnail is required.");
            }
        }
    }
}
