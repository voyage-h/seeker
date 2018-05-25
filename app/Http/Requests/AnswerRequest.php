<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnswerRequest extends FormRequest
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
            'content'=>'required|min:12'
        ];
    }

    public function messages()
    {
        return [
            'content.required'=>'答案的内容不能为空',
            'content.min'=>'答案内容太短',
        ];
    }
}
