			<h3 id="Credits"><?php _e('Credits','showcaseext');?></h3>
				<table width=100%>
				<caption style="text-align: left; margin-bottom: 3px;"><img style="float: left; padding-right: 7px" src="<?php echo SHOWCASEEXT_URL . 'screenshot-10.png';?>"><?php _e('If you think that WP Theme Showcase ext and i18n is useful for you, you are encouraged to display a small acknowledgement at the end of the showcase.','showcaseext');?> <br/><br/><img style="float: right; padding-right: 7px" src="<?php echo SHOWCASEEXT_URL . 'screenshot-9.png';?>"><?php _e('It is possible to disable the developer and/or the translator acknowledgement (which, of course, should be done, if you run Showcase ext in the original edition).','showcaseext');?></caption>
					<tr>
						<td>
							<input type="checkbox" name="showcaseext_options[display_acknowledgement]" id="display_acknowledgement" value="on" <?php checked('on', $options['display_acknowledgement']); ?> />
							<label for="display_acknowledgement"> <?php _e('Display developer acknowledgement?','showcaseext');?></label>
							 <?php /* here is a space */ ;?>
							<input type="checkbox" name="showcaseext_options[display_translator_acknowledgement]" id="display_translator_acknowledgement" value="on" <?php checked('on', $options['display_translator_acknowledgement']); ?> />
							<label for="display_translator_acknowledgement"> <?php _e('Also display translator acknowledgement?','showcaseext');?></label>
						</td>
					</tr>
				<table>
				
				<div class="submit">
					<input type="submit" name="submitted" value="<?php esc_attr_e('Save changes','showcaseext'); ?>" />
				</div>
			</div>
			
