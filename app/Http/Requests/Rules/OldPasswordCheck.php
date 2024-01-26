<?php

namespace App\Http\Requests\Rules;

use App\Models\Admin;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OldPasswordCheck implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $user = Auth::user();

        $admin = Admin::findOrFail($user->id);
        if (!Hash::check($value, $admin->password)){
            $fail("Old Password Are Not Matched");
        }

    }
}
