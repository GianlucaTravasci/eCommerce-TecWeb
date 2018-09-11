<?= $this->view('layout.header', [
    'title' => is_null($category) ? trans('products.list') : $category->name,
    'category' => $category,
]) ?>

<div id="content" class="container page">

    <form action="<?= route('/products') ?>" method="get">
        <?php if (!env('PRETTY_LINKS', false)) { ?>
            <input type="hidden" name="r" value="/products">
        <?php } ?>
        <?php if (!is_null($category)) { ?>
            <input type="hidden" name="category_id" value="<?= $category->id ?>">
        <?php } ?>
        <input type="hidden" name="q" value="<?= e(request('q', '')) ?>">

        <div class="products-sort">
            <div class="spacer"></div>

            <label class="sr-only" for="order"><?= trans('products.sort') ?></label>
            <select class="product-sort-select submit-on-change" name="order" id="order">
                <?php foreach (\App\Queries\SearchProductQuery::SORT_FIELDS as $key => $value) { ?>
                    <option value="<?= $key ?>"<?= request('order', 'popularity_desc') == $key ? ' selected' : '' ?>>
                        <?= trans('products.sort_' . $key) ?>
                    </option>
                <?php } ?>
            </select>

            <noscript>
                <button type="submit" class="btn btn-secondary"><?= trans('products.search') ?></button>
            </noscript>
        </div>
    </form>

    <?php if (count($products) > 0) { ?>
        <div class="products-list">
            <?php foreach ($products as $product) { ?>
                <div class="product enhancable">

                    <div class="product-image">
                        <a href="<?= route('/product?id=' . $product->id) ?>">
                            <?php if ($product->image) { ?>
                                <img src="<?= storage('images', $product->image) ?>"
                                     class="img-fluid"
                                     alt="<?= e($product->name) ?>">
                            <?php } else { ?>
                                <svg width="400" height="400" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="2" y="2" width="396" height="396"
                                          style="fill:#DEDEDE;stroke:#555555;stroke-width:2"></rect>
                                </svg>
                            <?php } ?>
                        </a>
                    </div>

                    <div class="product-name">
                        <a href="<?= route('/product?id=' . $product->id) ?>" class="enchance-target">
                            <?= e($product->name) ?>
                        </a>
                        <div class="text-secondary">
                            <?= e($product->category()->name) ?>
                        </div>
                    </div>

                    <div class="spacer"></div>

                    <div class="product-price">
                        € <?= number_format($product->price / 100, 2) ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <div class="no-order">
            <?= trans('products.no_products') ?>
        </div>
    <?php } ?>

    <?= $this->view('components.paginator', [
        'route' => function ($page) use ($category) {
            $route = '/products?page=' . $page;

            if (!is_null($category)) {
                $route .= '&category_id=' . $category->id;
            }

            if (request('order')) {
                $route .= '&order=' . request('order');
            }

            return route($route);
        },
        'hasNext' => $hasNext,
        'hasPrevious' => $hasPrevious,
        'page' => $page,
    ]) ?>

</div>

<?= $this->view('layout.footer') ?>
