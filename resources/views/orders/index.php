<?= $this->view('layout.header', ['title' => trans('orders.history')]) ?>

<div id="content" class="container page">

    <h1 class="page-title"><?= trans('orders.history') ?></h1>

    <?php if (count($orders) > 0) { ?>
        <div class="orders-block">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col"><?= trans('orders.date') ?></th>
                    <th scope="col"><?= trans('orders.payment_status') ?></th>
                    <th scope="col"><?= trans('orders.shipping_status') ?></th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($orders as $order) { ?>
                    <tr>
                        <th scope="row"><?= $order->id ?></th>
                        <td>
                            <a href="<?= route('/order?id=' . $order->id) ?>">
                                <?= $order->date()->format('d/m/Y H:i') ?>
                            </a>
                        </td>
                        <td>
                            <?= trans('orders.payment_status_' . $order->payment_status) ?>
                        </td>
                        <td>
                            <?= trans('orders.shipping_status_' . (is_null($order->shipping()->shippedAt()) ? 'pending' : 'done')) ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

        <?= $this->view('components.paginator', [
            'route' => '/orders',
            'hasNext' => $hasNext,
            'hasPrevious' => $hasPrevious,
            'page' => $page,
        ]) ?>
    <?php } else { ?>
        <div class="no-order">
            <?= trans('orders.no_orders') ?>
        </div>
    <?php } ?>

</div>

<?= $this->view('layout.footer') ?>
