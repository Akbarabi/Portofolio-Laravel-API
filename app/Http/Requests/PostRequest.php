<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use ProtoneMedia\LaravelMixins\Request\ConvertsBase64ToFiles;

class PostRequest extends FormRequest
{
    use ConvertsBase64ToFiles;

    public $validatior;

    public function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Determine if the users is authorized to make this request.
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
        if ($this->isMethod('post')) {
            return $this->createRules();
        }

        return $this->updateRules();
    }

    private function createRules(): array
    {
        return [
            'title' => 'required|min:5|max:100',
            'category_name' => 'required',
            'body' => 'required',
            'photo' => 'nullable|file|image',
        ];
    }

    private function updateRules(): array
    {
        return [
            'id' => 'required|exists:posts,id',
            'title' => 'required|max:100',
            'category_name' => 'required',
            'body' => 'required',
            'photo' => 'nullable|file|image',
        ];
    }

    protected function base64FileKeys(): array
    {
        return [
            'photo' => 'foto-post.jpg',
        ];
    }
}
