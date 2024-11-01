			<h3 id="TOC_Options"><?php _e('"Table of Contents" Options','showcaseext'); ?></h3>
			<img alt="Screenshot of indices" style="float: right; padding-left: 7px" src="<?php echo SHOWCASEEXT_URL . 'screenshot-1.png';?>"><p><?php _e('You can choose what you want to include in the initial "Table of Contents" of the theme showcase. (See the plugin screenshots, if you need to see how it will look.)','showcaseext');?></p>
			
			<input type="checkbox" name="showcaseext_options[display_name_index]" id="display_name_index" value="on" <?php checked('on', $options['display_name_index']); ?>
			<label for="display_name_index"> <?php _e('Show name index','showcaseext');?></label>  <br />
			
			<input type="checkbox" name="showcaseext_options[display_thumbnail_index]" id="display_thumbnail_index" value="on" <?php checked('on', $options['display_thumbnail_index']); ?> />
			<label for="display_thumbnail_index"> <?php _e('Show thumbnail index','showcaseext');?></label>  <br />
			
			<input type="checkbox" name="showcaseext_options[reverse_order_of_indices]" id="reverse_order_of_indices" value="on" <?php checked('on', $options['reverse_order_of_indices']); ?> />
			<label for="reverse_order_of_indices"> <?php _e('Display thumbnail index before name index?','showcaseext');?></label>

			<table>
				<caption style="text-align:left; margin-top: 1em;">
					<?php _e('Here you can choose how many columns to show in the thumbnail index, if you have chosen to display it above. Check the checkbox, if you want the plugin to complete the last row (e.g., if you apply a background color to the table). You can define the separator between the theme names in the name index. You can also disable the &lt;div&gt; tags with id showcaseext around the whole output.','showcaseext'); ?>
				</caption>
				<tr>
					<td>
						<input type="text" size="1" name="showcaseext_options[number_of_columns]" id="number_of_columns" value="<?php echo $options['number_of_columns']; ?>" />
					</td>
					<td>
						<label for="number_of_columns"> <?php _e('Number of columns in the thumbnail index','showcaseext');?></label> &nbsp; <input type="checkbox" name="showcaseext_options[complete_last_row]" id="complete_last_row" value="on" <?php checked('on', $options['complete_last_row']); ?> /> <label for="complete_last_row"> <?php _e('Complete last row by adding missing columns?','showcaseext');?></label>
					</td>
				</tr>
				<tr>
					<td>
						<input type="text" size="5" name="showcaseext_options[user_separator]" id="user_separator" value="<?php echo $options['user_separator']; ?>" />
					</td>
					<td>
						<label for="user_separator"> <?php _e('Enter user-defined separator (optionally)','showcaseext');?></label>
					</td>
				</tr>
				<tr>
					<td colspan="2"><span style="font-size: 85%"><?php _e('Default is \' &middot; \', i.e. the middle dot surrounded by spaces. If you want the theme names to be listed on separate lines, you may enter &lt;br /&gt; (no spaces) &ndash; or use CSS. If blank, no separator will be used.','showcaseext');?>
					</td>
				</tr>
			</table>
			
			<div class="submit">
				<input type="submit" name="submitted" value="<?php esc_attr_e('Save changes','showcaseext'); ?>" />
			</div>
