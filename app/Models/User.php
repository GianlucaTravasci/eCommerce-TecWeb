<?php

namespace App\Models;

use Framework\Database\Model;

/**
 * User
 *
 * @package App\models
 *
 * @property int $id
 * @property string $username
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $password
 * @property int $admin
 */
class User extends Model
{
    public static $table = 'users';

    /**
     * Determine if user is an admin
     *
     * @return bool
     */
    public function isAdmin()
    {
        return !!$this->admin;
    }

    /**
     * Fetch address
     *
     * @return Address
     */
    public function address()
    {
        return Address::where('user_id', $this->id)->get();
    }

    /**
     * Return user full name
     *
     * @return string
     */
    public function fullName()
    {
        return "{$this->surname} {$this->name}";
    }
}
