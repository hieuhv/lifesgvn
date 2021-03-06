﻿/** Author InkThemes ***/
jQuery('document').ready(function($){
	var commentform = $('#commentform'); // find the comment form
	commentform.prepend('<div id="comment-status" ></div>'); // add info panel before the form to provide feedback or errors
	var statusdiv=$('#comment-status'); // define the info panel
	var list ;
	$('a.comment-reply-link').click(function(){
		list = $(this).parent().parent().parent().attr('id');
	});

	commentform.submit(function(){
		//serialize and store form data in a variable
		var formdata = commentform.serialize();
		//Add a status message
		statusdiv.html('<p>Đang tải...</p>');
		//Extract action URL from commentform
		var formurl = commentform.attr('action');
		//Post Form with data

		$.ajax({
			type: 'post',
			url: formurl,
			data: formdata,
			error: function(XMLHttpRequest, textStatus, errorThrown){
				statusdiv.html('<p class="ajax-error" >You might have left one of the fields blank, or be posting too quickly</p>');
			},
			success: function(data, textStatus){
				if(data == "success" || textStatus == "success"){
					statusdiv.html('<p class="ajax-success" >Cảm ơn thảo luận của bạn. Chúng tôi sẽ xem xét trong giây lát.</p>');
					if($(".comments").has(".comment").length > 0){
						if(list != null){
							$('div.rounded').prepend(data);
						} else {
							$(data).insertBefore('.comment:first-child');
						}
					} else{
						$(".comments").append(data);
					}
				} else{
					statusdiv.html('<p class="ajax-error" >Please wait a while before posting your next comment</p>');
					commentform.find('textarea[name=comment]').val('');
				}
			}
		});
		
		return false;
	});
});

function replyComment(){
	alert('ABC');
}