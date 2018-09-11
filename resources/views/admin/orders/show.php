<?= $this->view('admin.layout.header', ['title' => trans('orders.single', ['id' => $order->id])]) ?>

<div id="content" class="container page">

    <h1 class="page-title mb-0"><?= trans('orders.single', ['id' => $order->id]) ?></h1>

    <?= $this->view('components.alert') ?>

    <div class="row">

        <div class="col-md">
            <div class="orders-card">
                <div class="card-title">
                    <?= trans('orders.single', ['id' => $order->id]) ?>
                </div>

                <div class="text-muted">
                    <?= $order->date()->format('d/m/Y H:i') ?>
                </div>

                <div>
                    <?= trans('orders.payment_status') ?>:
                    <?= trans('orders.payment_status_' . $order->payment_status) ?>
                    <br>

                    <?= trans('orders.shipping_status') ?>:
                    <?= trans('orders.shipping_status_' . (is_null($shipping->shippedAt()) ? 'pending' : 'done')) ?>
                    <br>
                </div>
            </div>
        </div>

        <div class="col-md">
            <div class="card">
                <div class="orders-card">
                    <h5 class="card-title"><?= e($orderUser->fullName()) ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        <?= e($orderUser->email) ?>
                    </h6>
                    <div class="card-text">
                        <address class="mb-0">
                            <?= e($address->street) ?>, <?= e($address->number) ?><br>
                            <?= e($address->city) ?>, <?= trans('countries.' . $address->country) ?>
                        </address>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md">
            <div class="orders-card">
                <div class="orders-card-form">
                    <form action="<?= route('/admin/order/ship?id=' . $order->id) ?>" method="post">
                        <button type="submit"
                                class="btn btn-primary btn-lg btn-block"
                            <?= (is_null($shipping->shippedAt()) ? '' : 'disabled') ?>>
                            <?= trans('orders.mark_as_shipped') ?>
                        </button>
                    </form>

                    <form action="<?= route('/admin/order?id=' . $order->id) ?>" method="post">
                        <input type="hidden" name="http_method" value="DELETE">

                        <button type="submit" class="btn btn-outline-danger btn-lg btn-block mt-2">
                            <?= trans('orders.destroy') ?>
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <div class="orders-block mt-0">
        <table class="table">
            <thead>
            <tr>
                <th scope="col"><?= trans('products.name') ?></th>
                <th scope="col"><?= trans('products.category') ?></th>
                <th scope="col"><?= trans('products.price') ?></th>
                <th scope="col"><?= trans('products.quantity') ?></th>
                <th scope="col"><?= trans('products.total') ?></th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($items as $product) { ?>
                <tr>
                    <td>
                        <a href="<?= route('/admin/product?id=' . $product->id) ?>"><?= e($product->name) ?></a>
                    </td>
                    <td>
                        <?= e($product->category()->name) ?>
                    </td>
                    <td class="no-wrap">
                        € <?= number_format($product->price / 100, 2) ?>
                    </td>
                    <td>
                        <?= $product->quantity ?>
                    </td>
                    <td class="no-wrap">
                        € <?= number_format($product->price * $product->quantity / 100, 2) ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

        <div class="order-total">
            <?= trans('products.total') ?>:
            € <?= number_format($total / 100, 2) ?>
        </div>
    </div>

</div>

<?= $this->view('admin.layout.footer') ?>
