<?php

namespace App\Controllers\Admin;

use App\Models\Order;
use App\Models\Product;
use Framework\Database\Database;
use Framework\Responses\Response;

/**
 * Manage orders
 *
 * @package App\controllers
 */
class OrderController extends BaseAdminController
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
            'admin.orders.index',
            $this->paginate(
                Order::orderBy('date', SORT_DESC),
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

        if (is_null($order)) {
            return $this->view('error.404', [], 404);
        }

        $orderUser = $order->user();
        $shipping = $order->shipping();
        $address = $shipping->address();
        $items = $order->items();

        $total = array_reduce($items, function ($total, Product $product) {
            return $total + ($product->price * $product->quantity);
        }, 0);

        return $this->view('admin.orders.show', compact('order', 'orderUser', 'shipping', 'address', 'items', 'total'));
    }

    /**
     * Delete an order
     *
     * @return string
     */
    public function destroy()
    {
        $order = Order::find($this->request->get('id', 0));

        if (is_null($order)) {
            return $this->view('error.404', [], 404);
        }

        Database::transaction(function () use ($order) {
            $order->destroy();
        });

        return $this->redirect('/admin/orders');
    }

    /**
     * Ship order
     *
     * @return Response
     */
    public function ship()
    {
        $order = Order::find($this->request->get('id', 0));

        if (is_null($order)) {
            return $this->view('error.404', [], 404);
        }

        $shipping = $order->shipping();

        if (is_null($shipping->shippedAt())) {
            $shipping
                ->ship()
                ->save();
        }

        return $this->redirect('/admin/order?id=' . $order->id)
            ->withFlash([
                'success' => 'order_shipped',
            ]);
    }
}
