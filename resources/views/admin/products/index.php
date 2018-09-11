<?= $this->view('admin.layout.header', ['title' => trans('products.title')]) ?>

<div id="content" class="container page">

    <h1 class="page-title"><?= trans('products.list') ?></h1>

    <div class="text-center">
        <a href="<?= route('/admin/products/create') ?>">
            <?= trans('products.add_product') ?>
        </a>
    </div>

    <div class="table-block">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col"><?= trans('products.name') ?></th>
                <th scope="col"><?= trans('products.category') ?></th>
                <th scope="col"><?= trans('products.price') ?></th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($products as $product) { ?>
                <tr>
                    <th scope="row"><?= $product->id ?></th>
                    <td>
                        <a href="<?= route('/admin/product?id=' . $product->id) ?>"><?= e($product->name) ?></a>
                    </td>
                    <td>
                        <?= e($product->category()->name) ?>
                    </td>
                    <td>
                        € <?= number_format($product->price / 100, 2) ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <?= $this->view('components.paginator', [
        'route' => '/admin/products',
        'hasNext' => $hasNext,
        'hasPrevious' => $hasPrevious,
        'page' => $page,
    ]) ?>

</div>

<?= $this->view('admin.layout.footer') ?>
