jQuery(document).ready(function($){
	$(".admin-bar-fold a").on("click", function() {
		$("#wpadminbar").hide();
		$($(this).attr("href")).fadeToggle();
	});
	return false;
});