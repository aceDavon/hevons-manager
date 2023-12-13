<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class StorePriorityRequest extends FormRequest
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
        $rules = [
            "title" => ['required', 'string', 'max:30'],
            "color" => ['required', 'string']
        ];

        if ($this->has('task_id')) {
            $rules['task_id'] = ['required', 'integer', 'exists:tasks,id'];
        }

        return $rules;
    }
}
