const path                = require('path')
const merge               = require('webpack-merge')
const webpack             = require('webpack')
const commonConfig        = require('./webpack.common.js')
const nodePackage         = require(path.resolve('./package.json'))

const PORT = 18080

module.exports = async function () {
    return merge(commonConfig('development'), {
        devtool: 'cheap-module-eval-source-map',

        output: {
            publicPath: `http://localhost:${PORT}/`,
        },

        devServer: {
      disableHostCheck:   true,
            historyApiFallback: true,
            port:               PORT,

      headers: {
        'Access-Control-Allow-Origin': '*',
      },
        },
    })
}
