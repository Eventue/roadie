<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'photo' => 'string|image',
            'bio' => 'string|max:255',
            'network' => 'json'
        ];
    }
}
