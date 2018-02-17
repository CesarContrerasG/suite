const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
    mix.sass('app.scss', '../dist/css/app.css');
    mix.sass('sentry.scss', '../dist/css/sentry.css');
    mix.sass('enterprise.scss', '../dist/css/enterprise.css');
    mix.sass('web.scss', '../dist/css/web.css');
});