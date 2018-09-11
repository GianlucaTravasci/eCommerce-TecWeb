<?php

namespace App\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Shipping;
use Framework\Auth\Guard;
use Framework\Database\Database;

/**
 * Manage user checkout
 *
 * @package App\Controllers
 */
class CheckoutController extends BasePrivateController
{
    /**
     * Show checkout form
     *
     * @return \Framework\Responses\Response
     */
    public function get()
    {
        $address = Guard::user()->address();

        return $this->view('checkout.show', compact('address'));
    }

    /**
     * Place order
     *
     * @return \Framework\Responses\Response
     */
    public function store()
    {
        $cart = Cart::instance();

        if ($cart->empty()) {
            return $this->redirect('/cart');
        }

        $order = Database::transaction(function () use ($cart) {
            $user = Guard::user();

            $order = new Order([
                'user_id' => $user->id,
                'payment_status' => $this->paymentStatus(),
                'date' => date('Y-m-d H:i:s'),
            ]);
            $order->save();

            $shipping = new Shipping([
                'address_id' => $user->address()->id,
                'order_id' => $order->id,
            ]);
            $shipping->save();

            $this->insertItems($order);

            return $order;
        });

        $cart->flush();

        return $this->redirect('/order?id=' . $order->id);
    }

    /**
     * Validate and sanitize payment status
     *
     * @return string
     */
    protected function paymentStatus()
    {
        $status = $this->request->post('payment', 'pending');

        if (!in_array($status, ['pending', 'done', 'failed'])) {
            return 'pending';
        }

        return $status;
    }

    /**
     * Insert items from cart into order
     *
     * @param Order $order
     */
    protected function insertItems($order)
    {
        $products = Cart::instance()->all();
        $sql = 'INSERT INTO `order_items` (`product_id`, `order_id`, `quantity`) VALUES ';

        for ($i = 0; $i < count($products); $i++) {
            $sql .= "(:product{$i}, :order{$i}, :quantity{$i}),";
        }

        $stmt = Database::getConnection()->prepare(substr($sql, 0, -1));

        for ($i = 0; $i < count($products); $i++) {
            $stmt->bindValue(':product' . $i, $products[$i]->id);
            $stmt->bindValue(':order' . $i, $order->id);
            $stmt->bindValue(':quantity' . $i, $products[$i]->quantity);
        }

        $stmt->execute();
    }
}
