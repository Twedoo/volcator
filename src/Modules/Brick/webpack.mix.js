const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('Views/Vue/main.js', './Media/dist/build.js')
    .postCss('Views/Vue/Assets/app.css', './Media/dist/assets/app.css', [
        [require("tailwindcss")]
    ]).vue();
