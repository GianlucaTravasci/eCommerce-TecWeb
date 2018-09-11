<?php

namespace App\Controllers;

use App\Models\Order;
use App\Models\Product;
use Framework\Auth\Guard;
use Framework\Responses\Response;

/**
 * Manage user orders
 *
 * @package App\Controllers
 */
class OrderController extends BasePrivateController
{
    const ORDERS_PER_PAGE = 15;

    /**
     * Display orders
     *
     * @return Response
     */
    public function index()
    {
        return $this->view(
            'orders.index',
            $this->paginate(
                Order::where('user_id', Guard::user()->id)->orderBy('date', SORT_DESC),
                static::ORDERS_PER_PAGE,
                'orders'
            )
        );
    }

    /**
     * Display order
     *
     * @return Response
     */
    public function get()
    {
        $order = Order::find($this->request->get('id', 0));

        if (is_null($order) || $order->user_id != Guard::user()->id) {
            return $this->view('error.404', [], 404);
        }

        $shipping = $order->shipping();
        $address = $shipping->address();
        $items = $order->items();

        $total = array_reduce($items, function ($total, Product $product) {
            return $total + ($product->price * $product->quantity);
        }, 0);

        return $this->view('orders.show', compact('order', 'shipping', 'address', 'items', 'total'));
    }
}
