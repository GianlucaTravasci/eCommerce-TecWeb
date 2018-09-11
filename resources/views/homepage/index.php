<?= $this->view('layout.header', [
    'title' => trans('home.title'),
]) ?>

<div class="container page">

    <div class="row">
        <div class="col-md-3">
            <?= $this->view('homepage.sidebar') ?>
        </div>

        <div class="col-md-9" id="content">
            <?= $this->view('homepage.products', compact('products')) ?>
        </div>
    </div>

</div>

<?= $this->view('layout.footer') ?>
