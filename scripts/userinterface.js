$(document).ready(function(){
	$("#flip").click(function(){
		$("#panel").slideToggle("slow");
	});
});

$("#equityButton").click(function(){
	$("#showEquity").slideToggle('slow');
});

function refresh_handler() {
		 function refresh() {
		$.get('index.php', null, function(data, textStatus) {
  $("panel").html(data);
});
}
setInterval(refresh, 1*1000); //every 5 minutes
}

$(document).ready(refresh_handler);
