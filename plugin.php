<?php
/*
Plugin Name: Humans.txt
Version: 1.2
Plugin URI: http://cultivate.it/apps/humans-txt-wordpress-plugin/
Description: A plugin to create a humans.txt file that credits the developers and designers of a website.
Author: Hans Vedo
Author URI: http://cultivate.it/
Text Domain: humanstxt
Domain Path: /lang
*/

/*
Copyright 2011  Hans Vedo  (email : hans@cultivate.it)

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

// Settings
define('humanstxt_version','1.2');

// Install the plugin
register_activation_hook(__FILE__,'humanstxt_install');
function humanstxt_install(){
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
	
	// Save the default humans.txt
	update_option('humanstxt_text',$humanstxt_text);
	
	// Auto detect the language.
	update_option('humanstxt_lang','auto');
}

// Hook into Wordpress
add_action('admin_menu','humanstxt_settings');
function humanstxt_settings(){
	add_options_page('Humans.txt','Humans.txt', 'manage_options','humans-txt', 'humanstxt_settings_page');
}

// Create the page.
function humanstxt_settings_page(){
	global $wpdb;
	
	// Include the selected code/html pages.
	if(isset($_GET['request'])){
		$page_request = $_GET['request'];
	}else{
		$page_request = 'write';
	}

	// Include the code and layout files.
	ob_start();
		switch($page_request){
			case 'write':
				include(dirname(__FILE__).'/admin/code/write.php');
				include(dirname(__FILE__).'/admin/html/write.php');
			break;
			case 'shortcode':
				include(dirname(__FILE__).'/admin/code/shortcode.php');
				include(dirname(__FILE__).'/admin/html/shortcode.php');
			break;
			case 'resources':
				include(dirname(__FILE__).'/admin/code/resources.php');
				include(dirname(__FILE__).'/admin/html/resources.php');
			break;
			case 'settings':
				include(dirname(__FILE__).'/admin/code/settings.php');
				include(dirname(__FILE__).'/admin/html/settings.php');
			break;
		}
				
		$plugin_output = ob_get_contents();
	ob_end_clean();
	
	// Liquid Templating
	$plugin_output = str_replace('{humanstxt.text}',$humanstxt_text,$plugin_output);
	$plugin_output = str_replace('{page}',$_GET['page'],$plugin_output);
	echo($plugin_output);
}

// Language
add_action('init','load_humanstxt_language');
function load_humanstxt_language(){
	// Save the language settings.
	if(isset($_POST['humanstxt_lang'])){
		// Save the content.
		update_option('humanstxt_lang',$_POST['humanstxt_lang']);
	}

	// Check if a language file exists for Wordpress' regional settings.
	if(get_option('humanstxt_lang') == 'auto'){
		$locale = get_locale();
	
		if(file_exists(dirname(__FILE__).'/lang/'.$locale.'.mo')){
			load_textdomain('humanstxt',dirname(__FILE__).'/lang/'.$locale.'.mo');
		}
	}else{
		// Look for a language file in the plugin directory.
		if(file_exists(dirname(__FILE__).'/lang/'.get_option('humanstxt_lang').'.mo')){
			load_textdomain('humanstxt',dirname(__FILE__).'/lang/'.get_option('humanstxt_lang').'.mo');
		}else if(file_exists(WP_CONTENT_DIR.'/humanstxt/lang/'.get_option('humanstxt_lang').'.mo')){
			// Look for a language file in the content directory.
			load_textdomain('humanstxt',WP_CONTENT_DIR.'/humanstxt/lang/'.get_option('humanstxt_lang').'.mo');
		}	
	}
}

// Add the settings link on the plugin page
$plugin = plugin_basename(__FILE__); 
add_filter('plugin_action_links_'.$plugin,'humanstxt_settings_link');
function humanstxt_settings_link($links) { 
	$settings_link = '<a href="options-general.php?page=humans-txt">Settings</a>';
	array_unshift($links,$settings_link);
	return($links);
}

// Admin HEAD
add_action('admin_head','humanstxt_admin_head');
function humanstxt_admin_head(){
	echo('<link href="'.get_bloginfo('url').'/wp-content/plugins/humans-txt/admin/style.css?'.humanstxt_version.'" rel="stylesheet" type="text/css" />');
	echo('<script type="text/javascript" src="'.get_bloginfo('url').'/wp-content/plugins/humans-txt/thirdparty/jquery.elastic.js?'.humanstxt_version.'"></script>');
	echo('<script type="text/javascript" src="'.get_bloginfo('url').'/wp-content/plugins/humans-txt/thirdparty/jquery.textarea.js?'.humanstxt_version.'"></script>');
	echo('<script type="text/javascript" src="'.get_bloginfo('url').'/wp-content/plugins/humans-txt/admin/functions.js?'.humanstxt_version.'"></script>');
}

// Public HEAD
add_action('wp_head','humanstxt_public_head' );
function humanstxt_public_head(){
	echo('<link type="text/plain" rel="author" href="'.get_bloginfo('url').'/humans.txt" />');
}

// This allows humans.txt content to be served even if the file doesn't exist.
add_action('init','serve_humanstxt');
function serve_humanstxt(){
	// Stop the function if the client isn't looking for humans.txt
	if((get_bloginfo('url').'/humans.txt' != 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']) and ('/humans.txt' != $_SERVER['REQUEST_URI']) and ('humans.txt' != $_SERVER['REQUEST_URI'])){
		return;
	}
	
	// Get the text content.
	$humanstxt_text = stripslashes(get_option('humanstxt_text'));
	
	// Stop if it doesn't exist.
	if(!$humanstxt_text or $humanstxt_text == ''){
		return;
	}
	
	// Output the humans.txt content.
	header('Content-type: text/plain');
	echo($humanstxt_text);
	die;
}

// Add content to a public page where requested.
add_filter('the_content','humanstxt_shortcode');
function humanstxt_shortcode($content){
	// If the tag doesn't exist in the page, return immediately.
	if(!preg_match('|[humanstxt]|',$content)){
		return($content);
	}
	
	// Capture the requested content into a variable.
	ob_start();
		include(dirname(__FILE__).'/public/code/shortcode.php');
		include(dirname(__FILE__).'/public/html/shortcode.php');
		
		$output = ob_get_contents();
	ob_end_clean();

	// Add the requested content to the page.
    return(str_replace('[humanstxt]',$output,$content));
}

// Add content to a public page where requested.
add_filter('the_content','humanstxt_shortcode_nested_list');
function humanstxt_shortcode_nested_list($content){
	// If the tag doesn't exist in the page, return immediately.
	if(!preg_match('|[humanstxt_nested_list]|',$content)){
		return($content);
	}
	
	// Capture the requested content into a variable.
	ob_start();
		include(dirname(__FILE__).'/public/code/shortcode.php');
		include(dirname(__FILE__).'/public/html/shortcode_nested_list.php');
		
		$output = ob_get_contents();
	ob_end_clean();

	// Add the requested content to the page.
    return(str_replace('[humanstxt_nested_list]',$output,$content));
}
?>