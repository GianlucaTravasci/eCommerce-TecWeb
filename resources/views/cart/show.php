<?= $this->view('layout.header', [
    'title' => trans('home.title'),
]) ?>

<div id="content" class="container page">

    <div class="products-list">

        <?php if ($cart->empty()) { ?>
            <div class="no-product">
                <?= trans('cart.empty') ?>
            </div>
        <?php } ?>

        <?php foreach ($cart->all() as $product) { ?>
            <div class="product">

                <div class="product-remove">
                    <form action="<?= route('/cart') ?>" method="post">
                        <input type="hidden" name="http_method" value="DELETE">
                        <input type="hidden" name="product_id" value="<?= $product->id ?>">

                        <button type="submit"
                                class="btn btn-outline-primary ml-2"
                                title="<?= trans('cart.remove') ?>">
                            X
                        </button>
                    </form>
                </div>

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
                    <a href="<?= route('/product?id=' . $product->id) ?>">
                        <?= e($product->name) ?>
                    </a>
                    <div class="text-secondary">
                        <?= e($product->category()->name) ?>
                    </div>
                </div>

                <div class="spacer"></div>

                <div class="product-price">
                    <?= $product->quantity ?> x € <?= number_format($product->price / 100, 2) ?>
                </div>
            </div>
        <?php } ?>
    </div>

    <?php if (!$cart->empty()) { ?>
        <div class="cart-total">
            <div class="checkout-link">
                <a href="<?= route('/checkout') ?>" class="btn btn-primary">
                    <?= trans('checkout.title') ?>
                </a>
            </div>

            <div class="total-price">
                <?= trans('cart.total') ?>: € <?= number_format($cart->total() / 100, 2) ?>
            </div>
        </div>
    <?php } ?>
</div>

<?= $this->view('layout.footer') ?>
