<?php

namespace App\Models;

use Framework\Database\Model;

/**
 * Category
 *
 * @package App\models
 *
 * @property int $id
 * @property string $name
 * @property int $parent_id
 */
class Category extends Model
{
    public static $table = 'categories';

    /**
     * Fetch parent category
     *
     * @return null|Category
     */
    public function parent()
    {
        if (!$this->parent_id) {
            return null;
        }

        return Category::find($this->parent_id);
    }

    /**
     * Fetch children categories
     *
     * @return array|Category[]
     */
    public function children()
    {
        return Category::where('parent_id', $this->id)->all();
    }

    /**
     * Fetch products
     *
     * @return array|Product[]
     */
    public function products()
    {
        return Product::where('category_id', $this->id)->all();
    }

    /**
     * Determine if category can be deleted
     *
     * @return true
     */
    public function isDeletable()
    {
        if (count($this->children()) > 0) {
            return false;
        }

        if (count($this->products()) > 0) {
            return false;
        }

        return true;
    }
}
