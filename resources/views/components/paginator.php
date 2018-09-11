<?php
if (is_string($route)) {
    $route = function ($page) use ($route) {
        return route($route . '?page=' . $page);
    };
}
?>
<nav aria-label="<?= trans('components.paginator_label') ?>">
    <ul class="pagination justify-content-center">
        <li class="page-item<?= $hasPrevious ? '' : ' disabled' ?>">
            <a class="page-link" href="<?= $hasPrevious ? $route($page - 1) : '#' ?>">
                <?= trans('components.paginator_previous') ?>
            </a>
        </li>
        <li class="page-item<?= $hasNext ? '' : ' disabled' ?>">
            <a class="page-link" href="<?= $hasNext ? $route($page + 1) : '#' ?>">
                <?= trans('components.paginator_next') ?>
            </a>
        </li>
    </ul>
</nav>
