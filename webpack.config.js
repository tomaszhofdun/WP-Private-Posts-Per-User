const TerserPlugin = require('terser-webpack-plugin')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
// const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const StyleLintPlugin = require('stylelint-webpack-plugin')
// const ESLintPlugin = require('eslint-webpack-plugin');
const path = require('path')
const globImporter = require('node-sass-glob-importer')
const jsPath = './App/assets/scripts'
const cssPath = './App/assets/styles'
const outputPath = 'App/assets/dist'
const localDomain = 'http://szafirek.local'
const entryPoints = {
    'scripts': jsPath + '/pppu.js',
    'style': cssPath + '/styles.scss'
}

module.exports = {
    entry: entryPoints,
    output: {
        path: path.resolve(__dirname, outputPath),
        filename: '[name].js',
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: '[name].css',
        }),
        new StyleLintPlugin({
            files: './assets/scss/**/*.s?(a|c)ss',
            fix: true,
            quiet: true,
            failOnError: true,
            syntax: 'scss',
        }),

        // new ESLintPlugin({
        //   fix: true,
        // }),

        // Uncomment this if you want to use CSS Live reload
        /*
        new BrowserSyncPlugin({
          proxy: localDomain,
          files: [ outputPath + '/*.css' ],
          injectCss: true,
        }, { reload: false, }),
        */
    ],
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /(node_modules|bower_components)/,
                use: [
                    {
                        loader: 'babel-loader',
                    },
                ],
            },
            {
                test: /\.s?[c]ss$/i,
                exclude: /(node_modules|bower_components)/,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    {
                        loader: 'sass-loader',
                        options: {
                            sourceMap: true,
                            sassOptions: {
                                sourceMap: true,
                                importer: globImporter(),
                            },
                        }
                    }
                ]
            },
            {
                test: /\.sass$/i,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    {
                        loader: 'sass-loader',
                        options: {
                            sassOptions: { indentedSyntax: true }
                        }
                    }
                ]
            },
            {
                test: /\.(jpg|jpeg|png|gif|woff|woff2|eot|ttf|svg)$/i,
                exclude: /(node_modules|bower_components)/,
                use: 'url-loader?limit=1024'
            }
        ]
    },
    optimization: {
        minimize: true,
        minimizer: [
            new TerserPlugin({
                test: /\.js(\?.*)?$/i,
                parallel: true,
                terserOptions: {
                    compress: {
                        drop_console: true
                    },
                    format: {
                        comments: false,
                    },
                },
                extractComments: false,
            }),
        ]
    },
}
