<?php

namespace App\Queries;

use App\Models\Category;
use App\Models\Product;
use Framework\Database\Builder;

class SearchProductQuery
{
    const SORT_FIELDS = [
        'name_asc' => ['name', SORT_ASC],
        'name_desc' => ['name', SORT_DESC],
        'price_asc' => ['price', SORT_ASC],
        'price_desc' => ['price', SORT_DESC],
        // We don't have popularity data, so we fake it
        // Note: Sort order is reversed (intended)
        'popularity_asc' => ['id', SORT_DESC],
        'popularity_desc' => ['id', SORT_ASC],
    ];

    /**
     * @var Builder
     */
    protected $query;

    /**
     * SearchProductQuery constructor.
     */
    public function __construct()
    {
        $this->query = new Builder(Product::class);
    }

    /**
     * Filter products by category
     *
     * @param null|Category $category
     * @return $this
     */
    public function category($category)
    {
        if (is_null($category)) {
            return $this;
        }

        if ($category->parent_id) {
            $this->query->where('category_id', $category->id);

            return $this;
        }

        $this->query->whereIn(
            'category_id',
            array_map(function (Category $category) {
                return $category->id;
            }, $category->children())
        );

        return $this;
    }

    /**
     * Filter products by name
     *
     * @param string $text
     * @return $this
     */
    public function like($text)
    {
        if (empty($text)) {
            return $this;
        }

        // Full-text-search would be way better
        // but we don't have a decent backend
        // so this is a great proof of concept
        $this->query->where('name', 'LIKE', "%{$text}%");

        return $this;
    }

    /**
     * Order query
     *
     * @param string $field
     * @return $this
     */
    public function order($field)
    {
        if (empty($field)) {
            return $this;
        }

        $order = static::SORT_FIELDS[$field] ?? static::SORT_FIELDS['popularity_desc'];

        $this->query->orderBy($order[0], $order[1]);

        return $this;
    }

    /**
     * Get query
     *
     * @return Builder
     */
    public function query()
    {
        return $this->query;
    }
}
