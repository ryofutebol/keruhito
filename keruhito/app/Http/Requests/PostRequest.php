<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'content' => 'required|max:140',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024|dimensions:max_width=300,ratio=1/1',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '選手名は必須項目です',
            'content.required' => '紹介文は必須項目です',
            'max:140' => '140文字以内にしてください',
            'image' => '指定されたファイルが画像ではありません',
            'mines' => '指定された拡張子（PNG/JPG/GIF）ではありません',
            'max:1024' => '１Ｍを超えています',
            'dimensions' => '画像の比率は1：1で横は最大300pxです',
        ];
    }
}
