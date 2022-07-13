<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'min:3', 'max:255'],
            'pass_percentage' => ['required', 'numeric', 'min:0', 'max:100'],
            'duration' => ['required', 'numeric', 'min:0']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name cant be empty',
            'duration.required' => 'Please enter the duration of test',
        ];
    }
}
