			<h3 id="Widget_Credits"><?php _e('Widget Credits','showcaseext');?></h3>
				<table width="450px">
				<caption style="text-align: left; margin-bottom: 3px;"><img style="float: right; padding-left: 7px;" src="<?php echo SHOWCASEEXT_URL . 'screenshot-14.png';?>"><?php _e('If you think that the widget for WP Theme Showcase ext and i18n is useful for you, you are encouraged to display a small acknowledgement at the end of the widget. Thank you very much. My site is 100% non-commercial, but I appreciate if you display the credit.','showcaseext');?></caption>
					<tr>
						<td>
							<input type="checkbox" name="showcaseext_options[display_widget_credit]" id="display_widget_credit" value="on" <?php checked('on', $options['display_widget_credit']); ?> />
							<label for="display_widget_credit"> <?php _e('Display small credit at the bottom of the widget?','showcaseext');?></label>
						</td>
					</tr>
				<table>
				
				<div class="submit">
					<input type="submit" name="submitted" value="<?php esc_attr_e('Save changes','showcaseext'); ?>" />
				</div>
			</div>
			
