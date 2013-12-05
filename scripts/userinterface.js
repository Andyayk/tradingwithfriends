if (g_useFacebook) {
}
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
