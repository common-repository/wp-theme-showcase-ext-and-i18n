			<h3 id="Internal_links"><?php _e('User-defined internal links','showcaseext');?></h3>
			
			<table width=100%>		
				<caption style="text-align:left; padding-bottom: 5px;">
					<img alt="Screenshot of download instructions" style="float: right; padding-left: 7px" src="<?php echo SHOWCASEEXT_URL . 'screenshot-12.png';?>"><?php _e('You can add your own user-defined links which will be displayed before the test-run link. The code is read from text files).','showcaseext');?><br/>
					<?php _e('You have to create a directory under wp-content for this purpose and set the necessary read permissions (obviously, you must also make it writable in order to save your files in it). Here you can set the directory name.','showcaseext');?><br/>
					<?php _e('The file names are fixed in that they must be set to the title of the theme with all spaces replaced by underscores. For example, if the theme name is Amazing Grace, the internal links filename must be Amazing_Grace.txt. As you can see, the filenames are case-sensitive.','showcaseext');?>
				</caption>

				<tr>
					<td width=48%>
						<?php _e('Directory for internal links files (no trailing slash):','showcaseext');?>
					</td>

					<td width=auto>
						<input type="text" size="53" name="showcaseext_options[internal_links_directory]" id="internal_links_directory" value="<?php echo $options['internal_links_directory']; ?>" />
					</td>
				</tr>
				<tr>
					<td width=48% colspan=2>
						<span><input type="checkbox" name="showcaseext_options[display_internal_links]" id="display_internal_links" value="on" <?php checked('on', $options['display_internal_links']); ?> />
						<label for="display_internal_links"> <?php _e('Display internal links read from text file?','showcaseext');?></label></span> 
					</td>
				</tr>

			</table>
			
			<div class="submit">
				<input type="submit" name="submitted" value="<?php esc_attr_e('Save changes','showcaseext'); ?>" />
			</div>

