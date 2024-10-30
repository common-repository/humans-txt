<?php
/*
Title: Shortcode
Description: The code for the shortcode page.
Author: Hans Vedo, hans@cultivate.it
2011-01-31: Created
*/

// Security: Ensure the file is accessed by Wordpress.
if(!defined('ABSPATH')){
	return;
}

// 1st: Look for the file itself.
if(file_exists(ABSPATH.'humans.txt')){
	$humanstxt_text = file_get_contents(ABSPATH.'humans.txt');
}else if(get_option('humanstxt_text') != ''){
	// 2nd: Check if settings have already been saved.
	$humanstxt_text = stripslashes(get_option('humanstxt_text'));
}else{
	// 3rd: Lastly just load the template contents.
	$humanstxt_text = file_get_contents(ABSPATH.'wp-content/plugins/humans-txt/template.txt');
}

// Remove the tabs
$humanstxt_text = str_replace(Chr(9),'',$humanstxt_text);

// Turn it into an array;
$humanstxt_rows = explode(Chr(10),$humanstxt_text);
?>