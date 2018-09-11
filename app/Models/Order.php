<?php

namespace App\Models;

use Framework\Database\Database;
use Framework\Database\Model;

/**
 * Order
 *
 * @package App\models
 *
 * @property int $id
 * @property int $user_id
 * @property string $payment_status
 * @property string $date
 */
class Order extends Model
{
    public static $table = 'orders';

    /**
     * Order date
     *
     * @return \DateTimeImmutable
     */
    public function date()
    {
        return \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $this->date);
    }

    /**
     * Fetch user
     *
     * @return User
     */
    public function user()
    {
        return User::find($this->user_id);
    }

    /**
     * Fetch shipping
     *
     * @return Shipping
     */
    public function shipping()
    {
        return Shipping::where('order_id', $this->id)->get();
    }

    /**
     * Fetch items
     *
     * @return Product[]
     */
    public function items()
    {
        return Product::select('`products`.*, `order_items`.`quantity`')
            ->table('`order_items` INNER JOIN `products` ON `order_items`.`product_id` = `products`.`id`')
            ->where('order_id', $this->id)
            ->all();
    }

    /**
     * @inheritdoc
     */
    public function destroy()
    {
        $this->shipping()->destroy();

        $stmt = Database::getConnection()->prepare('DELETE FROM `order_items` WHERE `order_id` = :id');

        $stmt->bindValue(':id', $this->id);

        $stmt->execute();

        return parent::destroy();
    }
}
