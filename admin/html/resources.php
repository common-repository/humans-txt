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
	
	<div class="setting-description">
		<h3><?php echo(__('More Information','humanstxt')); ?></h3>
		<?php echo(__('More Information','humanstxt')); ?>: <a href="http://humanstxt.org">humanstxt.org</a>
		<br /><?php echo(__('Sample File','humanstxt')); ?>: <a href="http://humanstxt.org/humans.txt">humanstxt.org/humans.txt</a>
		<br /><?php echo(__('Submit Yours','humanstxt')); ?>: <a href="http://humanstxt.org/Im-human.php">humanstxt.org/Im-human.php</a>
	</div>
	
	<div class="setting-description">
		<h3><?php echo(__('Pro-tips','humanstxt')); ?></h3>
		<?php echo(__("Add a link to your website's contact page instead of your full email address!",'humanstxt')); ?>
	</div>
</div>