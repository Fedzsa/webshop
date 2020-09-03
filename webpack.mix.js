const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/admin.scss', 'public/css')
    .sass('resources/sass/image.scss', 'public/css');

mix.scripts([
    'resources/js/header.js',,
    'resources/js/itemDeletion/itemRemover.js',
    'resources/js/itemDeletion/tableItemRemover.js',
    'resources/js/itemDeletion/categoryRemover.js',
    'resources/js/category.js'
], 'public/js/category.js')
.scripts([
    'resources/js/header.js',
    'resources/js/itemDeletion/itemRemover.js',
    'resources/js/itemDeletion/tableItemRemover.js',
    'resources/js/itemDeletion/productRemover.js',
    'resources/js/itemDeletion/productSpecificationRemover.js',
    'resources/js/itemDeletion/imageRemover.js',
    'resources/js/product.js',
    'resources/js/productSpecification.js',
    'resources/js/image.js'
], 'public/js/product.js')
.scripts([
    'resources/js/header.js',
    'resources/js/itemDeletion/itemRemover.js',
    'resources/js/itemDeletion/tableItemRemover.js',
    'resources/js/itemDeletion/specificationRemover.js',
    'resources/js/specification.js'
], 'public/js/specification.js')
.scripts([
    'resources/js/header.js',
    'resources/js/notification.js'
], 'public/js/notification.js')
.scripts('resources/js/navigate.js', 'public/js/navigate.js');
