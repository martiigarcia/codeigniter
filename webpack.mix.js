let mix = require('laravel-mix');

mix
    .js('resources/scripts/siqtheme.js', 'js')
    .sass('resources/sass/siqtheme.scss', 'css')
    .setPublicPath('public');