
$(document).ready(function () {
	var navTracker = $('#navTracker').val();
	$('.selected').removeClass("selected");
	$('#' + navTracker).addClass('selected');

	var subNavTracker = $('#subNavTracker').val();
	$('.subSelected').removeClass("subSelected");
	$('#' + subNavTracker).addClass("subSelected");

	$('#ircButton').click(function(){
		if ($('.message').find('iframe').is(':hidden')){
			$('.message').find('iframe').show();
			$('.message').find('iframe').css("display", "block");
		}else{
			$('.message').find('iframe').hide();
		}
		
	});

});