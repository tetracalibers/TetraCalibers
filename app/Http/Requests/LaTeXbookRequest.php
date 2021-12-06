<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LaTeXbookRequest extends FormRequest
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
            'title' => 'required',
            'slug' => 'required|regex:/^[a-zA-Z0-9-_]+$/'
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'slug' => 'スラッグ',
            'thumbnail' => 'サムネイル'
        ];
    }
}
