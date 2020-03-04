const merge                = require('webpack-merge')
// const CleanWebpackPlugin   = require('clean-webpack-plugin')
const commonConfig         = require('./webpack.common.js')
const projectRootPath      = process.cwd()

module.exports = function() {
	return merge(commonConfig('production'), {
		devtool: 'cheap-source-map',

		output: {
			publicPath: 'https://staging.design.agritecture.com/app/themes/agritect/dist/',
		},

		// plugins: [
		// 	new CleanWebpackPlugin(['dist'], { root: projectRootPath }),
		// ]
	})
}
