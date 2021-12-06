<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UseableToolRequest extends FormRequest
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
            'level' => 'required',
            'logoFile' => 'image',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'ツール名',
            'level' => '現在のレベル',
            'logoFile' => 'ロゴ'
        ];
    }
}
