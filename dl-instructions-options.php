			<h3 id="Download_instructions"><?php _e('User-defined download instructions','showcaseext');?></h3>
			
			<table width=100%>		
				<caption style="text-align:left; padding-bottom: 5px;">
					<img alt="Screenshot of download instructions" style="float: right; padding-left: 7px" src="<?php echo SHOWCASEEXT_URL . 'screenshot-12.png';?>"><?php _e('You can add your own user-defined download instructions to the Description fields of the style.css files with HTML tags etc. However, this means that you must remember to edit the style.css file each time a theme is updated. Therefore, Showcase ext version 1.5 and later let you load and display download instructions from separate text-files.','showcaseext');?><br/>
					<?php _e('You have to create a directory under wp-content for this purpose and set the necessary read permissions (obviously, you must also make it writable in order to save your files in it). Here you can set the directory name.','showcaseext');?><br/>
					<?php _e('The file names are fixed in that they must be set to the title of the theme with all spaces replaced by underscores. For example, if the theme name is Amazing Grace, the download instruction filename must be Amazing_Grace.txt. As you can see, the filenames are case-sensitive.','showcaseext');?>
				</caption>

				<tr>
					<td width=48%>
						<?php _e('Directory for download instruction files (no trailing slash):','showcaseext');?>
					</td>

					<td width=auto>
						<input type="text" size="53" name="showcaseext_options[download_instructions_directory]" id="download_instructions_directory" value="<?php echo $options['download_instructions_directory']; ?>" />
					</td>
				</tr>
				<tr>
					<td width=48% colspan=2>
						<span><input type="checkbox" name="showcaseext_options[display_download_instruction]" id="display_download_instruction" value="on" <?php checked('on', $options['display_download_instruction']); ?> />
						<label for="display_download_instruction"> <?php _e('Display download instructions read from text file?','showcaseext');?></label></span> 
					</td>
				</tr>

			</table>
			
			<div class="submit">
				<input type="submit" name="submitted" value="<?php esc_attr_e('Save changes','showcaseext'); ?>" />
			</div>
