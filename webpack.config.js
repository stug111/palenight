const path = require("path"),
	UglifyJSPlugin = require("uglifyjs-webpack-plugin");

module.exports = {
	entry: ["babel-polyfill", "./src/index.js"],
	output: {
		filename: "./build/app.min.js",
		path: path.resolve(__dirname)
	},
	module: {
		rules: [
			{
				test: /\.js$/,
				loader: "babel-loader",
				exclude: /node_modules/
			}
		]
	},
	optimization: {
		minimizer: [
			new UglifyJSPlugin({
				cache: true,
				parallel: true
			})
		]
	}
};
