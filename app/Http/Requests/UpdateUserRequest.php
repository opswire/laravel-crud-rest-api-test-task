<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email'    => 'required|email:rfc,dns',
            'name'     => 'required|string',
            'age'      => 'required|integer|min:1|max:150',
            'sex'      => 'required|string',
            'birthday' => 'required|date',
            'phone'    => 'required|string',
        ];
    }
}
