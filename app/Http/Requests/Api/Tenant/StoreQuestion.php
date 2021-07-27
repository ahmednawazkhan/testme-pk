<?php

namespace App\Http\Requests\Api\Tenant;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreQuestion extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'label' => 'required|string',
            'chapter_id' => 'required|integer|exists:chapters,id',
            'multiple_choice' => 'required|boolean',
            'explaination' => 'required|string|nullable',
            'answers' => 'required|array',
            'answers.*.label' => 'required|string',
            'answers.*.is_correct' => 'required|boolean'
        ];
    }
}
