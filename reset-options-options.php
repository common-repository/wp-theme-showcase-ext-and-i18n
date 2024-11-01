			<h3 id="Reset_to_default_options_at_next_deactivation"><?php _e('Reset WP Theme Showcase ext and i18n to default options','showcaseext');?></h3>
			
			<p><?php _e('You can reset the Showcase ext options. This is useful, if the options stored in the database have become invalid (e.g., if you manually have updated the plugin files to a new version with new options).','showcaseext');?> <?php _e('Note that the widget options will be reset as well.','showcaseext');?></p>
			<p><?php _e('If you really want to reset the options for this plugin and its widget, then you must select the checkbox below and then press the Reset to default options button.','showcaseext');?> <em><?php _e('In order to actually reset the options, you must deactivate this plugin with this option set and then reactivate it.','showcaseext');?></em></p>
			
			<input type="checkbox" name="showcaseext_options[reset_showcaseext_options]" id="reset_showcaseext_options" value="on" <?php checked('on', $options['reset_showcaseext_options']); ?> />
			<label for="reset_showcaseext_options"> <?php _e('Yes, I want to reset the options for this plugin','showcaseext'); ?>
			
			<div class="submit">
				<input type="submit" name="reset" value="<?php _e('Reset to default options','showcaseext'); ?>" />
			</div>