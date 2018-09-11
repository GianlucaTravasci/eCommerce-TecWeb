<?php

namespace Framework\Auth;

use App\Models\User;

class Guard
{
    /**
     * Login user
     *
     * @param User $user
     */
    public static function login(User $user)
    {
        session()->set('id', $user->id);
    }

    /**
     * Logout user
     */
    public static function logout()
    {
        session()->remove('id');
    }

    /**
     * Fetch logged in user
     *
     * @return null|User
     */
    public static function user()
    {
        if (session()->has('id')) {
            return User::find(session('id'));
        }

        return null;
    }

    /**
     * Determine if user is logged in
     *
     * @return boolean
     */
    public static function check()
    {
        return !is_null(static::user());
    }
}
