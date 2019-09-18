let webpack = require('webpack');
let path = require('path');

module.exports = {
    entry: [
        './backend/assets/src/commerce.js'
    ],
    output: {
        path: "/backend/assets/dist/js",
        publicPath: "/dist/",
        filename: "commerce.js"
    },
    watch: true,
    module: {
        loaders: [
            {
                test: /\.vue$/,
                loader: 'vue'
            },
            {
                test: /\.js$/,
                loader: 'babel',
                // exclude: /node_modules|@ckeditor\//
                include: [
                    path.resolve(__dirname, 'backend/assets/src'),
                ]
            },
            {
                test: /\.scss$/,
                loaders: ['style', 'css', 'sass'],
            }
        ]
    },
    babel: {
        presets: ['es2015'],
        plugins: ['transform-runtime']
    },
    resolve: {
        modulesDirectories: ['node_modules'],
        alias: {
            'vue$': 'vue/dist/vue.common.js'
        }
    },
    // plugins: [
    //     new webpack.ProvidePlugin({
    //         $: "jquery",
    //         jQuery: "jquery",
    //         "window.jQuery": "jquery"
    //     })
    // ],
    externals: {
        vue: "Vue",
        $: "jquery",
        // jQuery: "jquery",
        // "window.jQuery": "jquery"
    }
}
