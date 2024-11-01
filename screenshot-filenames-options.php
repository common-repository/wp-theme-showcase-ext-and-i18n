			<h3 id="Image_filenames"><?php _e('User-defined image filenames','showcaseext');?></h3>
			
			<table width=100%>		
				<caption style="text-align:left">
					<?php _e('Here you can change the default filenames. The design of this plugin assumes that you have produced your own screenshots of the available themes. However, default WordPress themes are most often packaged with one or more png images.','showcaseext');?> <?php _e('When Showcase ext is activated, it initializes the filename variables so that the standard screenshot.png will be used for all three image sizes. If you want to unleash all the power of Showcase ext, then you should create additional images and change the filenames below.','showcaseext');?>
				</caption>

				<tr>
					<td>
						<?php _e('Filename of small-size screenshots (thumbnails):','showcaseext');?>
					</td>
					<td>
						<input type="text" size="53" name="showcaseext_options[smallsize_user_screenshot]" id="smallsize_user_screenshot" value="<?php echo $options['smallsize_user_screenshot']; ?>" />
					</td>
				</tr>
				
				<tr>
					<td>
						<?php _e('Filename(s) of medium-size screenshots (theme screenshots, see illustration above):','showcaseext');?>
					</td>
					<td>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<textarea cols="116" rows="2" name="showcaseext_options[mediumsize_user_screenshot]" id="mediumsize_user_screenshot"><?php echo $options['mediumsize_user_screenshot']; ?> </textarea>
					</td>
				</tr>
				<tr>
					<td colspan=2 class="notes">
						<span style="font-size: 85%;"><?php _e('Showcase ext supports multiple filenames for this field. If the first file name is not found, it will look for the next filename etc. For instance, it will allow you to choose a filename for your own pictures, but to let the plugin fall back to the WordPress default filename (screenshot.png), if you have not (yet) produced your own picture.','showcaseext');?> <?php _e('If you have enabled Display links to additional screenshots above, then Showcase ext will display links to the rest of the available screenhots.','showcaseext');?></span>
					</td>
				</tr>

				<tr>
					<td width=48%>
						<?php _e('Filename of full-size screenshots (large theme screenshot, not illustrated):','showcaseext');?>
					</td>
					<td width=auto>
						<input type="text" size="53" name="showcaseext_options[fullsize_user_screenshot]" id="fullsize_user_screenshot" value="<?php echo $options['fullsize_user_screenshot']; ?>" />
					</td>
				</tr>

				<tr>
					<td colspan=2>
						<span style="font-size: 85%;"><?php _e('Note: The following sizes are recommended for user-defined screenshots:','showcaseext');?><br/>
						&nbsp; &bull; <?php _e('The full-size images should be smaller than the available screen size of the ordinary blog visitor.','showcaseext');?><br />
						&nbsp; &bull; <?php _e('300x300px for the medium-size images that are displayed in the showcase. All images should be of equal width.','showcaseext');?><br />
						&nbsp; &bull; <?php _e('100x100px for the thumbnails used in the thumbnail index. All images should be of equal width and height.','showcaseext');?></span>
					</td>
				</tr>
			</table>
			
			<div class="submit">
				<input type="submit" name="submitted" value="<?php esc_attr_e('Save changes','showcaseext'); ?>" />
			</div>
