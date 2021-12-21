<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'adress' => ['required', 'string', 'max:255'],
            'phonenum' => ['required', 'integer'],
            'cf' => ['required', 'string', 'max:255'],
            'albo' => ['required', 'string', 'max:255'],
            'borndate' => ['required', 'date'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'surname' => $input['surname'],
            'city' => $input['city'],
            'adress' => $input['adress'],
            'phonenum' => $input['phonenum'],
            'cf' => $input['cf'],
            'albo' => $input['albo'],
            'borndate' => $input['borndate'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
