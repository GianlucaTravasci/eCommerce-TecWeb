<?php

namespace App\Models;

use Framework\Database\Model;
use Framework\Database\Query;

/**
 * Product
 *
 * @package App\models
 *
 * @property int $id
 * @property string $name
 * @property int $category_id
 * @property string $description
 * @property int $price
 * @property int $homepage
 * @property string $image
 */
class Product extends Model
{
    public static $table = 'products';

    /**
     * Fetch product category
     *
     * @return Category
     */
    public function category()
    {
        return Category::find($this->category_id);
    }

    /**
     * Determine if product can be deleted
     *
     * @return true
     */
    public function isDeletable()
    {
        return (new Query())
                ->table('order_items')
                ->where('product_id', $this->id)
                ->count() <= 0;
    }
}
