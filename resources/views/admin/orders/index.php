<?= $this->view('admin.layout.header', ['title' => trans('orders.title')]) ?>

<div id="content" class="container page">

    <h1 class="page-title"><?= trans('orders.list') ?></h1>

    <div class="orders-block">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col"><?= trans('orders.user') ?></th>
                <th scope="col"><?= trans('orders.payment_status') ?></th>
                <th scope="col"><?= trans('orders.shipping_status') ?></th>
                <th scope="col"><?= trans('orders.date') ?></th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($orders as $order) { ?>
                <tr>
                    <th scope="row"><?= $order->id ?></th>
                    <td>
                        <a href="<?= route('/admin/order?id=' . $order->id) ?>">
                            <?= e($order->user()->fullName()) ?>
                        </a>
                    </td>
                    <td>
                        <?= trans('orders.payment_status_' . $order->payment_status) ?>
                    </td>
                    <td>
                        <?= trans('orders.shipping_status_' . (is_null($order->shipping()->shippedAt()) ? 'pending' : 'done')) ?>
                    </td>
                    <td>
                        <?= $order->date()->format('d/m/Y H:i') ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <?= $this->view('components.paginator', [
        'route' => '/admin/orders',
        'hasNext' => $hasNext,
        'hasPrevious' => $hasPrevious,
        'page' => $page,
    ]) ?>

</div>

<?= $this->view('admin.layout.footer') ?>
