$(document).ready(function(){
	$("#portfolioButton").click(function(){
		$("#showPortfolio").slideToggle("slow");
	});
});

$(document).ready(function(){
	$("#recommendButton").click(function(){
		FB.ui({
			method: 'apprequests',
			message: 'hello you'
		});
	});
});

$(document).ready(function(){
  var auto_refresh = setInterval(
	  function (){
	  $("#showEquity").load("scripts/equity.php");
  }, 60000); //refresh every 60000 milliseconds
});

