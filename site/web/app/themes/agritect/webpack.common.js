const path              = require('path')
const webpack           = require('webpack')
const ManifestPlugin    = require('webpack-manifest-plugin')
const postcssPresetEnv  = require('postcss-preset-env')

module.exports = function (env) {
  const stylesheetLoaders = [
    // {
    //   loader: require.resolve('style-loader'),
    //   options: {
    //     singleton: true,
    //   },
    // },
    {
      loader:  require.resolve('css-loader'),
      options: {
        sourceMap: true,
      },
    },
    {
      loader:  require.resolve('postcss-loader'),
      options: {
        ident:   'postcss',
        plugins: () => [
          postcssPresetEnv(),
        ],
      },
    },
  ]

  // TODO: fix this for local dev:
  // if (mode === 'production') {
      stylesheetLoaders.unshift(
          {
            loader: 'file-loader',
            options: { name: 'main-[hash].css' },
          },
          'extract-loader',
      )
  // } else {
  //     loaders.unshift('style-loader');
  // }

  return {
    mode:    env,
    devtool: 'cheap-module-eval-source-map',
    context: path.resolve('./assets/src'),

    entry: {
      index: ['@babel/polyfill', 'regenerator-runtime/runtime', './index.js'],
    },

    output: {
      filename:      '[name]-[chunkhash].js',
      chunkFilename: '[name]-[chunkhash].js',
    },

    module: {
      rules: [
        {
          resource: {
            test: /\.(js|jsx|tsx?)$/,
            or:   [
              { exclude: path.resolve('./node_modules') },
            ],
          },
          use: [{
            loader:  'babel-loader'
          }],
        },
        {
          test: /\.css$/,
          use:  stylesheetLoaders,
        },
        {
          test: /\.scss$/,
          use:  [
            ...stylesheetLoaders,
            {
              loader:  require.resolve('sass-loader'),
              options: {
                sourceMap: true,
              },
            },
          ],
        },
        {
          test: /\.(png|jp(e*)g|svg|gif|ico)$/,
          use: [{
            loader: require.resolve('url-loader'),
            options: {
              limit: 25000,
              name: 'images/[hash]-[name].[ext]'
            }
          }]
        },
        {
          test: /\.(woff|eot|ttf)$/,
          use: [{
            loader: require.resolve('url-loader'),
            options: {
              limit: 25000,
              name: 'fonts/[hash]-[name].[ext]'
            }
          }]
        }
      ],
    },

    resolve: {
      extensions: ['.mjs', '.js', '.jsx', '.ts', '.tsx'],

      alias: {
        '@': path.resolve('./src'),
      },

      modules: [
        path.resolve('./src'),
        path.resolve('./node_modules'),
      ],
    },

    plugins: [
      new ManifestPlugin({
        writeToFileEmit: true,
      }),

      new webpack.DefinePlugin({
        'process.env.NODE_ENV': JSON.stringify(env),
      }),
    ],
  }
}
