<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
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
            'to_be_done' => 'required|string|max:20',
            'is_complete' => 'sometimes|boolean',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    /**
     * Get the validation messages for the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'to_be_done.required' => 'Todoの内容は必須です。',
            'to_be_done.max' => 'Todoの内容は20文字以内で入力してください。',
            'is_complete.boolean' => '完了フラグの形式が正しくありません。',
            'category_id.required' => 'カテゴリーを選択してください。',
            'category_id.exists' => '選択したカテゴリーが存在しません。',
        ];
    }
}
