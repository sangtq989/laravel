$(function() {
	$('#iconSearch').click(function() {
		let keyword = $('#s').val().trim();
		window.location.href =  "/search?q=" + keyword;
	});
	
});
$(document).on('keypress',function(event){
	if (event.which === 13) {
		let keyword = $('#s').val().trim();
		window.location.href =  "/search?q=" + keyword;
	}
})