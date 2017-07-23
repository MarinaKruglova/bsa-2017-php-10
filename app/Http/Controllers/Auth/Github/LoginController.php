<?php

namespace App\Http\Controllers\Auth\Github;

use App\Entity\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Socialite;

class LoginController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('github')->user();
        } catch (Exception $e) {
            return Redirect::to('auth/github');
        }

        $authUser = $this->findOrCreateUser($user);

        Auth::login($authUser, true);

        return Redirect::to('cars');
    }

    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $githubUser
     * @return User
     */
    private function findOrCreateUser($githubUser)
    {
        if ($authUser = User::where('email', $githubUser->email)->first()) {
            return $authUser;
        }

        return User::create([
            'first_name' => $githubUser->name ?? 'firstname on Github',
            'last_name' => 'lastname on Github',
            'email' => $githubUser->email,
            // 'github_id' => $githubUser->id,
            // 'avatar' => $githubUser->avatar
            'password' => '',
            'is_active' => true,
            'is_admin' => false,
        ]);
    }
}