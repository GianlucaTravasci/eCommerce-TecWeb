<?= $this->view('layout.header', [
    'title' => trans('errors.500'),
]) ?>

<div id="content" class="container page">

    <div class="error">
        <?= trans('errors.500') ?>
    </div>

</div>

<?= $this->view('layout.footer') ?>
