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

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ]);
mix.styles([
        'public/assets/admin/plugins/fontawesome-free/css/all.min.css',
        'public/assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css',
        'public/assets/admin/dist/css/adminlte.min.css',
    ], 'public/css/admin/style.min.css')
    .styles('public/assets/admin/dist/css/backend.css', 'public/css/admin/backend.min.css').version()
    .styles([
        'public/assets/css/normalize.css',
        'public/assets/css/all.min.css',
        'public/assets/css/bootstrap.min.css',
        'public/assets/css/frontend.css',
    ], 'public/css/front/style.min.css')
    .styles('public/assets/css/custom.css', 'public/css/front/frontend.min.css');

if (mix.inProduction()) {
    mix.version();
}
