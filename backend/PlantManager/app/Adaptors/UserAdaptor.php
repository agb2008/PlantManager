<?php

namespace App\Adaptors;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Laravel\Socialite\Two\User as UserOAuth2;

class UserAdaptor
{
    public function getUserBySocId(UserOAuth2 $user, string $socName)
    {
        $userInSystem = User::query()
            ->where('id_in_soc', $user->id)
            ->where('type_auth', $socName)
            ->first();

        if (is_null($userInSystem)) {
            $userInSystem = new User();

            $userInSystem->fill([
                'name' => '',
                'user_name' => !empty($user->getNickname()) ? $user->getNickname() : '',
                'email' => !empty($user->getEmail()) ? $user->getEmail() : '',
                'surname' => '',
                'password' => '',
                'id_in_soc' => !empty($user->getId()) ? $user->getId() : '',
                'type_auth' => $socName,
                'email_verified_at' => now(),
            ]);

            $userInSystem->save();
        }
        return $userInSystem;
    }
}
