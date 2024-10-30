<?php
/*
Title: Write
Description: The code for the write page.
Author: Hans Vedo, hans@cultivate.it
2011-01-23: Created
*/

// Security: Ensure the file is accessed by Wordpress.
if(!defined('ABSPATH')){
	return;
}

// Settings
$enable_form = true;

// Capture a submitted form.
if(isset($_POST['humanstxt_text'])){
	// Save the content.
	update_option('humanstxt_text',$_POST['humanstxt_text']);
	
	// Return a message
	$humanstxt_message = __('Your humans.txt file has been updated!','humanstxt').' <a href="'.get_bloginfo('url').'/humans.txt">humans.txt</a>';
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

// Warnings
if(file_exists(ABSPATH.'humans.txt')){
	$humanstxt_message = __('A humans.txt file already exists. Please rename it to humans-backup.txt and then use this plugin normally.','humanstxt');
	$enable_form = false;
}

// Get the current theme developer.
$current_theme = get_current_theme();
$all_themes = get_themes();
foreach($all_themes as $theme){
	if($theme['Name'] == $current_theme){
		$theme_details = $theme;
		break;
	}
}

// Select the users.
$all_users = $wpdb->get_results("
	SELECT *
	FROM ".$wpdb->prefix."users
	ORDER BY display_name ASC
");
//var_dump($all_users);

// Get the timezone city.
$timezone_string = get_option('timezone_string');
$timezone_string_parts = explode('/',$timezone_string);
if(count($timezone_string_parts) >= 2){
	$sites_timezone = $timezone_string_parts[(count($timezone_string_parts)-1)];
	
	// Underscores added to the DB.
	$sites_timezone = str_replace('_',' ',$sites_timezone);
}else{
	$sites_timezone = '';
}

// Get the selected language.
if(get_option('humanstxt_lang') != ''){
	$selected_language = get_option('humanstxt_lang');
	
	switch($selected_language){
		case 'de_DE':
			$selected_language = 'Deutsch';
		break;
		case 'auto':
		case 'en_US':
			$selected_language = 'English';
		break;
		case 'es_ES':
			$selected_language = 'Espanol';
		break;
		case 'nb_NO':
			$selected_language = 'Norsk';
		break;
	}
}else{
	$selected_language = 'English';
}
?>