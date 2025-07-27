const mix = require('laravel-mix');
require('laravel-mix-tailwind');

mix.postCss('resources/css/app.css', 'public/css', [
    require('tailwindcss'),
    require('autoprefixer'),
]);
