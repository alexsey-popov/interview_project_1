<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'         => 'Имя не указан',
            'name.string'           => 'Указан некорректный формат данных',
            'name.max'              => 'Превышена максимальная длина имени. Имя не должно превышать :max символов',
            'email.required'        => 'Email не указан',
            'email.string'          => 'Указан некорректный формат данных',
            'email.email'           => 'Указан некорректный email',
            'email.max'             => 'Превышена максимальная длина email. Email не должен превышать :max символов.',
            'email.unique'          => 'Пользователь с email :input уже зарегистрирован в системе',
            'password.required'     => 'Пароль не указан',
            'password.string'       => 'Указан некорректный формат данных',
            'password.min'          => 'Превышена максимальная длина пароля. Пароль не должен превышать :max символов',
            'password.confirmed'    => 'Пароли не совпадают',
        ];
    }
}
