module.exports = {
  
module: {
  rules: [
    {
      test: /\.scss$/,
      loaders: ['style-loader', 'css-loader', 'sass-loader', 
      'postcss-loader']
    }
  ]
},
  plugins: {
        // include whatever plugins you want
        // but make sure you install these via yarn or npm!
    new: webpack.LoaderOptionsPlugin({
    options: {
        postcss: [
          autoprefixer(),
        ]
      }
    })
  }
};