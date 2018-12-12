let mix = require('laravel-mix')

mix.setPublicPath('dist')
mix.setResourceRoot('src')

mix.webpackConfig({
    output: {
        publicPath: 'dist',
    }
})
mix.options({
    extractVueStyles: true,
    processCssUrls: false,
})

mix.js('src/main.js', 'dist/js')
mix.extract(['vue'])
mix.sass('src/scss/app.scss', 'dist/css')
mix.copyDirectory('src/assets', 'dist/assets')

if (mix.inProduction()) {
    mix.version()
} else {
    mix.sourceMaps()
}
