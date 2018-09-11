<?php

namespace App\Models;

/**
 * Cart
 *
 * @package App\Models
 */
class Cart
{
    /**
     * @var Product[]
     */
    protected $data;

    /**
     * Create cart object
     */
    public function __construct()
    {
        $this->refresh();
    }

    /**
     * Get current cart instance
     *
     * @return static
     */
    public static function instance()
    {
        static $instance;

        if (is_null($instance)) {
            $instance = new static();
        }

        return $instance;
    }

    /**
     * Pull products from session
     *
     * @return $this
     */
    public function refresh()
    {
        $cart = json_decode(session('cart', '[]'), true);

        if (empty($cart)) {
            $this->data = [];

            return $this;
        }

        $this->data = array_map(
            function (Product $product) use ($cart) {
                $product->quantity = $cart[$product->id] ?? 1;

                return $product;
            },
            Product::whereIn('id', array_keys($cart))->all()
        );

        return $this;
    }

    /**
     * Fetch all products in cart
     *
     * @return Product[]
     */
    public function all()
    {
        return $this->data;
    }

    /**
     * Push given quantity of products into cart
     *
     * @param Product $product
     * @param int $quantity
     * @return $this
     */
    public function push(Product $product, $quantity)
    {
        $pushed = false;

        foreach ($this->data as $productInCart) {
            if ($productInCart->id == $product->id) {
                $productInCart->quantity = $productInCart->quantity + $quantity;
                $pushed = true;

                break;
            }
        }

        if (!$pushed) {
            $product->quantity = $quantity;
            $this->data[] = $product;
        }

        return $this->update();
    }

    /**
     * Update cart in session
     *
     * @return $this
     */
    protected function update()
    {
        $cart = [];

        foreach ($this->data as $product) {
            $cart[$product->id] = $product->quantity;
        }

        session()->set('cart', json_encode($cart));

        return $this;
    }

    /**
     * Total number of products in the cart
     *
     * @return int
     */
    public function count()
    {
        return array_reduce($this->data, function ($count, Product $product) {
            return $count + $product->quantity;
        }, 0);
    }

    /**
     * Cart total
     *
     * @return int
     */
    public function total()
    {
        return array_reduce($this->data, function ($count, Product $product) {
            return $count + ($product->quantity * $product->price);
        }, 0);
    }

    /**
     * Determine if cart is empty
     *
     * @return boolean
     */
    public function empty()
    {
        return empty($this->data);
    }

    /**
     * Empty cart
     *
     * @return $this
     */
    public function flush()
    {
        $this->data = [];

        return $this->update();
    }

    /**
     * Remove product from cart
     *
     * @param Product $product
     * @return $this
     */
    public function remove($product)
    {
        $this->data = array_filter($this->data, function (Product $p) use ($product) {
            return $p->id != $product->id;
        });

        return $this->update();
    }
}
