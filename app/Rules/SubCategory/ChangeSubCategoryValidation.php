<?php

namespace App\Rules\SubCategory;

use App\Models\SubCategory;
use Illuminate\Contracts\Validation\Rule;

class ChangeSubCategoryValidation implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
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
        $subcategory = SubCategory::whereHas('keuangan')->find($this->id);
        if(!is_null($subcategory)) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Subkategori telah digunakan';
    }
}
