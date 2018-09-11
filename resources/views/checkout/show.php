<?= $this->view('layout.minimal', [
    'title' => trans('checkout.title'),
]) ?>


<form action="<?= route('/checkout') ?>" method="post">
    <div id="content" class="container page checkout-page">

        <div class="checkout">
            <div class="checkout-address">
                <div class="address-name"><?= e($user->fullName()) ?></div>

                <div class="address-email"><?= e($user->email) ?></div>

                <address class="mb-0">
                    <?= e($address->street) ?>, <?= e($address->number) ?><br>
                    <?= e($address->city) ?>, <?= trans('countries.' . $address->country) ?>
                </address>
            </div>

            <div class="checkout-products">
                <?php foreach ($cart->all() as $product) { ?>
                    <div class="product">
                        <div class="product-quantity"><?= $product->quantity ?></div>
                        <div class="product-name"><?= $product->name ?></div>
                        <div class="product-price">€ <?= number_format($product->price / 100, 2) ?></div>
                    </div>
                <?php } ?>
            </div>

            <div class="checkout-total">
                € <?= number_format($cart->total() / 100, 2) ?>
            </div>

            <div class="checkout-payment">
                <div class="checkout-payment-title"><?= trans('checkout.choose_your_payment') ?></div>

                <div class="checkout-payment-help"><?= trans('checkout.payment_info') ?></div>

                <div class="checkout-payment-box">
                    <label class="sr-only" for="payment"><?= trans('checkout.choose_your_payment') ?></label>
                    <select class="checkout-payment-input"
                            id="payment"
                            name="payment">
                        <option value="pending"<?= old('payment') == 'pending' ? ' selected' : '' ?>>
                            <?= trans('orders.payment_status_pending') ?>
                        </option>
                        <option value="done"<?= old('payment') == 'done' ? ' selected' : '' ?>>
                            <?= trans('orders.payment_status_done') ?>
                        </option>
                        <option value="failed"<?= old('payment') == 'failed' ? ' selected' : '' ?>>
                            <?= trans('orders.payment_status_failed') ?>
                        </option>
                    </select>
                </div>
            </div>

            <div class="checkout-submit">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    <?= trans('checkout.submit') ?>
                </button>
            </div>
        </div>

    </div>
</form>
