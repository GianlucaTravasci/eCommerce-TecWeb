let mix = require('laravel-mix');

mix
    .setPublicPath('public')
    .options({processCssUrls: false});

mix
    .copy('resources/assets/images', 'public/images')
    .sass('resources/assets/styles/index.scss', 'public/css/style.css')
    .js('resources/assets/js/index.js', 'public/js/script.js')
    .version();
