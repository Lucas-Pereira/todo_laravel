const path = require('path');

module.exports = {
  mode: 'development',
  entry: 'resource/js/main',
  output: {
    filename: 'main.js',
    path: path.resolve(__dirname, 'dist'),
  },
};
