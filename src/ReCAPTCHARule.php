<?php

namespace Fstudio\Lvalidator;

use Illuminate\Contracts\Validation\Rule;
use Fstudio\Recaptcha\ReCAPTCHA;

class ReCAPTCHARule implements Rule
{

    public function passes($attribute, $value)
    {
        return true;
    }

    public function message()
    {
        return "";
    }

}