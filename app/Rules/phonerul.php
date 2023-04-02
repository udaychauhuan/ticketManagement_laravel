<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Str;

class phonerul implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        // it check if the phone no. lenght is smaller than 10
        $val =  strval($value);
        $StrLen =Str::length($val);
        if ($StrLen <= 9){
            $fail('The :attribute must be atleast 10 digits ');
        }
    }
}
