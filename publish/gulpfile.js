var elixir = require('laravel-elixir');

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

elixir(function(mix) {
    mix.less('app.less');
});

elixir(function(mix) {
    mix.copy('node_modules/photoswipe/dist/photoswipe.css', 'public/css/photoswipe/photoswipe.css')
        .copy('node_modules/photoswipe/dist/default-skin/default-skin.css', 'public/css/photoswipe/default-skin.css')
        .copy('node_modules/photoswipe/dist/default-skin/default-skin.png', 'public/css/photoswipe/default-skin.png')
        .copy('node_modules/photoswipe/dist/photoswipe.min.js', 'public/js/photoswipe/photoswipe.min.js')
        .copy('node_modules/photoswipe/dist/photoswipe-ui-default.min.js', 'public/js/photoswipe/photoswipe-ui-default.min.js');
});

elixir(function(mix) {
    mix.copy('node_modules/fotorama/', 'public/js/fotorama/');
});

elixir(function(mix) {
    mix.copy('node_modules/bootstrap/fonts', 'public/fonts/');
});

elixir(function(mix) {
    mix.copy('node_modules/time-to/jquery.time-to.min.js', 'public/js/time-to/')
        .copy('node_modules/time-to/timeTo.css', 'public/js/time-to/');
});

elixir(function(mix) {
    mix.copy('node_modules/lazyload/jquery.lazyload.min.js', 'public/js/');
});

elixir(function(mix) {
    mix.copy('resources/assets/js/lara_box/', 'public/js');
});

elixir(function(mix) {
    mix.copy('node_modules/jquery/dist/jquery.min.js', 'resources/assets/js/')
        .copy('node_modules/bootstrap/dist/js/bootstrap.min.js', 'resources/assets/js/');
});


elixir(function(mix) {
    mix.scripts([
        "jquery.min.js",
        "bootstrap.min.js",
        "lara_box/metrika.js",
        "app.js"
    ]);
});
