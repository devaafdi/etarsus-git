var Encore = require('@symfony/webpack-encore');

Encore
    // the project directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')
    // will create public/build/app.js and public/build/app.css
    .addEntry('app', './assets/js/app.js')
    .addEntry('collectionform', './assets/js/collectionForm.js')

    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    // uncomment to create hashed filenames (e.g. app.abc123.css)
    // .enableVersioning(Encore.isProduction())

    // uncomment to define the assets of the project
    // .addEntry('js/app', './assets/js/app.js')
    .addStyleEntry('style', './assets/css/style.css')

    // uncomment if you use Sass/SCSS files
    .enableSassLoader()
    // .enableSassLoader(function(sassOptions) {}, {
    //     resolveUrlLoader: false
    // })

    .enableSourceMaps(!Encore.isProduction())

    // uncomment for legacy applications that require $/jQuery as a global variable
    .autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();