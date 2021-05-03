<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;
use Laminas\Feed\Reader\Reader;

class ValidFeed implements Rule
{

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $request = Http::get($value);

        if ($request->failed()) {
            return false;
        }

        try {
            $reader = Reader::importString($request->body());
        } catch (\Exception $e) {
            return false;
        }

        return $reader->valid();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The feed is not valid';
    }
}
