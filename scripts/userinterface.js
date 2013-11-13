function createMenu() {
  var menuShim = document.createElement('div');
  menuShim.id = 'menu_shim';

  menuShim.style.width = gCanvasWidth + "px";
  menuShim.style.height = gCanvasHeight + "px";
  stage.appendChild(menuShim);

  var menuContainer = document.createElement('div');
  menuContainer.id = 'menu_container';
  stage.appendChild(menuContainer);
  menuContainer.style.width = stage.style.width;
  menuContainer.style.height = stage.style.height;

  /* Play Button */
  var playButton = document.createElement('div');
  playButton.className = 'menu_item';
  playButton.id = 'play_button';
  playButton.style.top = "188px";
  playButton.style.left = "0px";
  playButton.style.zIndex = "10";
  playButton.setAttribute('onclick', 'javascript:startGame(null, null)');
  playButton.style.backgroundImage = "url('images/button_play.png')";
  menuContainer.appendChild(playButton);

  var playButtonHover = document.createElement('div');
  playButtonHover.className = 'menu_item';
  playButtonHover.style.top = "188px";
  playButtonHover.style.left = "0px";
  playButtonHover.style.backgroundImage = "url('images/button_play_hot.png')";
  menuContainer.appendChild(playButtonHover);

  $("#play_button").hover (
    function() {
      $(this).stop().animate({"opacity": "0"}, "slow");
    },
    function() {
      $(this).stop().animate({"opacity": "1"}, "slow");
    }
  );
}