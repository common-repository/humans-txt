// jQuery
jQuery(document).ready(function(){
	// Enable the tab key.
	jQuery('#humanstxt_text_field').tabby();
	
	// Make the textarea elastic.
	jQuery('#humanstxt_text_field').elastic();
	
	// Hide any messages after a couple seconds.
	jQuery('#humanstxt_message').delay(2000).fadeOut();
	
	// Hide any lists that don't have any content.
	function hide_suggestions(){
		jQuery('.list-of-suggestions').each(function(){
			number_of_suggestions = jQuery(this).children().length;
			if(number_of_suggestions == 1){
				jQuery(this).hide();
			}
		});	
	}
	hide_suggestions();
	
	// TEAM: Click to add humans.
	jQuery('.click-to-add').click(function(){
		// Get the selected human's details.
		var human_details = jQuery(this).html();
		
		// Turn the HTML into formatted text.
		human_details = '\t'+human_details.replace(/<br>/g,'\r\t');
		human_details = human_details.replace(/<BR>/g,'\r\t');
		
		// Get the value of the current humans.txt content.
		var current_humanstxt = jQuery('#humanstxt_text_field').val();
		
		// Add the selected human at the bottom, just above the SITE details.
		new_humanstxt = current_humanstxt.replace('/* SITE */',human_details+'\r\r/* SITE */');
		
		// Add the new humans.txt content back into the field.
		jQuery('#humanstxt_text_field').val(new_humanstxt);	
		
		// Remove the added item.
		jQuery(this).fadeOut(
			1000
			,function(){
				// Hide entire lists if they're empty.
				hide_suggestions();
			}
		);
		
		// Update the textarea's height accordingly.
		//jQuery('#humanstxt_text_field').elastic().update();
	});
	
	// SITE: Click to add humans.
	jQuery('.click-to-add-site').click(function(){
		// Get the selected human's details.
		var human_details = jQuery(this).html();
		
		// Turn the HTML into formatted text.
		human_details = '\t'+human_details.replace(/<br>/g,'\r\t');
		human_details = human_details.replace(/<BR>/g,'\r\t');
		
		// Get the value of the current humans.txt content.
		var current_humanstxt = jQuery('#humanstxt_text_field').val();
		
		// Add the selected human at the bottom, just above the SITE details.
		new_humanstxt = current_humanstxt.replace('/* SITE */','/* SITE */\r'+human_details);
		
		// Add the new humans.txt content back into the field.
		jQuery('#humanstxt_text_field').val(new_humanstxt);
				
		// Remove the added item.
		jQuery(this).fadeOut(
			1000
			,function(){
				// Hide entire lists if they're empty.
				hide_suggestions();
			}
		);
		
		// Update the textarea's height accordingly.
		jQuery('#humanstxt_text_field').elastic().update();
	});
	
	// TEAM Template: Click to add humans.
	jQuery('.click-to-add-template').click(function(){
		// Get the selected human's details.
		var human_details = jQuery(this).html();
		
		// Turn the HTML into formatted text.
		human_details = '\t'+human_details+'\r\t'+'Twitter: @TwitterName'+'\r\t'+'Website: http://website.com'+'\r\t'+'From: City, Country';
		
		// Get the value of the current humans.txt content.
		var current_humanstxt = jQuery('#humanstxt_text_field').val();
		
		// Add the selected human at the bottom, just above the SITE details.
		new_humanstxt = current_humanstxt.replace('/* SITE */',human_details+'\r\r/* SITE */');
		
		// Add the new humans.txt content back into the field.
		jQuery('#humanstxt_text_field').val(new_humanstxt);
		
		// Update the textarea's height accordingly.
		jQuery('#humanstxt_text_field').elastic().update();
	});
})