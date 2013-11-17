$(document).ready(function(){
	$("#equityButton").click(function(){
		$("#showEquity").slideToggle("slow");
	});
});

function refresh_handler() {
		 function refresh() {
		$.get("index.php", null, function(data, textStatus) {
  $("showEquity").html(data);
});
}
setInterval(refresh, 1*1000); //refresh every 1 second
}

$(document).ready(refresh_handler);

$("#menuDemo > ul > li").hover(function() {
	//effect when the user hovers over the menu
	//first hide the menu item, since the CSS displays it - then slide it down.
   	$(this).children("ul").hide().slideDown();
}, function() {
	//effect when the user leaves the current menu area - fade out
	$(this).children("ul").fadeOut();
});

$(document).ready(function(){
    $("#customAccordion").accordion({
  		collapsible: true,
  	    active: false,
  	    heightStyle: "content"
  	});
    }); 

