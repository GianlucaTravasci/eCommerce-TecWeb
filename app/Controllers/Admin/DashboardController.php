<?php

namespace App\Controllers\Admin;

use App\Queries\OrderQuery;
use Framework\Responses\Response;

/**
 * Admin Dashboard
 *
 * @package App\Controllers\Admin
 */
class DashboardController extends BaseAdminController
{
    /**
     * Display dashboard
     *
     * @return Response
     */
    public function index()
    {
        $counts = $this->orderCounts();
        $totals = $this->orderTotals();
        $activeUsers = $this->activeUsers();

        return $this->view('admin.dashboard.index', compact('counts', 'totals', 'activeUsers'));
    }

    /**
     * Order counts for current and previous month
     *
     * @return array
     */
    protected function orderCounts()
    {
        $previous = OrderQuery::ordersCountByMonth(date_create("last day of -1 month"));
        $current = OrderQuery::ordersCountByMonth(date_create());
        $delta = ($current - $previous) / $previous * 100;

        return compact('previous', 'current', 'delta');
    }

    /**
     * Order totals for current and previous month
     *
     * @return array
     */
    protected function orderTotals()
    {
        $previous = OrderQuery::ordersTotalByMonth(date_create("last day of -1 month"));
        $current = OrderQuery::ordersTotalByMonth(date_create());
        $delta = ($current - $previous) / $previous * 100;

        return compact('previous', 'current', 'delta');
    }

    /**
     * Active users for current and previous month
     *
     * @return array
     */
    protected function activeUsers()
    {
        $previous = OrderQuery::activeUsersByMonth(date_create("last day of -1 month"));
        $current = OrderQuery::activeUsersByMonth(date_create());
        $delta = ($current - $previous) / $previous * 100;

        return compact('previous', 'current', 'delta');
    }
}
