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

$("document").ready(function(){
	var interval = setInterval(refresh_box(), 1000);
	function refresh_box(){
		$("#showEquity").load("scripts/equity.php");
	};
});
