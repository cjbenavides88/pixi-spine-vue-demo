const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
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


// webpack.mix.js
mix.js("resources/js/app.js", "public/js").vue()
    .postCss("resources/css/app.css", "public/css", [
        require("tailwindcss")('tailwind.config.js'),
        require('autoprefixer'),
    ])
    .copy('resources/images', 'public/images')
    .copy('resources/cgi', 'public/cgi')
    .version()
;
