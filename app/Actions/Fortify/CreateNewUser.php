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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            //definir el tipo de dato de las profesiones
            'profession_name' => ['required', 'string', 'max:255'],
            'other_profession' => ['nullable', 'string', 'max:255'],
            //definir el tipo de dato
            'bio' => 'required_without:profession|string|max:255',
            'twitter' => 'required_without:profession|url|max:255',
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();
        $profesion = $input['profession_name'];
        if($input['profession_name'] === 'otros'){
            $profesion = $input['profession_name'];
        }

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            //devolver el valor del dato
            'bio' => $input['bio'],
            'twitter' => $input['twitter'],
            'password' => Hash::make($input['password']),
            //devolver el valor del dato de la profession
            'profession_name' => $profesion,

        ]);
    }
}
