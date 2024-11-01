			<h3 id="Theme_descriptions"><?php _e('User-defined theme descriptions','showcaseext');?></h3>
			
			<table width=100%>		
				<caption style="text-align:left; padding-bottom: 5px;">
					<?php _e('You can translate or add to the Description fields of the style.css files with HTML tags etc. However, this means that you must remember to edit the style.css file each time a theme is updated. Therefore, Showcase ext version 1.5 and later let you load and display theme descriptions from separate text-files.','showcaseext');?> <?php _e('In the illustration above, the description in Danish is loaded from a UTF-8 text file and displayed instead of the description of the style.css.', 'showcaseext');?><br/> <?php _e('Note that you can have separate download instructions, if you like (see below).','showcaseext');?> <?php _e('You have to create a directory under wp-content for the theme descriptions and set the necessary read permissions (obviously, you must also make it writable in order to save your files in it). Here you can set the directory name.','showcaseext');?><br/>
					<?php _e('The file names are fixed in that they must be set to the title of the theme with all spaces replaced by underscores. For example, if the theme name is Amazing Grace, the theme description filename must be Amazing_Grace.txt. As you can see, the filenames are case-sensitive.','showcaseext');?>
				</caption>

				<tr>
					<td width=48%>
						<?php _e('Directory for theme description files (no trailing slash):','showcaseext');?>
					</td>

					<td width=auto>
						<input type="text" size="53" name="showcaseext_options[theme_description_directory]" id="theme_description_directory" value="<?php echo $options['theme_description_directory']; ?>" />
					</td>
				</tr>
				<tr>
					<td width=48% colspan=2>
						<span><input type="checkbox" name="showcaseext_options[display_user_theme_description]" id="display_user_theme_description" value="on" <?php checked('on', $options['display_user_theme_description']); ?> />
						<label for="display_user_theme_description"> <?php _e('Display user-defined theme descriptions read from text file?','showcaseext');?></label></span> 
					</td>
				</tr>

			</table>
			
			<div class="submit">
				<input type="submit" name="submitted" value="<?php esc_attr_e('Save changes','showcaseext'); ?>" />
			</div>
