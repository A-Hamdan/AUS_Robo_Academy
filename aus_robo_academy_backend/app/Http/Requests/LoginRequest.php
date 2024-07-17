<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Carbon\Carbon;
use Auth;

class LoginRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function apiAuthenticate()
    {

        if(Auth::attempt($this->only('email','password'))) {

            $user = Auth::user();

            if ($user->is_active == 0) {
                Auth::logout();
                throw new HttpResponseException(response()->json([
                    'success' => false,
                    'message' => 'Your account status is deactive, please contact an administrator.',
                ], 422));
            }

            if ($user->expiration_date && Carbon::now()->greaterThanOrEqualTo($user->expiration_date)) {
                throw new HttpResponseException(response()->json([
                    'success' => false,
                    'message' => 'Your account is expired, please contact an administrator.',
                ], 422));
            }

            $user['token'] = $user->createToken('auth_token')->plainTextToken;
            $user['roles'] = $user->roles;
            return $user;
        }
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
