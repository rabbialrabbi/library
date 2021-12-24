<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSetBookRequest extends FormRequest
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
            'title'=>'required',
            'language_id'=>'required|exists:languages,id',
            'self_id'=>'required|exists:book_selves,id',
            'author_id'=>'required|array|exists:authors,id',
            'part'=>'required|numeric',
            'price'=>'required|numeric',
            'book'=>'required|array',
        ];
    }
}
