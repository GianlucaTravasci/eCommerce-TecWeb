<?= $this->view('admin.layout.header', ['title' => $category->name]) ?>

<div id="content" class="container page category-show">

    <div class="category-form">
        <form action="<?= route('/admin/category?id=' . $category->id) ?>" method="post">

            <h1 class="page-title"><?= trans('categories.single') ?></h1>

            <?= $this->view('components.alert') ?>

            <div class="category-group">
                <label for="name" class="sr-only"><?= trans('categories.name') ?></label>
                <input class="categories-name-input"
                       id="name"
                       type="text"
                       name="name"
                       placeholder="<?= trans('categories.name') ?>"
                       value="<?= e(old('name', $category->name)) ?>"
                       required>
            </div>

            <div class="category-group">
                <label for="parent_id" class="sr-only"><?= trans('categories.parent') ?></label>
                <select class="categories-parent-input" id="parent_id" name="parent_id">
                    <option value="0"><?= trans('categories.no_parent') ?></option>
                    <?php foreach ($rootCategories as $c) { ?>
                        <option value="<?= $c->id ?>"<?= old('parent_id', $category->parent_id) == $c->id ? ' selected' : '' ?>>
                            <?= e($c->name) ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <button type="submit" class="btn btn-block btn-primary">
                <?= trans('categories.update') ?>
            </button>
        </form>

        <?php if ($category->isDeletable()) { ?>
            <form action="<?= route('/admin/category?id=' . $category->id) ?>" method="POST">
                <input type="hidden" name="http_method" value="DELETE">

                <input type="submit" class="btn btn-outline-primary btn-block mt-2"
                       value="<?= trans('categories.destroy') ?>">
            </form>
        <?php } ?>
    </div>
</div>

<?= $this->view('admin.layout.footer') ?>
