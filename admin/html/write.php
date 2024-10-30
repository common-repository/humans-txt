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
	
	<div class="clear setting-description">
		<p><?php echo(__('Enter your website credits and click save to update your humans.txt file.','humanstxt')); ?></p>
	</div>
	
	<?php if(isset($humanstxt_message) and $humanstxt_message != ''){ ?>
		<div id="humanstxt_message"><?php echo($humanstxt_message); ?></div>
	<?php } ?>
	
	<?php if($enable_form == true){ ?>
		<div id="humanstxt_form">
			<form name="humanstxt-form" action="options-general.php?page={page}" method="post">
				
				<div id="poststuff">
					<textarea id="humanstxt_text_field" name="humanstxt_text" wrap="off">{humanstxt.text}</textarea>
				</div>					
				
				<p class="submit">
					<input type="submit" name="submit" class="button-primary" value="<?php echo(__('Save Changes','humanstxt')); ?>" /> or view your <a href="<?php get_bloginfo('url'); ?>/humans.txt" target="_blank">humans.txt</a>
				</p>
			</form>
		</div>
		<div id="humanstxt_suggestions">
			<?php if(strpos($humanstxt_text,'WordPress Theme: '.$theme_details['Name']) == false){ ?>
				<ul class="list-of-suggestions">
					<li><strong>Suggested Theme Designer</strong></li>
					<li class="click-to-add">WordPress Theme: <?php echo($theme_details['Name']); ?><br>Author: <?php echo($theme_details['Author Name']); ?><br>Website: <?php echo($theme_details['Author URI']); ?></li>
				</ul>
			<?php } ?>
			
			<ul class="list-of-suggestions">
				<li><strong>Suggested WordPress Users</strong></li>
				<?php foreach($all_users as $user){ ?>
					<?php
						// Get the user's details.
						$user_details = get_userdata($user->ID);
						//var_dump($user_details);
						
						// Set the user's role.
						$user_role = '';
						switch($user_details->user_level){
							case '1':
								$user_role = 'Contributor';
							break;
							case '2':
							case '3':
							case '4':
								$user_role = 'Author';
							break;
							case '5':
							case '6':
							case '7':
								$user_role = 'Editor';
							break;
							case '8':
							case '9':
							case '10':
								$user_role = 'Administrator';
							break;
						}
					?>
					
					<?php if($user_role != '' and strpos($humanstxt_text,$user_role.': '.$user_details->display_name) == false){ ?>
						<li class="click-to-add"><?php echo($user_role); ?>: <?php echo($user_details->display_name); ?><br>Website: <?php echo($user_details->user_url); ?></li>
					<?php } ?>
				<?php } ?>
			</ul>
			
			<ul class="list-of-suggestions">
				<li><strong>Suggested Site Details</strong></li>
				<?php if($sites_timezone != '' and strpos($humanstxt_text,'Timezone:') == false){ ?>
					<li class="click-to-add-site">Timezone: <?php echo($sites_timezone); ?></li>
				<?php } ?>
				<?php if(strpos($humanstxt_text,'Last update:') == false){ ?>
					<li class="click-to-add-site">Last update: <?php echo(date(get_option('date_format'))); ?></li>
				<?php } ?>
				<?php if(strpos($humanstxt_text,'Language:') == false){ ?>
					<li class="click-to-add-site">Language: <?php echo($selected_language); ?></li>
				<?php } ?>
				<?php if(strpos($humanstxt_text,'Doctype:') == false){ ?>
					<li class="click-to-add-site">Doctype: XHTML</li>
				<?php } ?>
				<?php if(strpos($humanstxt_text,'Tools:') == false){ ?>
					<li class="click-to-add-site">Tools: WordPress</li>
				<?php } ?>
			</ul>			
			
			<ul>
				<li><strong>More Suggestions</strong></li>
				<li class="click-to-add-template">Author: </li>
				<li class="click-to-add-template">Copy Writer: </li>
				<li class="click-to-add-template">Developer: </li>
				<li class="click-to-add-template">Editor: </li>
				<li class="click-to-add-template">Illustrator: </li>
				<li class="click-to-add-template">Programmer: </li>
				<li class="click-to-add-template">Translator: </li>
				<li class="click-to-add-template">Website Designer: </li>
				<li class="click-to-add-template">Writer: </li>
			</ul>
		</div>
	<?php } ?>
</div>