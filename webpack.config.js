const { VueLoaderPlugin } = require("vue-loader");
const path = require("path");


module.exports = {
    mode: 'development',
    entry: {
        main: [
            __dirname + "/js/main.js",
        ]
    },
    output: {
        path: __dirname + "/public",
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: "babel-loader",
                },
            },
            {
                test: /\.vue$/,
                loader: "vue-loader",
            },
        ],
    },
    plugins: [
        new VueLoaderPlugin(),
    ],
    resolve: {
        alias: {
            vue$: "vue/dist/vue.runtime.esm.js",
        },
        extensions: ["*", ".js", ".vue", ".json"],
    },
};