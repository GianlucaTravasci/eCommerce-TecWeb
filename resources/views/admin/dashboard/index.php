<?= $this->view('admin.layout.header', [
    'title' => trans('dashboard.title'),
]) ?>

<div id="content" class="container page">

    <div class="row">
        <div class="col-md">
            <div class="metrics">
                <div class="metrics-body">
                    <div class="metrics-value"><?= $activeUsers['current'] ?></div>
                    <div class="metrics-delta <?= $activeUsers['delta'] >= 0 ? 'positive' : 'negative' ?>">
                        <?= number_format($activeUsers['delta'], 2) ?> %
                    </div>
                    <div class="metrics-name">
                        <?= trans('dashboard.active_users') ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md">
            <div class="metrics">
                <div class="metrics-body">
                    <div class="metrics-value"><?= $counts['current'] ?></div>
                    <div class="metrics-delta <?= $counts['delta'] >= 0 ? 'positive' : 'negative' ?>">
                        <?= number_format($counts['delta'], 2) ?> %
                    </div>
                    <div class="metrics-name">
                        <?= trans('dashboard.order_counts') ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md">
            <div class="metrics">
                <div class="metrics-body">
                    <div class="metrics-value">
                        € <?= number_format($totals['current'], 2) ?>
                    </div>
                    <div class="metrics-delta <?= $totals['delta'] >= 0 ? 'positive' : 'negative' ?>">
                        <?= number_format($totals['delta'], 2) ?> %
                    </div>
                    <div class="metrics-name">
                        <?= trans('dashboard.profit') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="metrics-help">
        <?= trans('dashboard.metrics_help') ?>
    </div>

</div>

<?= $this->view('admin.layout.footer') ?>
