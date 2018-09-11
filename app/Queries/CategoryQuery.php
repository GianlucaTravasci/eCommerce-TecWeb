<?php

namespace App\Queries;

use App\Models\Category;

/**
 * Set of queries to retrieve categories
 *
 * @package App\Queries
 */
class CategoryQuery
{
    /**
     * Fetch categories grouped by parent
     *
     * @return array
     */
    public static function grouped()
    {
        $allCategories = Category::all();

        return array_map(
            function (Category $parent) use ($allCategories) {
                return [
                    'parent' => $parent,
                    'children' => array_filter($allCategories, function (Category $category) use ($parent) {
                        return $category->parent_id == $parent->id;
                    }),
                ];
            },
            array_filter($allCategories, function (Category $category) {
                return !$category->parent_id;
            })
        );
    }
}
