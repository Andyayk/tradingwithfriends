$(document).ready(function(){
	$("#equityButton").click(function(){
		$("#showEquity").slideToggle("slow");
	});
});

$(document).ready(function(){
	$("#portfolioButton").click(function(){
		$("#showPortfolio").slideToggle("slow");
		alert("hello");
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

var auto_refresh = setInterval(
		function ()
		{
			$("#showEquity").load("equity.php").fadeIn("slow");
		}, 10000); //refresh every 10000 milliseconds

