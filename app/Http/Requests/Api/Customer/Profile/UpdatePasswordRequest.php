<?php

namespace App\Http\Requests\Api\Customer\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdatePasswordRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'old_password' => [
                'required',
                'current_password',

            ],
            'password' => ['required','confirmed',Password::min(8)
                ->mixedCase()
                ->letters()
                ->numbers()

            ],
        ];
    }

}
