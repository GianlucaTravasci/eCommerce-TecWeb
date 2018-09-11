<?xml version = "1.0" encoding = "UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <url>
        <loc><?= $host ?><?= route('/') ?></loc>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>

    <url>
        <loc><?= $host ?><?= route('/login') ?></loc>
        <changefreq>yearly</changefreq>
    </url>
    <url>
        <loc><?= $host ?><?= route('/register') ?></loc>
        <changefreq>yearly</changefreq>
    </url>

    <url>
        <loc><?= $host ?><?= route('/info') ?></loc>
        <changefreq>yearly</changefreq>
        <priority>0.3</priority>
    </url>
    <url>
        <loc><?= $host ?><?= route('/how-to-buy') ?></loc>
        <changefreq>yearly</changefreq>
        <priority>0.3</priority>
    </url>
    <url>
        <loc><?= $host ?><?= route('/faq') ?></loc>
        <changefreq>yearly</changefreq>
        <priority>0.3</priority>
    </url>
    <url>
        <loc><?= $host ?><?= route('/privacy') ?></loc>
        <changefreq>yearly</changefreq>
        <priority>0.3</priority>
    </url>
    <url>
        <loc><?= $host ?><?= route('/sending') ?></loc>
        <changefreq>yearly</changefreq>
        <priority>0.3</priority>
    </url>

    <url>
        <loc><?= $host ?><?= route('/products') ?></loc>
        <changefreq>weekly</changefreq>
    </url>

<?php foreach ($categories as $category) { ?>
    <url>
        <loc><?= $host ?><?= route('/products?category_id=' . $category->id) ?></loc>
        <changefreq>weekly</changefreq>
    </url>
<?php } ?>

<?php foreach ($products as $product) { ?>
    <url>
        <loc><?= $host ?><?= route('/product?id=' . $product->id) ?></loc>
        <changefreq>daily</changefreq>
    </url>
<?php } ?>

</urlset>
