<ul id="humanstxt_nested_list">
	<?php foreach($humanstxt_rows as $row){ ?>
		<?php $row = trim($row); ?>
		<?php if ($row == '/* TEAM */') { ?>
			<li><span class="humanstxt_nested_list_heading">Team</span>
            	<ul>
		<?php } else if ($row == '/* SITE */') { ?>
            	</ul>
            </li>
			<li><span class="humanstxt_nested_list_heading">Site</span>
            	<ul>
		<?php } else { ?>
			<?php
				// Split the line into its parts:
				$parts = explode(':',$row);
				
				// In case someone is using ASCII art, lets assume more than 4 colons means it's not an actual credit:
				if (count($parts) < 5) {
					// The role is the first part:
					$role = $parts[0];
					
					// The remaining parts need to be concatenated into one value.
					// For example a link value will have additional colons: http://website.com
					$value = '';
					for($i=1; $i<count($parts); $i++){
						$value = $value.$parts[$i].':';
					}
					
					// And just remove the last colon:
					$value = substr($value,0,(strlen($value)-1));
					
					// Look for a link:
					if(strpos($value,'http') !== false){
						$value = ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]","<a href=\"\\0\">\\0</a>",$value);
					}					
					
					// Look for a Twitter name:
					if ($role == 'Twitter') {
						// Strip the value down to its Twitter name.
						$value = str_replace(' ','',$value);
						$value = str_replace('@','',$value);
						$value = '<a href="http://twitter.com/'.$value.'">@'.$value.'</a>';
					}

				} // end if count.
			?>
			
			<?php if(isset($role) and $role != '' and isset($value) and $value != '' ){ ?>
				<li><?php echo($role); ?>: <?php echo($value); ?></li>
			<?php } ?>
			
			<?php if($row == ''){ ?>
				<br /> 
			<?php } ?>
		<?php } ?>
	<?php } // end foreach row. ?>
	</ul>
</ul>