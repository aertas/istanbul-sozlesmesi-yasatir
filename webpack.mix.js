const mix = require('laravel-mix');
let productionSourceMaps = true;

mix
    .sass('resources/sass/app.scss', 'public/assets/css')
    .options({
        //processCssUrls: false,
        fileLoaderDirs: {
            images: 'assets/img',
            fonts: 'assets/fonts'
        }
    })
    .js('resources/js/app.js', 'public/assets/js')
    .js('resources/js/site.js', 'public/assets/js')
    .scripts([
        'resources/js/croppic.js',
        //'node_modules/xxx/yyyy.js',
    ], 'public/assets/js/vendor.js')
    .sourceMaps(productionSourceMaps, 'source-map')
    .version()
//.sourceMaps()
;
