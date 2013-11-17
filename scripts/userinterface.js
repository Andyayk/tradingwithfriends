$(document).ready(function(){
	$("#equityButton").click(function(){
		$("#showEquity").slideToggle("slow");
	});
});

$("#menuDemo > ul > li").hover(function() {
	//effect when the user hovers over the menu
	//first hide the menu item, since the CSS displays it - then slide it down.
   	$(this).children("ul").hide().slideDown();
}, function() {
	//effect when the user leaves the current menu area - fade out
	$(this).children("ul").fadeOut();
});

