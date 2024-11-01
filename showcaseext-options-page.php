<?php
/**
 * WP Theme Showcase ext and i18n version 2.5.7
 * Author: GeorgWP
 * Included by theme-showcase-ext.php
 */
?>
	<div class="wrap">
		<div id="showcaseext_form">
		
		<form method="post" action="options.php">
			<?php settings_field('showcaseext_options'); ?>
			<?php $options = get_option('showcaseext_options'); ?>
			
		<h2><?php _e('Showcase ext and i18n','showcaseext');?></h2>
		
		<h3><?php _e('Table of Contents for this options page','showcaseext');?></h3>
		<a href="#Usage"><?php _e('Plugin usage','showcaseext');?></a>&nbsp;&middot;
		<a href="#TOC_Options"><?php _e('"Table of Contents" options','showcaseext'); ?></a>&nbsp;&middot;
		<a href="#Titles_and_messages"><?php _e('User-defined titles and messages','showcaseext'); ?></a>&nbsp;&middot;
		<a href="#Theme_info_options"><?php _e('Theme information options','showcaseext'); ?></a>&nbsp;&middot;
		<a href="#Image_filenames"><?php _e('User-defined image filenames','showcaseext'); ?></a>&nbsp;&middot;
		<a href="#Readme_filenames"><?php _e('User-defined readme filenames','showcaseext'); ?></a>&nbsp;&middot;
		<a href="#Theme_descriptions"><?php _e('User-defined theme descriptions','showcaseext'); ?></a>&nbsp;&middot;
		<a href="#Download_instructions"><?php _e('User-defined download instructions','showcaseext'); ?></a>&nbsp;&middot;
		<a href="#Download_dlm_instructions"><?php _e('Show WordPress Download Monitor download link','showcaseext'); ?></a>&nbsp;&middot;
		<a href="#Internal_links"><?php _e('User-defined internal links','showcaseext'); ?></a>&nbsp;&middot;
		<a href="#Credits"><?php _e('Credits','showcaseext'); ?></a>&nbsp;&middot;
		<a href="#Generate_Showcase_Widget_Code"><?php _e('Generate Showcase Widget Code','showcaseext'); ?></a>&nbsp;&middot;
		<a href="#Widget_Credits"><?php _e('Show Widget Credits','showcaseext'); ?></a>&nbsp;&middot;
		<a href="#Debug_mode"><?php _e('Debug mode','showcaseext'); ?></a>&nbsp;&middot;
		<a href="#Reset_to_default_options_at_next_deactivation"><?php _e('Reset Showcase ext options','showcaseext'); ?></a>&nbsp;&middot;
		<a href="#Delete_options_at_next_deactivation"><?php _e('Delete Showcase ext options','showcaseext'); ?></a>&nbsp;&middot;
		<a href="#Hide_themes"><?php _e('Hide themes','showcaseext'); ?></a>

		
		<h3 id="Usage"><?php _e('Plugin Usage','showcaseext');?></h3>
		<p><?php _e('Create a new page &ndash; or use an existing one &ndash; and insert the shortcode <strong>[showcaseext]</strong> into the page.','showcaseext');?> 

		<?php $readmetxt = SHOWCASEEXT_URL . 'readme.htm';?>
		<?php printf(__("If you want to unleash the full power of this plugin, then you will have to create additional screenshots and thumbnails. See below and more in the <a target=_blank href=\"%s\">readme.htm</a> for details.",'showcaseext'), $readmetxt);?></p>
		<?php include("toc-options.php"); ?>
		<?php include("title-options.php"); ?>
		<?php include("theme-info-options.php"); ?>
		<?php include("screenshot-filenames-options.php"); ?>
		<?php include("readme-filenames-options.php"); ?>
		<?php include("theme-descriptions-options.php"); ?>
		<?php include("dl-instructions-options.php"); ?>
		<?php include("dl-dlm-instructions-options.php"); ?>
		<?php include("internal-links-options.php"); ?>
		<?php include("credits-options.php"); ?>
		<?php include("generate-widget-options.php"); ?>
		<?php include("widget-credits-options.php"); ?>
		<?php include("debug-options.php"); ?>
		<?php include("reset-options-options.php"); ?>
		<?php include("delete-options-options.php"); ?>
		<?php include("hide-themes-options.php"); ?>		


<?php /* Denne kodestump virker
		<table class="form-table">
				<tr valign="top"><th scope="row">A Checkbox</th>
					<td><input name="showcaseext_options[option1]" type="checkbox" value="1" <?php checked('1', $options['option1']); ?> /></td>
				</tr>
				<tr valign="top"><th scope="row">Some text</th>
					<td><input type="text" name="showcaseext_options[sometext]" value="<?php echo $options['sometext']; ?>" /></td>
				</tr>
			</table>
			<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			</p>
Slut på kodestump, der virker */ ;?>

		</form>
		<p style="padding-bottom: 80em;">&nbsp;</p>
		</div>
	</div>
	
