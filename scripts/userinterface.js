$(document).ready(function(){
	$("#equityButton").click(function(){
		$("#showEquity").slideToggle("slow");
	});
});

$(document).ready(function(){
	$("#purchasingformButton").click(function(){
		$("#showForm").slideToggle("slow");
	});
});

$(document).ready(function(){
	$("#sellingformButton").click(function(){
		$("#showsellForm").slideToggle("slow");
	});
});

$(document).ready(function(){
	$("#portfolioButton").click(function(){
		$("#showPortfolio").slideToggle("slow");
	});
});

$(document).ready(function(){
	$("#historyButton").click(function(){
		$("#showHistory").slideToggle("slow");
	});
});

$(document).ready(function(){
	$("#recommendButton").click(function(){
		FB.ui({
			method: 'apprequests',
			message: 'Join me and start trading together!!'
		});
	});
});

$(document).ready(function(){
	$("#postButton").click(function(){
		FB.ui({
			method: 'feed',
			name: 'Check out my awesome trading skills!!',
			picture: 'https://github.com/Astarcorp/tradingwithfriends/tree/master/images/logo.jpg',
			link: 'https://apps.facebook.com/tradingwithfriends',
			caption: 'I have earned $10000 !! Can you beat me?',
			description: 'Play Trading with Friends to try out real life trading!!',
		}, function(response){
			if (response && response.post_id){
				alert('Post had been published');
			} else {
				alert('Post was not published');
			}
		});
	});
});
