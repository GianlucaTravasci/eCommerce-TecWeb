<?= $this->view('layout.header', [
    'title' => trans('errors.404'),
]) ?>

<div id="content" class="container page">

    <div class="error">
        <?= trans('errors.404') ?>
    </div>

</div>

<?= $this->view('layout.footer') ?>
