			<h3 id="Debug_mode"><?php _e('Debug mode','showcaseext');?></h3>
			<p><?php _e('If you, for example, have difficulty styling your showcase or if the layout differs from your expectations, then you may enable debug mode. Then the plugin will list a good number of variables for your inspection below the showcase.','showcaseext');?> <?php _e('You can also let the plugin save the report.','showcaseext');?> <?php _e("If you choose to save reports, you must provide a subdirectory for them in the wp-content directory. The plugin will look for the subdirectory 'debug_reports', if you do not provide any name for it. Note also that the plugin does not delete the files it creates.",'showcaseext');?> <?php _e('If you choose to not save reports, the debug report cannot inform you about form submission variables in the $_POST variable.','showcaseext');?></p>
			
			<input type="checkbox" name="showcaseext_options[dump_debug_report]" id="dump_debug_report" value="on" <?php checked('on', $options['dump_debug_report']); ?> />
			<label for="dump_debug_report"> <?php _e('Dump debug report into a HTML file for inspection?','showcaseext');?></label> &nbsp;

			<input type="checkbox" name="showcaseext_options[dump_debug_report_all]" id="dump_debug_report_all" value="on" <?php checked('on', $options['dump_debug_report_all']); ?> />
			<label for="dump_debug_report_all"> <?php _e('Add a counter to the file name and save each and every debug report (debug_report[1].htm etc.)?','showcaseext');?></label>  <br />

			<?php _e('Directory for debug report files (no trailing slash):','showcaseext');?> <input type="text" size="73" name="showcaseext_options[debug_report_path]" id="debug_report_path" value="<?php echo $options['debug_report_path']; ?>" /><br/>

			<input type="checkbox" name="showcaseext_options[debug_mode]" id="debug_mode" value="on" <?php checked('on', $options['debug_mode']); ?> />
			<label for="debug_mode"> <?php _e('Enable debug mode?','showcaseext');?></label>  <br />
			 
		
			<div class="submit">
				<input type="submit" name="submitted" value="<?php esc_attr_e('Save changes','showcaseext'); ?>" />
			</div>