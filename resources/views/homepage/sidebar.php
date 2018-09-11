<aside class="sidebar">

    <?php foreach ($layoutCategories as $group) { ?>
        <div class="sidebar-block">
            <label class="heading"><?= e($group['parent']->name) ?></label>
            <ul class="sidebar-links">
                <?php foreach ($group['children'] as $category) { ?>
                    <li>
                        <a href="<?= route('/products?category_id=' . $category->id) ?>">
                            <?= e($category->name) ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>

</aside>
