// Loads the jquery package from node_modules
var $ = require('jquery');

// import the function from greet.js (the .js extenxion is optional)
// ./ (or ../)means to look for a local file
var greet = require('./greet');
require('bootstrap-sass');

$(document).ready(function(){
   console.log(greet('Deva'));
});