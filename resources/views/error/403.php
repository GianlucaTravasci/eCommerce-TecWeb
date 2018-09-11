<?= $this->view('layout.header', [
    'title' => trans('errors.403'),
]) ?>

<div id="content" class="container page">

    <div class="error">
        <?= trans('errors.403') ?>
    </div>

</div>

<?= $this->view('layout.footer') ?>
