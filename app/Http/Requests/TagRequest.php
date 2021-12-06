<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
            'name' => 'required',
            'slug' => 'required|regex:/^[a-zA-Z0-9-_]+$/',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'タグ名',
            'slug' => 'スラッグ',
            'logoFile' => 'ロゴ'
        ];
    }
}
