<?php
/*
Title: Settings
Description: The code for the page.
Author: Hans Vedo, hans@cultivate.it
2011-01-31: Created
*/

// Security: Ensure the file is accessed by Wordpress.
if(!defined('ABSPATH')){
	return;
}

// Return a message to the user.
if(isset($_POST['humanstxt_lang'])){
	$humanstxt_message = __('Your language settings have been successfully updated.','humanstxt');
}

// Set the language
// The language is actually saved in the plugin file so it updates before the plugin inits.
if(get_option('humanstxt_lang') != ''){
	$selected_language = get_option('humanstxt_lang');
}else{
	$selected_language = 'auto';
}
?>