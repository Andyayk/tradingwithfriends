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
			link: 'https://developers.facebook.com/docs/dialogs/',
			picture: 'http://fbrell.com/f8.jpg',
			caption: 'I have earned ' + $cash + '!! Can you beat me?',
			description: 'Dialogs provide a simple, consistent interface for applications to interface with users.'
		}, function(response) {
		    if (response && response.post_id) {
		    	alert('Post was published.');
		    } else {
		    	alert('Post was not published.');
		    }
		});
	});
});
