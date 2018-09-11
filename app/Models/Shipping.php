<?php

namespace App\Models;

use Framework\Database\Model;

/**
 * Shipping
 *
 * @package App\models
 *
 * @property int $id
 * @property int $address_id
 * @property int $order_id
 * @property string $shipped_at
 */
class Shipping extends Model
{
    public static $table = 'shippings';

    /**
     * Shipping date
     *
     * @return null|\DateTimeImmutable
     */
    public function shippedAt()
    {
        if (is_null($this->shipped_at)) {
            return null;
        }

        return \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $this->shipped_at);
    }

    /**
     * Fetch address
     *
     * @return Address
     */
    public function address()
    {
        return Address::find($this->address_id);
    }

    /**
     * Fetch order
     *
     * @return Order
     */
    public function order()
    {
        return Order::find($this->order_id);
    }

    /**
     * Mark as shipped
     *
     * @return $this
     */
    public function ship()
    {
        $this->shipped_at = date('Y-m-d H:i:s');

        return $this;
    }
}
