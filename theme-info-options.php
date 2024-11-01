			<h3 id="Theme_info_options"><?php _e('Theme information options','showcaseext'); ?></h3>
			<img alt="Screenshot of indices" style="float: right; padding-left: 7px" src="<?php echo SHOWCASEEXT_URL . 'screenshot-11.png';?>"><p><?php _e('You can choose what information you want to display for each theme in addition to the thumbnails and a test-run link.','showcaseext'); ?></p>
			
			<input type="checkbox" name="showcaseext_options[display_fullsize_images]" id="display_fullsize_images" value="on"  <?php checked('on', $options['display_fullsize_images']); ?> />
			<label for="display_fullsize_images"> <?php _e('Link to full-size images and display them if users click on theme images?','showcaseext');?></label> 
			
			<br /><input type="checkbox" name="showcaseext_options[include_shutter_class]" id="include_shutter_class" value="on" <?php checked('on', $options['include_shutter_class']); ?> />
			<label for="include_shutter_class"> <?php _e('Include Shutter <em>set</em> class in the links?','showcaseext');?></label><br /><br />

			<input type="checkbox" name="showcaseext_options[display_additional_screenshots]" id="display_additional_screenshots" value="on" <?php checked('on', $options['display_additional_screenshots']); ?> />
			<label for="display_additional_screenshots"> <?php _e('Display links to additional screenshots?','showcaseext');?></label>
			 <?php /* note the space here */;?>
			<br /><input type="checkbox" name="showcaseext_options[include_shutter_class_2]" id="include_shutter_class_2" value="on"<?php checked('on', $options['include_shutter_class_2']); ?> />
			<label for="include_shutter_class_2"> <?php _e('Include Shutter <em>set</em> class in the links?','showcaseext');?></label><br /><br />
			
			<input type="checkbox" name="showcaseext_options[display_author]" id="display_author" value="on" <?php checked('on', $options['display_author']); ?> />
			<label for="display_author"> <?php _e('Show author','showcaseext');?></label>  <br /><br />
			
			<input type="checkbox" name="showcaseext_options[display_description]" id="display_description" value="on" <?php checked('on', $options['display_description']); ?> />
			<label for="display_description"> <?php _e('Show description','showcaseext');?></label>  <br /><br />
			
			<input type="checkbox" name="showcaseext_options[display_tags]" id="display_tags" value="on" <?php checked('on', $options['display_tags']); ?> />
			<label for="display_tags"> <?php _e('Show tags','showcaseext');?></label> <br />
			
			<input type="checkbox" name="showcaseext_options[display_translated_tags]" id="display_translated_tags" value="on" <?php checked ('on', $options['display_translated_tags']); ?> />
			<label for="display_translated_tags"> <?php _e('Show translated tags','showcaseext');?></label>  <br /><br />
			
			<input type="checkbox" name="showcaseext_options[display_readme_link]" id="display_readme_link" value="on" <?php checked('on', $options['display_readme_link']); ?> />
			<label for="show_readme_link"> <?php _e('Show links to available readme files. As default Showcase ext looks for a number of filenames. You can add your own (or delete existing ones) below. Showcase ext will display a link for each existing file.','showcaseext');?></label>  <br />
			
			<div class="submit">
				<input type="submit" name="submitted" value="<?php esc_attr_e('Save changes','showcaseext'); ?>" />
			</div>
			
			<div style="clear: both;"></div>
			
	