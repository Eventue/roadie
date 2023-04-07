<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'string|min:3|max:255',
            'username' => 'alpha_num:ascii|min:3|max:20|unique:users,username',
            'email' => 'email|unique:users,email',
            'newPassword' => 'string|min:8|max:255',
            'newPasswordConfirmation' => 'required_with:newPassword|same:newPassword',
            'role' => ['string', 'in' => \App\Domain\User\Roles::all()],
        ];
    }
}
