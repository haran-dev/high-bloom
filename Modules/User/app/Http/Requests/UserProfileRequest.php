<?php

namespace Modules\User\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // User table
            'fullName'  => ['required', 'string', 'max:255'],
            'email'     => ['required', 'email', 'max:255'],
            
            // User details table
            'about'     => ['nullable', 'string'],
            'country'   => ['required', 'string', 'max:255'],
            'address'   => ['required', 'string', 'max:500'],
            'phone'     => ['required', 'string', 'max:20'],

            'twitter'   => ['nullable', 'string', 'max:255'],
            'facebook'  => ['nullable', 'string', 'max:255'],
            'instagram' => ['nullable', 'string', 'max:255'],
            'linkedin'  => ['nullable', 'string', 'max:255'],

            // Profile image
            'profile_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048' // 2MB
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'fullName.required'        => 'Full Name is required.',
            'email.required'           => 'Email is required.',
            'email.email'              => 'Enter a valid email address.',
            'country.required'         => 'Country is required.',
            'address.required'         => 'Address is required.',
            'phone.required'           => 'Phone number is required.',
            'profile_image.image'      => 'Profile image must be an image file.',
            'profile_image.mimes'      => 'Profile image must be JPG, PNG, or WEBP.',
            'profile_image.max'        => 'Profile image size must not exceed 2MB.',
        ];
    }
}
