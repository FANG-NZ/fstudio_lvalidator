<?php

namespace Fstudio\Lvalidator\Validators;

use Illuminate\Validation\Rule;

class MaxWordsRule implements Rule
{

    private $maxWords;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($_max_words = 500)
    {
        $this->maxWords = $_max_words;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return str_word_count($value) <= $this->maxWords;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute cannot be more than ' . $this->maxWords . " words.";
    }

}