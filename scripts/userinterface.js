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
			link: 'https://apps.facebook.com/tradingwithfriends',
			caption: 'I have earned my pot of gold!! Can you beat me?',
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

$(document).ready(function(){
	$("#websiteButton").click(function(){
		var win=window.open('http://astarweb.cloudcontrolled.com/','_blank');
		win.focus();
	});
})

$(document).ready(function(){
	$("#forumButton").click(function(){
		var win=window.open('http://tradingwithfriends.forumotion.com/','_blank');
		win.focus();
	});
})

$(document).ready(function(){
	$("#scoreButton").click(function(){
		$("#showScore").slideToggle("slow");
	});
});