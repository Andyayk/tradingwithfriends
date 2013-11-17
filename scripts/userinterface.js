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
			  var challengeData = {"challenge_score" : gScore};

			  if (gScore) {
			    FB.ui({method: 'apprequests',
			      title: 'Friend Smash Challenge!',
			      message: 'I just smashed ' + gScore + ' friends! Can you beat it?',
			      data: challengeData
			    }, fbCallback);
			  }
			  else {
			    FB.ui({method: 'apprequests',
			      title: 'Play Friend Smash with me!',
			      message: 'Andyayk Rocks, come check that out!!!',
			    }, fbCallback);
			  }
			}
	});
});

