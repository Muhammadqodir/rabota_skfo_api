const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/scripts.js', 'public/js')
    .js('resources/js/utils.js', 'public/js')
    .js('resources/js/cabinet.js', 'public/js')
    .js('resources/js/dynamicforms.js', 'public/js')
    .js('resources/js/createresume.js', 'public/js')
    .js('resources/js/createvacancy.js', 'public/js')
    .js('resources/js/profile.js', 'public/js')
    .js('resources/js/autocompleteInput.js', 'public/js')
    .js('resources/js/masks.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css')
    .postCss('resources/css/fonts.css', 'public/css');