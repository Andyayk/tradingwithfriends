$(document).ready(function(){
	$("#equityButton").click(function(){
		$("#showEquity").slideToggle("slow");
		alert("Please choose your desired Equity")
	});
});

$(document).ready(function(){
	$("#portfolioButton").click(function(){
		$("#showPortfolio").slideToggle("slow");
		alert("My Portfolio");
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
		}, 1000); //refresh every 1000 milliseconds

