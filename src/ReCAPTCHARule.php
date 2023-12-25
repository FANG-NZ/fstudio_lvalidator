<?php

namespace Fstudio\Lvalidator;

use Illuminate\Contracts\Validation\Rule;
use Fstudio\Recaptcha\ReCAPTCHA;

class ReCAPTCHARule implements Rule
{

    private $secret;
    private $url;
    private $ip;
    //default to set IGNORE checking
    private $ignore;

    public function __construct(String $_secret, String $_url, String $_ip = null, bool $_ignore = false)
    {
        $this->secret = $_secret;
        $this->url    = $_url;
        $this->ip     = $_ip;
        $this->ignore = $_ignore;
    }


    public function setIgnore(bool $_ignore)
    {
        $this->ignore = $_ignore;
        return $this;
    }


    public function passes($attribute, $value)
    {
        //If we set ignore this, just RETURN TRUE
        //Normally used for TESTING on local
        if($this->ignore)
            return true;

        return (new ReCAPTCHA($this->secret, $value, $this->url))->verify($this->ip);
    }

    public function message()
    {
        return "The google reCAPTCHA was NOT passed";
    }

}