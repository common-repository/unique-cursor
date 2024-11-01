	jQuery(document).ready(function(){
		//onoff buttons
		jQuery('.onoff button').click(function(){
			if(!jQuery(this).hasClass("active")){
				if(jQuery(this).hasClass("btn-on")){
					jQuery(this).addClass("btn-success")
					jQuery(this).parent().find(".btn-off").removeClass("btn-danger");
			 		jQuery("input[name='enabled']" ).val(1);
				}
				if(jQuery(this).hasClass("btn-off")){
					jQuery(this).addClass("btn-danger")
					jQuery(this).parent().find(".btn-on").removeClass("btn-success");
					jQuery("input[name='enabled']" ).val(0);
				}
			}
		})
		
		jQuery('.cursors button').mouseover(function(){
			if(jQuery(this).attr('data-value') == 'locked'){
				jQuery("#unlock-frame").css('top',jQuery(this).position().top+"px")
				jQuery("#unlock-frame").css('left',jQuery(this).position().left+"px")
			}
		});
		
		jQuery('.cursors button').click(function(){
			if(!jQuery(this).hasClass("active") && jQuery(this).attr('data-value') != 'locked'){
			 jQuery("input[name='cursor']" ).val(jQuery(this).find('img').attr('src'));
			 jQuery("input[name='cursor_id']" ).val(jQuery(this).attr('data-value'));
			}
		})
	})