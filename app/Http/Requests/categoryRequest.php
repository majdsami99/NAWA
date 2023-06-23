<?php

namespace App\Http\Requests;

use App\Models\category;
use Illuminate\Foundation\Http\FormRequest;

class categoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $category= $this ->route('category',new category());
        $id=$category ? $category ->id:0 ;
         return[
             'name'=>'required|max:255|min:3'
         ];

    }
}
