<?= $this->view('admin.layout.header', ['title' => $product->name]) ?>

<div id="content" class="container page product-page">

    <form class="product-form"
          action="<?= route('/admin/product?id=' . $product->id) ?>"
          method="POST"
          enctype="multipart/form-data">

        <h1 class="product-title"><?= trans('products.single') ?></h1>

        <?= $this->view('components.alert') ?>

        <?= $this->view('admin.products.form', compact('product', 'categories')) ?>

        <div class="row">
            <div class="col-md">
                <?php if ($product->image) { ?>
                    <img src="<?= storage('images', $product->image) ?>"
                         class="img-thumbnail"
                         alt="<?= e($product->name) ?>">
                <?php } else { ?>
                    <svg width="400" height="400" xmlns="http://www.w3.org/2000/svg">
                        <rect x="2" y="2" width="396" height="396" style="fill:#DEDEDE;stroke:#555555;stroke-width:2"/>
                    </svg>
                <?php } ?>
            </div>
            <div class="col-md">
                <?php if ($product->image) {

                    // This link should ask for confirmation and
                    // be a post request to avoid csrf,
                    // but we are inside another form and this
                    // was the quickest way to do it without JS or
                    // rearranging the DOM
                    ?>
                    <a href="<?= route('/admin/product/image?id=' . $product->id) ?>">
                        <?= trans('products.destroy_image') ?>
                    </a>
                    <br>
                    <br>
                <?php } ?>

                <div class="product-group">
                    <label for="image"><?= trans('products.upload_image') ?></label>
                    <input type="file" id="image" name="image" class="form-control">
                </div>
            </div>
        </div>

        <div class="product-confirm">
            <button type="submit" class="btn btn-primary">
                <?= trans('products.update') ?>
            </button>
        </div>
    </form>

    <?php if ($product->isDeletable()) { ?>
        <div class="line-break"></div>

        <form class="product-form delete-form"
              action="<?= route('/admin/product?id=' . $product->id) ?>"
              method="POST">
            <input type="hidden" name="http_method" value="DELETE">

            <h1 class="product-title"><?= trans('products.destroy_product') ?></h1>

            <input type="submit" class="btn btn-block btn-outline-primary" value="<?= trans('products.destroy') ?>">
        </form>
    <?php } ?>
</div>

<?= $this->view('admin.layout.footer') ?>
