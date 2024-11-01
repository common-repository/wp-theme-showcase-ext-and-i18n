			<h3 id="Delete_options_at_next_deactivation"><?php _e('Delete options for WP Theme Showcase ext and i18n','showcaseext');?></h3>
			
			<p><?php _e('You can delete the Showcase ext options. This is useful, if you want to completely remove this plugin from your WordPress installation.','showcaseext');?> <?php _e('Note that the widget options will be deleted as well.','showcaseext');?></p>
			<p><?php _e('If you really want to delete the options for this plugin and its widget, then you must select the checkbox below and then press the Delete options button.','showcaseext');?> <em><?php _e('In order to actually delete the options, you must deactivate the plugin.','showcaseext');?></em></p>
			
			<input type="checkbox" name="showcaseext_options[delete_showcaseext_options]" id="delete_showcaseext_options" value="on" <?php checked('on', $options['delete_showcaseext_options']); ?> />
			<label for="delete_showcaseext_options"> <?php _e('Yes, I want to delete the options for this plugin','showcaseext');?>
			
			<div class="submit">
				<input type="submit" name="delete" value="<?php _e('Delete options','showcaseext'); ?>" />
			</div>