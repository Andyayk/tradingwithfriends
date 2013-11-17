$(document).ready(function(){
	$("#equityButton").click(function(){
		$("#showEquity").slideToggle("slow");
	});
});

$(document).ready(function(){
	$("#portfolioButton").click(function(){
		$("#showPortfolio").slideToggle("slow");
	});
});

$(document).ready(function(){
	$("#RecommendButton").click(function(){
		
	});
});

var tradeButton = document.createElement('div');
tradeButton.className = 'menu_item';
tradeButton.id = 'trade_button';
tradeButton.style.top = "188px";
tradeButton.style.left = "0px";
tradeButton.style.zIndex = "10";
tradeButton.setAttribute('onclick', 'javascript:startGame()');
tradeButton.style.backgroundImage = "url('images/button_trade.png')";
menuContainer.appendChild(tradeButton);

//Highlight the Trade Button when Hovered
var tradeButtonHover = document.createElement('div');
tradeButtonHover.className = 'menu_item';
tradeButtonHover.style.top = "188px";
tradeButtonHover.style.left = "0px";
tradeButtonHover.style.backgroundImage = "url('images/button_trade_hot.png')";
menuContainer.appendChild(tradeButtonHover);

$("#trade_button").hover (
  function() {
    $(this).stop().animate({"opacity": "0"}, "slow");
  },
  function() {
    $(this).stop().animate({"opacity": "1"}, "slow");
  }
);
