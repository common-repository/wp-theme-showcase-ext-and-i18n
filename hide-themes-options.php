			<h3 id="Hide_themes"><?php _e('Hide themes','showcaseext');?></h3>
			<?php $hidethemes = get_themes();
			$theme_names = array_keys($hidethemes);
			natcasesort($theme_names);
			
			?>

			<table width="100%;">		
				<caption style="text-align:left">
					<?php _e('Here you can choose which themes you want to hide.','showcaseext');?>
				</caption>
			
			<?php
				foreach ($theme_names as $theme_name) {
					$hidetitle = $hidethemes[$theme_name]['Title'];
	
					?>
						<tr>
							<td>
								<input name="showcaseext_options[hidethemes][<?php echo $hidetitle ;?>]" type="checkbox" id="<?php echo $hidetitle ;?>" value="on" <?php checked('on', $options[hidethemes][$hidetitle]); ?> />
							</td>
							<td>
								<?php echo $hidetitle;?>
							</td>
					</tr>
				<?php } ;?>
			</table>


			<div class="submit">
				<input type="submit" name="submitted" value="<?php esc_attr_e('Save changes','showcaseext'); ?>" />
			</div>

