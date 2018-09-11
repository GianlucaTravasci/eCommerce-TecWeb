<?= $this->view('admin.layout.header', ['title' => trans('products.add_product')]) ?>

<div id="content" class="container page product-page">

    <form class="product-form" action="<?= route('/admin/products') ?>" method="POST">

        <h1 class="product-title"><?= trans('products.add_product') ?></h1>

        <?= $this->view('components.alert') ?>

        <?= $this->view('admin.products.form', compact('product', 'categories')) ?>

        <div class="product-confirm">
            <button type="submit" class="btn btn-primary">
                <?= trans('products.create') ?>
            </button>
        </div>

    </form>

</div>

<?= $this->view('admin.layout.footer') ?>
