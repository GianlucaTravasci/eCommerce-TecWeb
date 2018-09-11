<?php

namespace App\Models;

use Framework\Database\Model;

/**
 * Address
 *
 * @package App\models
 *
 * @property int $id
 * @property int $user_id
 * @property string $country
 * @property string $city
 * @property string $street
 * @property string $number
 */
class Address extends Model
{
    public static $table = 'addresses';
}
