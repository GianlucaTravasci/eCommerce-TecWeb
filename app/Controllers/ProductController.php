<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Queries\SearchProductQuery;
use Framework\Controllers\Controller;

/**
 * ProductController
 *
 * @package App\Controllers
 */
class ProductController extends Controller
{
    const PRODUCTS_PER_PAGE = 15;

    /**
     * Show products according to filters
     */
    public function index()
    {
        $category = null;

        if ($categoryId = $this->request->get('category_id')) {
            $category = Category::find($categoryId);
        }

        $query = (new SearchProductQuery())
            ->category($category)
            ->like($this->request->input('q'))
            ->order($this->request->input('order'));

        return $this->view('products.index', array_merge(
            compact('category'),
            $this->paginate($query->query(), static::PRODUCTS_PER_PAGE, 'products')
        ));
    }

    /**
     * Show product page
     */
    public function get()
    {
        $product = Product::find($this->request->get('id', 0));

        if (is_null($product)) {
            return $this->view('error.404', [], 404);
        }

        return $this->view('products.show', compact('product'));
    }
}
