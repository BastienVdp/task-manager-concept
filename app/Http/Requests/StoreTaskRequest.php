<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            'priority' => 'required',
            'deadline' => 'required',
            'todos' => 'required|array',
            'todos.*.name' => 'required',
            'todos.*.description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'todos.*.name' => 'Le champs nom est requis',
            'todos.*.description' => 'Le champs description est requis',
        ];
    }
}
