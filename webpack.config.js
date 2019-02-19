const path = require("path"),
	UglifyJSPlugin = require("uglifyjs-webpack-plugin"),
	MiniCssExtractPlugin = require("mini-css-extract-plugin"),
	OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin");

module.exports = {
	entry: [
		"./src/index.js",
		"./src/sass/style.scss"
		// "./src/sass/woocommerce.scss"
	],
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
			},
			{
				test: /\.(sass|scss)$/,
				use: [MiniCssExtractPlugin.loader, "css-loader", "sass-loader"]
			}
		]
	},
	plugins: [
		new MiniCssExtractPlugin({
			filename: "./style.css"
		})
	],
	optimization: {
		minimizer: [
			new UglifyJSPlugin({
				cache: true,
				parallel: true
			}),
			new OptimizeCSSAssetsPlugin({})
		]
	}
};
