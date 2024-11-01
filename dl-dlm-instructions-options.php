			<h3 id="Download_dlm_instructions"><?php _e('Show WordPress Download Monitor download link','showcaseext');?></h3>
			
			<table width=100%>		
				<caption style="text-align:left; padding-bottom: 5px;">
					<img alt="Screenshot of download instructions" style="float: right; padding-left: 7px" src="<?php echo SHOWCASEEXT_URL . 'screenshot-12.png';?>"><?php _e('You can choose an alternative function that also reads a text file. It will display a WordPress Download Monitor link, if the WordPress Download Monitor function exists. However, this text file must only contain the id number that WordPress Download Monitor has assigned to the specific download. The display format will be the one defined as standard in WordPress Download Monitor. The file names are fixed in that they must be set to the title of the theme with all spaces replaced by underscores <i>plus</i> the suffix "_id". For example, if the theme name is Amazing Grace, the WordPress Download Monitor download instruction filename must be Amazing_Grace_id.txt. As you can see, the filenames are case-sensitive. The files must reside in the directory for the download instruction files.','showcaseext');?>
				</caption>

				<tr>
					<td width=48% colspan=2>
						<span><input type="checkbox" name="showcaseext_options[display_dlm_download_link]" id="display_dlm_download_link" value="on" <?php checked ('on', $options['display_dlm_download_link']); ?> />
						<label for="display_dlm_download_link"> <?php _e('Display WordPress Download Monitor download link read from text file?','showcaseext');?></label></span> 
					</td>
				</tr>

			</table>
			
			<div class="submit">
				<input type="submit" name="submitted" value="<?php esc_attr_e('Save changes','showcaseext'); ?>" />
			</div>

