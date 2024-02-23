// webpack.mix.js

let mix = require('laravel-mix');
mix.disableSuccessNotifications();

mix.js('resources/js/app.js', 'public/assets/js/')
    .sass('resources/sass/app.scss', 'public/assets/css/');

if (mix.inProduction()) {
    mix.version();
}