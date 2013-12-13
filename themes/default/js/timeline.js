$(document).ready(function(){
						   
	$('#inputField').bind("blur focus keydown keypress keyup", function(){recount();});
	$('input.submitButton').attr('disabled','disabled');
	
	$('#tweetForm').submit(function(e){
	
		tweet();
		e.preventDefault();
	
	});
	
});


function recount()
{
	var maxlen=140;
	var current = maxlen-$('#inputField').val().length;
	$('.counter').html(current);
	
		
	if(current<0 || current==maxlen)
	{
		$('.counter').css('color','#D40D12');
		$('input.submitButton').attr('disabled','disabled').addClass('inact');
	}
	else
		$('input.submitButton').removeAttr('disabled').removeClass('inact');

	
	if(current<10)
		$('.counter').css('color','#D40D12');
	
	else if(current<20)
		$('.counter').css('color','#5C0002');

	else
		$('.counter').css('color','#cccccc');
	
}

function tweet()
{
	var submitData = $('#tweetForm').serialize();
	
	$('.counter').html('<img src="http://localhost/isvipi/themes/default/images/ajax_load.gif" width="16" height="16" style="padding:12px" alt="loading" />');
	
	$.ajax({
		type: "POST",
		url: "http://localhost/isvipi/lib/core/user_timeline.php",
		data: submitData,
		dataType: "html",
		success: function(msg){
			
			if(parseInt(msg)!=0)
			{
				$('ul.statuses li:first-child').before(msg);
				$("ul.statuses:empty").append(msg);
				
				$('#lastTweet').html($('#inputField').val());
				
				$('#inputField').val('');
				recount();
			}
		}
		
	});

}