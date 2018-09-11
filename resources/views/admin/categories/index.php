<?= $this->view('admin.layout.header', ['title' => trans('categories.title')]) ?>

<div id="content" class="container page">

    <h1 class="page-title"><?= trans('categories.list') ?></h1>

    <form action="<?= route('/admin/categories') ?>" method="POST">

        <div class="categories-form">

            <div class="categories-name">
                <label class="sr-only" for="name"><?= trans('categories.name') ?></label>
                <input class="categories-name-input"
                       id="name"
                       type="text"
                       name="name"
                       placeholder="<?= trans('categories.name') ?>"
                       value="<?= e(old('name')) ?>"
                       required>
            </div>

            <div class="line-break"></div>

            <div class="categories-parent">
                <label class="sr-only" for="parent_id"><?= trans('categories.parent') ?></label>
                <select class="categories-parent-input" id="parent_id" name="parent_id">
                    <option value="0"><?= trans('categories.no_parent') ?></option>
                    <?php foreach ($rootCategories as $category) { ?>
                        <option value="<?= $category->id ?>"<?= old('parent_id') == $category->id ? ' selected' : '' ?>>
                            <?= e($category->name) ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="line-break"></div>

            <div class="categories-submit">
                <button type="submit" class="btn btn-primary">
                    <?= trans('categories.create') ?>
                </button>
            </div>
        </div>

    </form>

    <div class="table-block">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col"><?= trans('categories.name') ?></th>
                <th scope="col"><?= trans('categories.parent') ?></th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($categories as $category) { ?>
                <tr>
                    <th scope="row"><?= $category->id ?></th>
                    <td>
                        <a href="<?= route('/admin/category?id=' . $category->id) ?>"><?= e($category->name) ?></a>
                    </td>
                    <td>
                        <?php if ($category->parent_id) {
                            echo e($category->parent()->name);
                        } else {
                            echo '<span class="text-muted">' . trans('categories.no_parent') . '</span>';
                        } ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->view('admin.layout.footer') ?>
