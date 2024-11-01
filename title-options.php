			<h3 id="Titles_and_messages"><?php _e('User-defined titles and messages','showcaseext');?></h3>
			
			<table>		
				<caption style="text-align:left">
					<?php _e('Here you can change the default titles and messages of Showcase ext (see illustration above).','showcaseext');?>
				</caption>
				
				<tr>
					<td>
						<?php _e('Title for name index (Default: Name Index):','showcaseext');?>
					</td>
					<td>
						<input type="text" size="40" name="showcaseext_options[user_name_index_title]" id="user_name_index_title" value="<?php echo $options['user_name_index_title']; ?>" />
					</td>
				</tr>
				<tr>
					<td>
						<?php _e('Title for thumbnail index (default: Thumbnail Index):','showcaseext');?>
					</td>
					<td>
						<input type="text" size="40" name="showcaseext_options[user_thumbnail_index_title]" id="user_thumbnail_index_title" value="<?php echo $options['user_thumbnail_index_title'] ?>" />
					</td>
				</tr>
				<tr>
					<td>
						<?php _e('Caption (use \'%s\', if you want to display the number of themes):','showcaseext');?>
					</td>
					<td>
						<input type="text" size="40" name="showcaseext_options[user_caption]" id="user_caption" value="<?php echo $options['user_caption']; ?>" />
					</td>
				</tr>
				<tr>
					<td>
						<?php _e('Instruction to click on the images:','showcaseext');?>
					</td>
					<td>
						<input type="text" size="40" name="showcaseext_options[user_click_picture_message]" id="user_click_picture_message" value="<?php echo $options['user_click_picture_message']; ?>" />
					</td>
				</tr>
			</table>

			<div class="submit">
				<input type="submit" name="submitted" value="<?php esc_attr_e('Save changes','showcaseext'); ?>" />
			</div>

