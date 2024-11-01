			<h3 id="Readme_filenames"><?php _e('Case-sensitive user-defined readme filenames','showcaseext');?></h3>
			
			<table width=100%>
			<caption style="text-align: left;">
				<img alt="Screenshot of download instructions" style="float: right; padding-left: 7px" src="<?php echo SHOWCASEEXT_URL . 'screenshot-13.png';?>"><?php _e('Showcase ext will display links to available readme files. The default filenames that Showcase ext checks for are: readme readme.txt readme.htm readme.html readme.pdf. Here you can add (or delete) filenames to your liking. Note that Unix/Linux filenames are usually case-sensitive.','showcaseext');?>
			</caption>
				<tr>
					<td>
						<?php _e('Case-sensitive filenames of readme files:','showcaseext');?>
					</td>
					<td>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<textarea cols="116" rows="2" name="showcaseext_options[readme_filenames]" id="readme_filenames"><?php echo $options['readme_filenames']; ?></textarea>
					</td>
				</tr>
				<tr colspan="2">
					<td>
						<span style="font-size: x-small;"><?php _e('Here is a sample of filenames that could be useful: ', 'showcaseext');?>_CHANGELOG.txt _changelog.txt _license.txt _LICENSE.txt _readme.txt changelog.htm changelog.html CHANGE_LOG.txt changelog.txt CHANGE-LOG.txt child-theme-readme.txt examples-readme.txt extra-stuff.txt gpl.txt GPL.txt GPL_license.txt gpl-3.0.txt license.txt notes.txt notes.txt readme readme.htm readme.html readme.pdf readme.rtf readme.txt README.txt readme-en_US.html theme-license.txt translation.TXT Translation.TXT translation-readme.txt
						</span>
					</td>
				</tr>
			</table>
			
			<div class="submit">
				<input type="submit" name="submitted" value="<?php esc_attr_e('Save changes','showcaseext'); ?>" />
			</div>
