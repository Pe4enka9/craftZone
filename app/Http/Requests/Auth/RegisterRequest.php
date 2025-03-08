<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Validation\Rule;

class RegisterRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', Rule::unique(User::class, 'email')],
            'password' => ['required', 'string'],
            'role_id' => ['required', 'integer', Rule::exists(Role::class, 'id')],
        ];
    }
}
