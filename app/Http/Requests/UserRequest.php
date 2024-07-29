<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

class UserRequest extends FormRequest
{
    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge(['password' => $this->password ?? $this->user->password ?? null]);
        $this->replace(array_filter($this->all(), null));
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        $user = User::where('id', '<>', $this->user->id ?? null)
            ->where(function ($query) {
                $query->orWhere('doc_number', $this->doc_number)
                    ->orWhere('email', $this->email);
            })
            ->get()->first();

        if ($user == null) {
            return [];
        }

        $user->setAttribute('route', 'users' . ($user->hasRole('supplier') ? '.suppliers' : ($user->hasRole('customer') ? '.customers' : false)) . '.show');

        return [
            'email.unique' => 'El campo email ya ha sido tomado por <a href="' . route($user->route, $user->id) . '">' . $user->name . '</a>',
            'doc_number.unique' => 'El campo DNI ya ha sido tomado por <a href="' . route($user->route, $user->id) . '">' . $user->name . '</a>',
        ];
    }

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $current_id = request()->user->id ?? request()->supplier->id ?? request()->customer->id ?? auth()->user()->id ?? 0;

        if ($this->isMethod('post')) {
            $password_rules = ['required', 'confirmed', Password::min(8)->uncompromised(2)];
        } else if ($this->isMethod('put') && $this->password) {
            $password_rules = ['confirmed', Password::min(8)->uncompromised(2)];
        }

        return [
            'roles' => ['nullable'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($current_id)],
            'doc_number' => ['required', 'gt:1', 'integer', Rule::unique('users', 'doc_number')->ignore($current_id)],
            'password' => $password_rules ?? ['nullable'],
        ];
    }

    /**
     * Handle a passed validation attempt.
     */
    protected function passedValidation(): void
    {
        if ($this->password) {
            $this->merge(['password' => Hash::make($this->password)]);
        }
    }
}
