			<h3 id="Generate_Showcase_Widget_Code"><?php _e('Generate Showcase Widget Code','showcaseext');?></h3>
			
			<table width=100%>		
				<caption style="text-align:left; padding-bottom: 5px;">
					<img alt="Screenshot of widget" style="float: left; padding-right: 7px" src="<?php echo SHOWCASEEXT_URL . 'screenshot-8.png';?>"><span><?php _e('You can enable the generation of Showcase Widget code for use with the Showcase Ext Widget, if your theme is widget-ready.*<br/><br/>Note, however, that certain conditions apply.','showcaseext');?><br/>
					<?php _e('Thumbnails of a suitable size must exist.<br/>You <i>must</i> also enter a page id in the Showcase Widget Control. The plugin needs the page (or post) id in order to generate the code that the widget uses.','showcaseext');?><br/><br/>
					<?php _e('<sup>*</sup> You can, however, enter the PHP/HTML code directly in your theme, if it is not widget-ready.','showcaseext');?>
				</caption>

				<tr>
					<td width=48% colspan=2>
						<input type="checkbox" name="showcaseext_options[generate_widget_code]" id="generate_widget_code" value="on" <?php checked('on', $options['generate_widget_code']); ?> />
						<label for="generate_widget_code"> <?php _e('Generate Showcase Widget Code?','showcaseext');?></label></span> 
					</td>
				</tr>

			</table>
			
			<div class="submit">
				<input type="submit" name="submitted" value="<?php esc_attr_e('Save changes','showcaseext'); ?>" />
			</div>
			
