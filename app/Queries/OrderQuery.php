<?php

namespace App\Queries;

use App\Models\Order;
use Framework\Database\Builder;
use Framework\Database\Query;

/**
 * Set of queries to retrieve orders
 *
 * @package App\Queries
 */
class OrderQuery
{
    /**
     * Fetch number of orders in given month
     *
     * @param \DateTimeInterface $date
     * @return int
     */
    public static function ordersCountByMonth($date)
    {
        $query = new Builder(Order::class);

        $monthBinding = $query->pushBinding($date->format('m'));
        $yearBinding = $query->pushBinding($date->format('Y'));

        return $query->rawWhere("YEAR(`date`) = :{$yearBinding}")
            ->rawWhere("MONTH(`date`) = :{$monthBinding}")
            ->count();
    }

    /**
     * Fetch number of orders in given month
     *
     * @param \DateTimeInterface $date
     * @return int
     */
    public static function ordersTotalByMonth($date)
    {
        $query = new Query();

        $monthBinding = $query->pushBinding($date->format('m'));
        $yearBinding = $query->pushBinding($date->format('Y'));

        return $query
            ->select('SUM(quantity * price)')
            ->table(
                '`orders`' .
                'INNER JOIN `order_items` ON `orders`.`id` = `order_items`.`order_id`' .
                'INNER JOIN `products` ON `products`.`id` = `order_items`.`product_id`'
            )
            ->where('payment_status', 'done')
            ->rawWhere("YEAR(`orders`.`date`) = :{$yearBinding}")
            ->rawWhere("MONTH(`orders`.`date`) = :{$monthBinding}")
            ->column();
    }

    /**
     * Fetch number of active users in given month
     *
     * An active user is someone who made at least one order
     *
     * @param \DateTimeInterface $date
     * @return int
     */
    public static function activeUsersByMonth($date)
    {
        $query = new Builder(Order::class);

        $monthBinding = $query->pushBinding($date->format('m'));
        $yearBinding = $query->pushBinding($date->format('Y'));

        return $query
            ->select('COUNT(DISTINCT `user_id`)')
            ->rawWhere("YEAR(`date`) = :{$yearBinding}")
            ->rawWhere("MONTH(`date`) = :{$monthBinding}")
            ->column();
    }
}
