
const mix = require('laravel-mix');

mix.js('resources/views/back/volcator/assets/vue/main.js', 'resources/views/back/volcator/assets/vue/dist/js/app.js')
    .vue();
