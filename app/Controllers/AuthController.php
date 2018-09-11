<?php

namespace App\Controllers;

use App\Models\Address;
use App\Models\User;
use Framework\Auth\Guard;
use Framework\Controllers\Controller;
use Framework\Database\Database;
use Framework\Responses\Response;

class AuthController extends Controller
{
    /**
     * Show login form
     *
     * @return Response
     */
    public function showLogin()
    {
        if (Guard::check()) {
            return $this->redirect('/');
        }

        return $this->view('auth.login');
    }

    /**
     * Login user
     *
     * @return Response
     */
    public function login()
    {
        $emailOrUsername = $this->request->post('email');
        $password = $this->request->post('password');

        if (empty($password) || empty($emailOrUsername)) {
            return $this->redirect('/login')
                ->withInput()
                ->withFlash([
                    'error' => 'input_not_valid',
                ]);
        }

        $field = 'username';

        if (str_contains($emailOrUsername, '@')) {
            $field = 'email';
            $emailOrUsername = strtolower($emailOrUsername);
        }

        /** @var User $user */
        $user = User::where($field, $emailOrUsername)->get();

        if (is_null($user)) {
            return $this->redirect('/login')
                ->withInput()
                ->withFlash([
                    'error' => 'email_or_password_wrong',
                ]);
        }

        if (!password_verify($password, $user->password)) {
            return $this->redirect('/login')
                ->withInput()
                ->withFlash([
                    'error' => 'email_or_password_wrong',
                ]);
        }

        Guard::login($user);

        return $this->redirect('/');
    }

    /**
     * Logout user
     *
     * @return Response
     */
    public function logout()
    {
        Guard::logout();

        return $this->redirect('/');
    }

    /**
     * Show register form
     *
     * @return Response
     */
    public function showRegister()
    {
        if (Guard::check()) {
            return $this->redirect('/');
        }

        $countries = require(app_path('Data/countries.php'));

        return $this->view('auth.register', compact('countries'));
    }

    /**
     * Register user
     *
     * @return Response
     */
    public function register()
    {
        $countries = require(app_path('Data/countries.php'));

        $name = $this->request->post('name');
        $surname = $this->request->post('surname');
        $email = strtolower($this->request->post('email'));
        $username = $this->request->post('username');
        $pwd = $this->request->post('password');
        $country = strtolower($this->request->post('country'));
        $city = $this->request->post('city');
        $street = $this->request->post('street');
        $number = $this->request->post('number');

        if (empty($name) || empty($surname) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) ||
            empty($pwd) || empty($username) || empty($country) || empty($city) || empty($street) || empty($number) ||
            !in_array($country, $countries)) {
            return $this->redirect('/register')
                ->withInput()
                ->withFlash([
                    'error' => 'input_not_valid',
                ]);
        }

        if (str_contains($username, '@')) {
            return $this->redirect('/register')
                ->withInput()
                ->withFlash([
                    'error' => 'username_avoid_at',
                ]);
        }

        if (User::where('email', $email)->get()) {
            return $this->redirect('/register')
                ->withInput()
                ->withFlash([
                    'error' => 'email_already_taken',
                ]);
        }

        if (User::where('username', $username)->get()) {
            return $this->redirect('/register')
                ->withInput()
                ->withFlash([
                    'error' => 'username_already_taken',
                ]);
        }

        $user = Database::transaction(function () use ($name, $surname, $email, $username, $pwd, $country, $city, $street, $number) {
            $user = new User([
                'username' => $username,
                'name' => $name,
                'surname' => $surname,
                'email' => $email,
                'password' => bcrypt($pwd),
            ]);

            $user->save();

            $address = new Address([
                'user_id' => $user->id,
                'country' => $country,
                'city' => $city,
                'street' => $street,
                'number' => $number,
            ]);

            $address->save();

            return $user;
        });

        Guard::login($user);

        return $this->redirect('/');
    }
}
