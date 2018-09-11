<?php

namespace App\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Framework\Controllers\Controller;
use Framework\Responses\Response;

/**
 * Manage user cart
 *
 * @package App\Controllers
 */
class CartController extends Controller
{
    /**
     * Get cart page
     *
     * @return Response
     */
    public function get()
    {
        return $this->view('cart.show');
    }

    /**
     * Push a product into the cart
     *
     * @return Response
     */
    public function push()
    {
        $product = Product::find($this->request->post('product_id', 0));
        $quantity = max(1, $this->request->post('quantity', 1));

        if (is_null($product)) {
            return $this->view('error.404', [], 404);
        }

        Cart::instance()->push($product, $quantity);

        return $this->redirect('/product?id=' . $product->id)->withFlash([
            'success' => 'product_added_to_cart',
        ]);
    }

    /**
     * Push a product into the cart
     *
     * @return Response
     */
    public function remove()
    {
        $product = Product::find($this->request->post('product_id', 0));

        if (!is_null($product)) {
            Cart::instance()->remove($product);
        }

        return $this->redirect('/cart');
    }
}
