<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'name' => ['required','string','max:250'],
            'first_name' =>  ['required','string','min:3','max:250'],
            'last_name' =>  ['required','string','min:3','max:250'],
            'email' => ['required','email', 'min:3', 'max:20'],
            'password' => ['required','min:8','confirmed']
        ];
    }
}
