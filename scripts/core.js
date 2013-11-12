var g_useFacebook = true;
var g_api_url     = "https://obscure-lake-4602.herokuapp.com";
var g_init        = false;
var stage;

window.onload = function () {
  
  setTimeout(function () {
    gCanvasWidth = parseInt(stage.style.width);
    gCanvasHeight = parseInt(stage.style.height);

    var gameboard = document.getElementById('gameboard');
    gameboard.style.width = gCanvasWidth + 'px';
    gameboard.style.height = gCanvasHeight + 'px';

  }, 10);
  
  setTimeout(function () {
    window.scrollTo(0, 1);
  }, 500);
  
  setTimeout(function () {
     init();
   }, 1000)
  
  stage = document.getElementById('stage');

  // Set the dimensions to the match the client
  stage.style.width = '940px';
  stage.style.height = '570px';
  
}

function init() {
  createMenu();
}

function BlockMove(event) {
  // Tell Safari not to move the window.
  event.preventDefault() ;
}
