'use strict';

console.log('js file is connected');

// let userName = prompt('You\'ve reached the Odyssey Children\'s Theatre website.  Could we have your name?');

// while (!userName) {
//   userName = prompt ('Please enter your name.');
// };

// alert('Welcome ' + userName + ', thankyou for visiting!');


// Source code for slide show
// https://codepen.io/danielguillan/pen/kNjzLM

var current = 0,
    slides = document.getElementsByTagName("img");

setInterval(function() {
  for (var i = 0; i < slides.length; i++) {
    slides[i].style.opacity = 0;
  }
  current = (current != slides.length - 1) ? current + 1 : 0;
  slides[current].style.opacity = 1;
}, 4000);