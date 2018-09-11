<?= $this->view('layout.header', [
    'title' => $product->name,
]) ?>

<div id="content" class="container page">

    <?= $this->view('components.alert') ?>

    <div class="product-show">
        <div class="product-image">
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
        </div>

        <div class="line-break"></div>

        <div class="product-body">
            <h1><?= e($product->name) ?></h1>

            <div class="product-category">
                <?= e($product->category()->name); ?>
            </div>

            <div class="product-description">
                <?= e($product->description) ?>
            </div>

            <div class="product-buy">
                <div class="product-price">
                    € <?= number_format($product->price / 100, 2) ?>
                </div>

                <div class="product-form">
                    <form class="form-inline" action="<?= route('/cart') ?>" method="post">
                        <input type="hidden" name="product_id" value="<?= $product->id ?>">

                        <label for="quantity" class="sr-only"><?= trans('products.quantity') ?></label>
                        <input type="number"
                               min="1"
                               class="product-quantity-input"
                               id="quantity"
                               name="quantity"
                               placeholder="<?= trans('products.quantity') ?>"
                               value="<?= e(old('quantity', 1)) ?>">

                        <button type="submit" class="btn btn-primary">
                            <?= trans('products.add_to_cart') ?>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<?= $this->view('layout.footer') ?>
