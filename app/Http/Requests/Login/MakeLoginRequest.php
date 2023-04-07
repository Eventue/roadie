<?php

namespace App\Http\Requests\Login;

use Illuminate\Foundation\Http\FormRequest;

class MakeLoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string',
        ];
    }
}
