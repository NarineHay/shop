<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
    public function rules()
    {
        dd(request()->all());
        $useAccountAddress = $this->boolean('use_account_address');

        // ЕСЛИ юзер хочет использовать адрес из аккаунта
        if ($useAccountAddress) {
            return [
                'payment_type' => 'required|in:check,cash',
                'comment' => 'nullable|string|max:500',
            ];
        }

        // ЕСЛИ юзер вводит адрес вручную → полноценная валидация
        return [
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'phone'      => 'required|string|max:50',
            'region_id'  => 'required|integer|exists:regions,id',
            'address'    => 'required|string|max:255',
            'comment'    => 'nullable|string|max:500',
            'payment_type' => 'required|string',
            'use_profile_address' => 'boolean',
            'terms_acceptance' => 'accepted',
        ];
    }


}
