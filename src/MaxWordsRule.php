<?php

namespace Fstudio\Lvalidator;

use Illuminate\Contracts\Validation\Rule;

class MaxWordsRule implements Rule
{
    //define the average length chars for each word
    const AVERAGE_LENGTH_WORD = 5;

    private $maxWords;
    private $maxChars;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($_max_words = 500, $_max_chars = null)
    {
        $this->maxWords = $_max_words;

        if($_max_chars && is_numeric($_max_chars)){
            $this->maxChars = $_max_chars;
        }
        else{
            $this->calcMaxChars();
        }

    }


    private function calcMaxChars()
    {
        $this->maxChars = $this->maxWords * self::AVERAGE_LENGTH_WORD + ($this->maxWords - 1);
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
        
        /**
         * Firstly check if max chars limited
         */
        if(strlen($value) > $this->maxChars)
            return false;

        return str_word_count($value) <= $this->maxWords;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute cannot be more than ' . $this->maxWords . " words (Max Chars [". $this->maxChars ."]).";
    }

}