<?php
// Security: Ensure the file is accessed by Wordpress.
if(!defined('ABSPATH')){
	return;
}
?>

<div class="wrap" id="humanstxt_admin">
	<div id="icon-options-general" class="icon32"><br /></div>
	<h2>Humans.txt</h2>
	<?php include(dirname(__FILE__).'/submenu.php'); ?>
	
	<?php if(isset($humanstxt_message) and $humanstxt_message != ''){ ?>
		<div id="humanstxt_message"><?php echo($humanstxt_message); ?></div>
	<?php } ?>
	
	<form action="options-general.php?page=humans-txt&request=settings" method="post">
		<strong><label for="lang_field"><?php echo(__('Humans.txt Language','humanstxt')); ?></label></strong>
		
		<div>
			<select id="lang_field" name="humanstxt_lang">
				<option value="auto"<?php echo($selected_language == 'auto' ? ' selected' : ''); ?>><?php echo(__('Automatically Detected','humanstxt')); ?></option>
				<option value="de_DE"<?php echo($selected_language == 'de_DE' ? ' selected' : ''); ?>>Deutsch</option>
				<option value="en_US"<?php echo($selected_language == 'en_US' ? ' selected' : ''); ?>>English</option>
				<option value="es_ES"<?php echo($selected_language == 'es_ES' ? ' selected' : ''); ?>>Espanol</option>
				<option value="nb_NO"<?php echo($selected_language == 'nb_NO' ? ' selected' : ''); ?>>Norsk</option>
			</select>
		</div>
	
		<p class="submit">
			<input type="submit" name="submit" class="button-primary" value="<?php echo(__('Save Language','humanstxt')); ?>" />
		</p>
	</form>	
</div>