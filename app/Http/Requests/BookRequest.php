<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'  => 'required|unique:books,title,'.optional($this->book)->id,
            'release_year' => 'required',
            'price' => 'required',
            'total_page' => 'required',
            'category_id' => 'required'
        ];
    }
}
