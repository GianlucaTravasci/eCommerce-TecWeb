<?php

namespace App\Queries;

use App\Models\Product;

/**
 * Set of queries to retrieve products
 *
 * @package App\Queries
 */
class ProductQuery
{
    /**
     * Retrieve all products to put in the homepage
     *
     * @return Product[]
     */
    public static function homepage()
    {
        return Product::where('homepage', 1)->all();
    }
}
