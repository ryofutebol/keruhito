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
            'content' => 'required|min:10|max:140',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:1024',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '選手名は必須項目です',
            'content.required' => '紹介文は必須項目です',
            'content.min' => '10文字以上を入力してください',
            'content.max' => '140文字を超えています',
            'image' => '指定されたファイルが画像ではありません',
            'mimes' => '指定された拡張子（PNG/JPG/GIF）ではありません',
            'image.max' => '１Ｍを超えています',
            'dimensions' => '画像の比率は1：1で横は最大300pxです',
        ];
    }
}
