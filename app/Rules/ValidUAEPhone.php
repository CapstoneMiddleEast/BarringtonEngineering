<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidUAEPhone implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/^(?:00971|\+971|0)?(?:50|51|52|53|54|55|56|57|58|2|3|4|6|7|9)\d{7}$/', $value)) {
            $fail('The :attribute must be a valid UAE phone number.');
        }
    }
}
