//Create Menu
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

  // Trade Button
  var tradeButton = document.createElement('div');
  tradeButton.className = 'menu_item';
  tradeButton.id = 'trade_button';
  tradeButton.style.top = "188px";
  tradeButton.style.left = "0px";
  tradeButton.style.zIndex = "10";
  tradeButton.setAttribute('onclick', 'javascript:startGame(null, null)');
  tradeButton.style.backgroundImage = "url('images/button_play.png')";
  menuContainer.appendChild(tradeButton);

  var tradeButtonHover = document.createElement('div');
  tradeButtonHover.className = 'menu_item';
  tradeButtonHover.style.top = "188px";
  tradeButtonHover.style.left = "0px";
  tradeButtonHover.style.backgroundImage = "url('images/button_play_hot.png')";
  menuContainer.appendChild(playButtonHover);

  $("#trade_button").hover (
    function() {
      $(this).stop().animate({"opacity": "0"}, "slow");
    },
    function() {
      $(this).stop().animate({"opacity": "1"}, "slow");
    }
  );

  if (g_useFacebook) {
    
  } else {
    welcomePlayer(null);
  } 
}
//Welcome Player
function welcomePlayer(uid) {
    console.log("Welcoming player");
    var welcomeMsgContainer = document.createElement('div');
    welcomeMsgContainer.id = 'welcome_msg_container';
    stage.appendChild(welcomeMsgContainer);

    if (g_useFacebook) {
      FB.api('/me?fields=first_name', function(response) {
          var welcomeMsg = document.createElement('div');
          var welcomeMsgStr = 'Welcome, ' + response.first_name + '!';
          welcomeMsg.innerHTML = welcomeMsgStr;
          welcomeMsg.id = 'welcome_msg';
          welcomeMsgContainer.appendChild(welcomeMsg);

          var imageURL = 'https://graph.facebook.com/' + uid + '/picture?width=256&height=256';
          var profileImage = document.createElement('img');
          profileImage.setAttribute('src', imageURL);
          profileImage.id = 'welcome_img';
          profileImage.setAttribute('height', '148px');
          profileImage.setAttribute('width', '148px');
          welcomeMsgContainer.appendChild(profileImage);
      });

      gPlayerBombs = 5;
      gPlayerLives = 5;
      gPlayerCoins = 100;
          
      $('.player_bombs').html(gPlayerBombs);
      $('.player_lives').html(gPlayerLives);
      $('.player_coins').html(gPlayerCoins);

      var coinsDisplay = document.createElement('div');
      coinsDisplay.className  = 'stats_display';
      coinsDisplay.style.top  = '100px';
      coinsDisplay.style.left = '180px';
      welcomeMsgContainer.appendChild(coinsDisplay);
      
      var coinsIcon = document.createElement('img');
      coinsIcon.setAttribute('src', 'images/coin40.png');
      coinsDisplay.appendChild(coinsIcon);
      
      var coinsNumber = document.createElement('span');
      coinsNumber.className   = 'player_coins';
      coinsNumber.innerHTML   = gPlayerCoins;
      coinsDisplay.appendChild(coinsNumber);
      
      var bombsDisplay = document.createElement('div');
      bombsDisplay.className  = 'stats_display';
      bombsDisplay.style.top  = '100px';
      bombsDisplay.style.left = '270px';
      welcomeMsgContainer.appendChild(bombsDisplay);
      
      var bombsIcon = document.createElement('img');
      bombsIcon.setAttribute('src', 'images/bomb40.png');
      bombsDisplay.appendChild(bombsIcon);
      
      var bombsNumber = document.createElement('span');
      bombsNumber.className   = 'player_bombs';
      bombsNumber.innerHTML   = gPlayerBombs;
      bombsDisplay.appendChild(bombsNumber);
      
      var livesDisplay = document.createElement('div');
      livesDisplay.className  = 'stats_display';
      livesDisplay.style.top  = '100px';
      livesDisplay.style.left = '360px';
      welcomeMsgContainer.appendChild(livesDisplay);
      
      var livesIcon = document.createElement('img');
      livesIcon.setAttribute('src', 'images/heart40.png');
      livesDisplay.appendChild(livesIcon);
      
      var livesNumber = document.createElement('span');
      livesNumber.className   = 'player_lives';
      livesNumber.innerHTML   = gPlayerLives;
      livesDisplay.appendChild(livesNumber);
      
    } else {
          var welcomeMsg = document.createElement('div');
          var welcomeMsgStr = 'Welcome, Player!';
          welcomeMsg.innerHTML = welcomeMsgStr;
          welcomeMsg.id = 'welcome_msg';
          welcomeMsgContainer.appendChild(welcomeMsg);
    }
    
    var welcomeSubMsg = document.createElement('div');
    welcomeSubMsg.innerHTML = 'Start Trading Now!!';
    welcomeSubMsg.id = 'welcome_submsg';
    welcomeMsgContainer.appendChild(welcomeSubMsg);
  }
//Display Menu
function displayMenu(display) {
	  if (display == true) {

	    if (!document.getElementById('welcome_msg_container')) {
	      welcomePlayer(gPlayerFBID);
	    }
	    else {
	      document.getElementById('welcome_msg_container').style.display = 'block';
	    }

	    document.getElementById('menu_container').style.display = 'block';
	    
	    document.getElementById('menu_shim').style.display = 'block';
	    
	    if (document.getElementById('ingame_scoreText')) {
	      document.getElementById('ingame_scoreText').style.display = 'none';
	    }
	    if (document.getElementById('ingame_smashText')) {
	      document.getElementById('ingame_smashText').style.display = 'none';
	    }

	    for (var j=0; j<gLifeImages.length; j++) {
	          gLifeImages[j].style.display = 'none';
	    }

	    for (var j=0; j<gBombImages.length; j++) {
	          gBombImages[j].style.display = 'none';
	    }    

	    if (g_useFacebook) {
	      showScores();
	    }
	  }
	  else {
	    
	    if (document.getElementById('menu_container')) {
	      document.getElementById('menu_container').style.display = 'none';
	    }

	    if (document.getElementById('welcome_msg_container')) {
	      document.getElementById('welcome_msg_container').style.display = 'none';  
	    }


	    document.getElementById('menu_shim').style.display = 'none';

	    $("#scoreboard_container").detach();

	    if (document.getElementById('ingame_scoreText')) {
	      document.getElementById('ingame_scoreText').style.display = 'block';
	    }
	    if (document.getElementById('ingame_smashText')) {
	      document.getElementById('ingame_smashText').style.display = 'block';
	    }
	  }
	}
//Start Game
function startGame(fbid, name) {
    initGame(fbid, name, Math.min(3, gPlayerBombs));
    displayMenu(false, true);
}