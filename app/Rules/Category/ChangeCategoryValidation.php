<?php

namespace App\Rules\Category;

use App\Models\Category;
use Illuminate\Contracts\Validation\Rule;

class ChangeCategoryValidation implements Rule
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
        $check = true;
        $category = Category::with([
            'sub_category' => function($q) {
                $q->with('keuangan');
            }
        ])->find($this->id);
        if(!$category->sub_category->isEmpty()) {
            foreach($category->sub_category as $sub_category) {
                if(!$sub_category->keuangan->isEmpty()) {
                    $check = false;
                }
            }
        }
        return $check;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Category sudah digunakan';
    }
}
