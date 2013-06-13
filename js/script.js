/* ===================================================================
RooRunner.com
Author: Vaughn D. Taylor
June 13, 2013
=================================================================== */

$(document).ready(function() {

	var wrapper = $('<div/>').css({height:0,width:0,'overflow':'hidden'});
	var fileInput = $(':file').wrap(wrapper);

	fileInput.change(function(){
		$this = $(this);
		$('#profile-pic').text("File attached");
	})

	$('#profile-pic').click(function(){
		fileInput.click();
	}).show();

});