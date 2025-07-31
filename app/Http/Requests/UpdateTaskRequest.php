<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'data.attributes.title' => 'sometimes|string|unique:task,title',
            'data.attributes.description' => 'sometimes|string|unique:task,description',
            'data.attributes.status' => 'sometimes|string|in:pending,in-progress,complete'
        ];
    }
}
