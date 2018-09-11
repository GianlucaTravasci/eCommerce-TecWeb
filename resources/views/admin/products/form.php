<div class="product-group">
    <label for="name"><?= trans('products.name') ?></label>
    <input class="product-input"
           id="name"
           type="text"
           name="name"
           placeholder="<?= trans('products.name') ?>"
           value="<?= e(old('name', isset($product) ? $product->name : '')) ?>"
           required>
</div>

<div class="product-group">
    <label for="category_id"><?= trans('products.category') ?></label>
    <select class="product-select" id="category_id" name="category_id" required>
        <?php foreach ($categories as $group) { ?>
            <optgroup label="<?= e($group['parent']->name) ?>">
                <?php foreach ($group['children'] as $category) { ?>
                    <option value="<?= e($category->id) ?>"
                        <?= old('category_id', isset($product) ? $product->category_id : '') == $category->id ? ' selected' : '' ?>>
                        <?= e($category->name) ?>
                    </option>
                <?php } ?>
            </optgroup>
        <?php } ?>
    </select>
</div>

<div class="product-group">
    <label for="price"><?= trans('products.price') ?></label>
    <input class="product-input"
           id="price"
           type="number"
           name="price"
           placeholder="<?= trans('products.price') ?>"
           value="<?= e(old('price', isset($product) ? $product->price : '')) ?>"
           required>
</div>

<div class="product-group">
    <label for="description"><?= trans('products.description') ?></label>
    <textarea class="product-textarea"
              id="description"
              name="description"
              rows="7"
              required><?= e(old('description', isset($product) ? $product->description : '')) ?></textarea>
</div>

<div class="form-check">
    <label class="form-check-label">
        <input class="form-check-input"
               type="checkbox"
               name="homepage"
               value="1"
            <?= old('homepage', isset($product) ? $product->homepage : false) ? ' checked' : '' ?>>
        <?= trans('products.homepage') ?>
    </label>
</div>
