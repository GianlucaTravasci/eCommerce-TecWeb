<?php
/** @var \App\Models\Product[][] $chunks */
$chunks = array_chunk($products, 3);

foreach ($chunks as $chunk) {
    echo '<div class="products-grid">';

    foreach ($chunk as $product) {
        ?>
        <div class="product enhancable">
            <div class="product-price">
                € <?= number_format($product->price / 100, 2) ?>
            </div>

            <div class="product-image">
                <a href="<?= route('/product?id=' . $product->id) ?>">
                    <?php if ($product->image) { ?>
                        <img src="<?= storage('images', $product->image) ?>"
                             class="img-fluid"
                             alt="<?= e($product->name) ?>">
                    <?php } else { ?>
                        <svg width="400" height="400" xmlns="http://www.w3.org/2000/svg">
                            <rect x="2" y="2" width="396" height="396"
                                  style="fill:#DEDEDE;stroke:#555555;stroke-width:2"></rect>
                        </svg>
                    <?php } ?>
                </a>
            </div>

            <div class="product-name">
                <a href="<?= route('/product?id=' . $product->id) ?>" class="enchance-target">
                    <?= e($product->name) ?>
                </a>
            </div>
        </div>
        <?php
    }

    echo '</div>';
}
