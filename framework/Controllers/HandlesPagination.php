<?php

namespace Framework\Controllers;

use Framework\Database\Builder;
use Framework\Database\Query;

/**
 * Apply to an object that handles pagination
 *
 * @package Framework\Controllers
 *
 * @mixin Controller
 */
trait HandlesPagination
{
    /**
     * Get current page
     *
     * @return int
     */
    protected function page()
    {
        $page = $this->request->get('page', 1);

        if (!is_numeric($page) || $page < 1) {
            return 1;
        }

        return (int)$page;
    }

    /**
     * Paginate query
     *
     * @param Query|Builder $query
     * @param int $itemsPerPage
     * @param string $key
     * @return array
     */
    protected function paginate($query, $itemsPerPage = 20, $key = 'items')
    {
        $page = $this->page();

        $items = $query
            ->limit($itemsPerPage + 1)
            ->offset(($page - 1) * $itemsPerPage)
            ->all();

        $hasNext = count($items) > $itemsPerPage;
        $hasPrevious = $page != 1;

        $items = array_slice($items, 0, $itemsPerPage);

        return [
            $key => $items,
            'page' => $page,
            'hasNext' => $hasNext,
            'hasPrevious' => $hasPrevious,
        ];
    }
}
