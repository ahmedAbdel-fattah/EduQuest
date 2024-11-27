<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input): void
{
    Validator::make($input, [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:9000'],
        'phone' => ['nullable', 'string', 'max:13'],
        'address' => ['nullable', 'string', 'max:300'],
    ])->validateWithBag('updateProfileInformation');

    // Update the photo, phone, and address if provided
    if (isset($input['photo'])) {
        $user->updateProfilePhoto($input['photo']);
    }

    if (isset($input['phone'])) {
        $user->forceFill(['phone' => $input['phone']])->save();
    }

    if (isset($input['address'])) {
        $user->forceFill(['address' => $input['address']])->save();
    }

    // Handle email changes
    if ($input['email'] !== $user->email &&
        $user instanceof MustVerifyEmail) {
        $this->updateVerifiedUser($user, $input);
    } else {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'address' => $input['address'],
            'phone' => $input['phone']
        ])->save();
    }
}

/**
 * Update the given verified user's profile information.
 *
 * @param  User $user
 * @param  array<string, string>  $input
 */
protected function updateVerifiedUser(User $user, array $input): void
{
    $user->forceFill([
        'name' => $input['name'],
        'email' => $input['email'],
        'address' => $input['address'],
        'phone' => $input['phone'],
        'email_verified_at' => null,
    ])->save();

    $user->sendEmailVerificationNotification();
}

}
