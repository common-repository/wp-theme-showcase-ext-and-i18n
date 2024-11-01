<?php

/* Plugin information
Plugin Name: WP Theme Showcase ext and i18n
Plugin URI: http://wordpress.blogos.dk/showcaseext
Description: Showcase ext displays a thumbnail index and/or a name index and then an image of each theme together with information from the style.css file and user-defined files. A theme showcase with a wealth of features and options, WP Theme Showcase ext and i18n extends Brad Williams' WordPress Theme Showcase Plugin. Enter <strong>[showcaseext]</strong> in a post or page to display WP Theme Showcase ext and i18n. Localization support. If you need to run this plugin under WP 2.7 or 2.8, get the legacy version from the plugin homepage.
Version: 2.5.3
Author: GeorgWP
Author URI: http://wordpress.blogos.dk

Originally based on

WordPress Theme Showcase Plugin version 1.2
Original Author: Brad Williams
Original Author URI: http://strangework.com/
Original Plugin URI:http://strangework.com/wordpress-plugins/

Example WordPress Theme Preview URI:
http://wordpress.blogos.dk/index.php?preview_theme=WordPress%20Default


Which is Based on

Preview Theme
Original Author: Ryan Boren
Original Author URI: http://boren.nu/

Copyright 2009 GeorgWP - see the Plugin page for further details

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

global $current_version, $debug_array;


function showcaseext_constants_initialization () {
	global $debug_array;
		
	define ( SHOWCASEEXT_URL,  trailingslashit(trailingslashit(WP_PLUGIN_URL) . plugin_basename( dirname (__FILE__) ) ) );
		$debug_array['SHOWCASEEXT_URL'] = SHOWCASEEXT_URL;
	define ( SHOWCASEEXT_PATH,  trailingslashit(trailingslashit(WP_PLUGIN_DIR) . plugin_basename( dirname (__FILE__) ) ) );
		$debug_array['SHOWCASEEXT_PATH'] = SHOWCASEEXT_PATH;
	define ( SHOWCASEEXT_DIR, plugin_basename( dirname (__FILE__) ));
		$debug_array['SHOWCASEEXT_DIR'] = SHOWCASEEXT_DIR;
	define ( SHOWCASEEXT_VERSION, '2010022201');
		$debug_array['SHOWCASEEXT_VERSION'] = SHOWCASEEXT_VERSION;

}
showcaseext_constants_initialization();


function showcaseext_variables_initialization () {
	global $debug_mode, $debug_array, $preview_theme_user_level, $preview_theme_query_arg, $display_test_run_link;
	
	$tmpoptions = get_option('showcaseext_options');
	$debug_mode = $tmpoptions['debug_mode'];
	
	if (empty($tmpoptions['showcaseext_tempnam_prefix'])) {
		$tmpoptions['showcaseext_tempnam_prefix'] = 'SCE';
		update_option ('showcaseext_options', $tmpoptions);
	}
	else {
		$showcaseext_tempnam_prefix = $tmpoptions['sce_tempnam_prefix'];
			if ($debug_mode) $debug_array['showcaseext_tempnam_prefix'] = $showcaseext_tempnam_prefix;
	}
	
	if (empty($tmpoptions['dumppost_filename'])) {
		$tmpoptions['dumppost_filename'] = 'SCE_DUMPPOST.txt';
		update_option ('showcaseext_options', $tmpoptions);
	}
	else {
		$dumppost_filename = $tmpoptions['dumppost_filename'];
			if ($debug_mode) $debug_array['dumppost_filename'] = $dumppost_filename;
	}
	
	unset($tmpoptions);
	
	//  Set this to the user level required to preview themes.
	$preview_theme_user_level = 0;
		if ($debug_mode) $debug_array['preview_theme_user_level'] = $preview_theme_user_level;

	// Set this to the name of the GET variable you want to use.
	$preview_theme_query_arg = 'preview_theme';
		if ($debug_mode) $debug_array['preview_theme_query_arg'] = $preview_theme_query_arg;
		
	$display_test_run_link = true;
		if ($debug_mode) $debug_array['display_test_run_link'] = $display_test_run_link;
}
showcaseext_variables_initialization ();


function showcaseext_textdomain() {
	load_plugin_textdomain('showcaseext',false, trailingslashit(SHOWCASEEXT_DIR) . 'languages');
}
add_action('init', 'showcaseext_textdomain');


function showcaseext_wp_version_check () {
	global $debug_array;
	
	global $wp_version;
	$debug_array['wp_version'] = $wp_version;
	
	$exit_msg = __('WP Theme Showcase ext and i18n requires WordPress 2.9 or newer.<br />
	<a href="http://codex.wordpress.org/Upgrading_WordPress">Please update!</a>','showcaseext');
	$debug_array['exit_msg'] = $exit_msg;
	
	if (version_compare($wp_version, "2.9", "<"))
	{
		exit ($exit_msg);
	}
}
showcaseext_wp_version_check();


function showcaseext_set_debug_poster() {
	echo '<h2 class="debuggingwarning">' . __('Debug mode on!','showcaseext') . '</h2>';
}


function preview_theme_stylesheet_ext($stylesheet) {    
	global $user_level, $preview_theme_user_level, $preview_theme_query_arg;

    get_currentuserinfo();

    if ($user_level  < $preview_theme_user_level) 
    {
        return $stylesheet;
    }

    $theme = $_GET[$preview_theme_query_arg];

    if (empty($theme)) 
    {
        return $stylesheet;
    }

    $theme = get_theme($theme);

    if (empty($theme)) 
    {
        return $stylesheet;
    }

    return $theme['Stylesheet'];
}



function preview_theme_template_ext($template) {
    global $user_level, $preview_theme_user_level, $preview_theme_query_arg, $showcaseext_pageid;

    get_currentuserinfo();

    if ($user_level  < $preview_theme_user_level) 
    {
        return $template;
    }

    $theme = $_GET[$preview_theme_query_arg];

    if (empty($theme)) 
    {
        return $template;
    }

    $theme = get_theme($theme);

    if (empty($theme)) 
    {
        return $template;
    }

    return $theme['Template'];
}


/* function wp_theme_preview_ext($content) */
function showcaseext_function($atts) {
	global $options, $user_level, $preview_theme_user_level, $preview_theme_query_arg, $display_test_run_link;
	
	$options = get_option('showcaseext_options');
	$options['debug_mode'] == 'on' ? $debug_mode = true : $debug_mode = false;
	
	
	if ($debug_mode) {
		global $debug_array, $debug_report, $local_fullsize_debug, $local_mediumsize_debug, $local_additional_screenshots, $debug_anchorized_titles, $local_user_description_file, $local_readme_files, $local_download_instructions, $local_dlm_download_links, $local_internal_links, $internal_variables, $readme_filenames, $mediumsize_filenames, $debug_showcaseext_widget_array;
		
		showcaseext_set_debug_poster();

	}
	

	/** Variables that controls which parts of the theme indices
		* and the theme information entries are created and displayed 
		* Database options are read into an array and assigned to plugin variables 
		* for easy use and readability
		*/
	
	$options['display_name_index'] == 'on' ? $display_name_index = true : $display_name_index = false;
	// echo '<pre>' . print_r( $options ) . '</pre>';
		if ($debug_mode) $internal_variables['display_name_index'] = $display_name_index;
	$options['display_thumbnail_index'] == 'on' ? $display_thumbnail_index = true : $display_thumbnail_index = false;
		if ($debug_mode) $internal_variables['display_thumbnail_index'] = $display_thumbnail_index;
	$options['reverse_order_of_indices'] == 'on' ? $reverse_order_of_indices = true : $reverse_order_of_indices = false;
		if ($debug_mode) $internal_variables['reverse_order_of_indices'] = $reverse_order_of_indices;
	$options['display_fullsize_images'] == 'on' ? $display_fullsize_images = true : $display_fullsize_images = false;
		if ($debug_mode) $internal_variables['display_fullsize_images'] = $display_fullsize_images;
	$options['include_shutter_class'] == 'on' ? $include_shutter_class = true : $include_shutter_class = false;
		if ($debug_mode) $internal_variables['include_shutter_class'] = $include_shutter_class;
	$options['display_additional_screenshots'] == 'on' ? $display_additional_screenshots = true : $display_additional_screenshots = false;
		if ($debug_mode) $internal_variables['display_additional_screenshots'] = $display_additional_screenshots;
	$options['include_shutter_class_2'] == 'on' ? $include_shutter_class_2 = true : $include_shutter_class_2 = false;
		if ($debug_mode) $internal_variables['include_shutter_class_2'] = $include_shutter_class_2;
	$options['display_author'] == 'on' ? $display_author = true : $display_author = false;
		if ($debug_mode) $internal_variables['display_author'] = $display_author;
	$options['display_description'] == 'on' ? $display_description = true : $display_description = false;
		if ($debug_mode) $internal_variables['display_description'] = $display_description;
	$options['display_readme_link'] == 'on' ? $display_readme_link = true : $display_readme_link = false;
		if ($debug_mode) $internal_variables['display_readme_link'] = $display_readme_link;
	$options['display_tags'] == 'on' ? $display_tags = true : $display_tags = false;
		if ($debug_mode) $internal_variables['display_tags'] = $display_tags;
	$options['display_translated_tags'] == 'on' ? $display_translated_tags = true : $display_translated_tags = false;
		if ($debug_mode) $internal_variables['display_translated_tags'] = $display_translated_tags;
	$options['display_dlm_download_link'] == 'on' ? $display_dlm_download_link = true : $display_dlm_download_link = false;
		if ($debug_mode) $internal_variables['display_dlm_download_link'] = $display_dlm_download_link;
	$options['display_download_instruction'] == 'on' ? $display_download_instruction = true : $display_download_instruction = false;
		if ($debug_mode) $internal_variables['display_download_instruction'] = $display_download_instruction;
	$options['display_user_theme_description'] == 'on' ? $display_user_theme_description = true : $display_user_theme_description = false;
		if ($debug_mode) $internal_variables['display_user_theme_description'] = $display_user_theme_description;
		
	$options['generate_widget_code'] == 'on' ? $generate_widget_code = true : $generate_widget_code = false;
		if ($debug_mode) $internal_variables['generate_widget_code'] = $generate_widget_code;

	$options['display_internal_links'] == 'on' ? $display_internal_links = true : $display_internal_links = false;
		if ($debug_mode) $internal_variables['display_internal_links'] = $display_internal_links;

	$options['complete_last_row'] == 'on' ? $complete_last_row = true : $complete_last_row = false;
		if ($debug_mode) $internal_variables['complete_last_row'] = $complete_last_row;
	$options['display_acknowledgement'] == 'on' ? $display_acknowledgement = true : $display_acknowledgement = false;
		if ($debug_mode) $internal_variables['display_acknowledgement'] = $display_acknowledgement;
	$options['display_translator_acknowledgement'] == 'on' ? $display_translator_acknowledgement = true : $display_translator_acknowledgement = false;
		if ($debug_mode) $internal_variables['display_translator_acknowledgement'] = $display_translator_acknowledgement;
		
	$options['generate_widget_code'] == 'on' ? $generate_widget_code = true : $generate_widget_code = false;
		if ($debug_mode) $internal_variables['generate_widget_code'] = $generate_widget_code;

	
	$readme_filenames = explode (' ', $options['readme_filenames']);
		if ($debug_mode) $debug_array['readme_filenames'] = $options['readme_filenames'];
	$mediumsize_filenames = explode (' ', $options['mediumsize_user_screenshot']);
		if ($debug_mode) $debug_array['mediumsize_filenames'] = $options['mediumsize_user_screenshot'];
	
	// Save display_widget_credit for use by the widget
	if ($options['display_widget_credit'] == 'on') {
		update_option('showcaseext_options_widgetcredit', TRUE);
		if ($debug_mode) $internal_variables['display_widget_credit'] = $display_widget_credit;
	}
	
	/* Reset all variables for form building */
	$showcaseext_pageid = '3'; // HASTER
	
	$thumbnail_index_content = '';
	$thumbnail_index_end = '';
	$thumbnail_rest = '';
	
	$name_index_content = "";
	$number_of_themes = 1;
	$theme_number = 0; // curently not used
	
	$hiddenthemes = 0; // initializes variable for control of $number_of_themes
	
	$themes = get_themes();
	// echo "Count before is " . count($themes);
	
	if (!(empty($options[hidethemes]))) {
		if (is_string($options[hidethemes])) {
			if (isset($options[hidethemes])) {
				unset($themes[$options[hidethemes]]);
				// echo $options[hidethemes] . " blev unset! ";
			}
		}
		elseif (is_array($options[hidethemes])) {
			array_keys($options[hidethemes]);
			/* echo "<pre>";
			print_r($options[hidethemes]);
			echo "</pre>"; */
			foreach ($options[hidethemes] as $key => $onoff) {
					if (array_key_exists($key, $options[hidethemes]))
					if (isset($key)) {
						unset($themes[$key]);
						// echo $key . " blev unset via array! ";
				}
			}
		}
	}
	
	// echo "<br />Count after is " . count($themes);

	
	/* Creating variable with the number of themes */
		
		
    $number_of_themes = count($themes);

    if ( !! (get_option('showcaseext_options_number_of_themes'))) {
    	$widget_theme_counter = get_option('showcaseext_options_number_of_themes');
    	if ($number_of_themes !== $widget_theme_counter) {
    		update_option('showcaseext_options_number_of_themes', $number_of_themes);
    	}
    }
    else {
    	add_option('showcaseext_options_number_of_themes', $number_of_themes);
    }
    
    if( ! (get_option('showcaseext_widget_count_themes')))
    {
    	add_option ('showcaseext_widget_count_themes', $number_of_themes);
    }
    else
    {
    	update_option ('showcaseext_widget_count_themes', $number_of_themes);
    }
    	if ($debug_mode) $debug_array['number_of_themes'] = $number_of_themes;

	if ( 1 < count($themes) ) {

		$style = '';

		$theme_names = array_keys($themes);
		natcasesort($theme_names);
	
		$separator = "";
		$col_number = 1; /* counter for use in the thumbnail index table building loop */

		if ($display_name_index) 
		{
			/*	Now building the name index header, if name index is selected
				Creating variables, which are also used in the foreach loop below */
				
			// Default title
			$name_of_name_index = __('Name Index','showcaseext');
			$anchorized_name_of_name_index = str_replace(' ','_', $name_of_name_index);
			
			// User-defined titles, if any
			if (!empty($options['user_name_index_title']))
			{
				$name_of_name_index = $options['user_name_index_title'];
			}
			
			
			$div_name_index_begin = '<div id="name_index">';
			$div_name_index_end = '</div>';
			
			$name_index_begin = $div_name_index_begin . '<h3 id="' . $anchorized_name_of_name_index . '"><a href="#' . $anchorized_name_of_name_index . '">' . $name_of_name_index . ' </a></h3><p>';
		}

		/* 	Gets the theme information from WP 
			and assigns the information for each theme to variables
			in a foreach loop */
		
		
//		if ($debug_mode) $debug_array['debug_themes_array'] = $themes;
		
		foreach ($theme_names as $theme_name) 
		{
			if ( $theme_name == $ct->name )
				continue;
			$template = $themes[$theme_name]['Template'];
			$stylesheet = $themes[$theme_name]['Stylesheet'];
			$title = $themes[$theme_name]['Title'];
			$anchorized_title = str_replace(' ', '_', $title);
				if ($debug_mode) $debug_anchorized_titles[] = $anchorized_title;
			$version = $themes[$theme_name]['Version'];
			$description = $themes[$theme_name]['Description'];
			$author = $themes[$theme_name]['Author'];
			$authoruri = $themes[$theme_name]['Author URI'];
			$screenshot = $themes[$theme_name]['Screenshot'];
			$stylesheet_dir_path = $themes[$theme_name]['Stylesheet Dir']; // local path to style directory
			$stylesheet_root_url = $themes[$theme_name]['Theme Root URI']; // URL to style root directory
			$stylesheet_dir_url = trailingslashit($stylesheet_root_url) . $template; // URL to style directory
			$tags = $themes[$theme_name]['Tags'];
			
			$theme_number += 1; // currently not used
			// echo "Theme number before if screenshot is " . $theme_number . '<br/>';

			
			// if ( $screenshot ) {
			// the previous line and the closing endif are outcommented so that we can display a screenshot placeholder
			
/*			if (is_array($options[hidethemes])) {
				if (array_key_exists($title, $options[hidethemes])) {
					$hiddenthemes = ($hiddenthemes * 1) + 1;
				}
				else { */
	
		    	/*	Assigning option variables used for the display of miniatures and custom screenshots -
		    		and for display of readme files. Also used for testing purposes */
	    		
	    		$fullsize_user_screenshot = $options['fullsize_user_screenshot'];
		    	$mediumsize_user_screenshot = $options['mediumsize_user_screenshot'];
		    	$smallsize_user_screenshot = $options['smallsize_user_screenshot'];
		    			    	
		    	$localwp = WP_CONTENT_URL; // SLETTES?
		    		if ($debug_mode) $debug_array['WP_CONTENT_URL'] = WP_CONTENT_URL;
		    		if ($debug_mode) $debug_array['localwp'] = $localwp;
		    	$localstyledir = $stylesheet_dir_path;
		    		if ($debug_mode) $debug_array['stylesheet_dir_path'] = $stylesheet_dir_path;
		    		if ($debug_mode) $debug_array['localstyledir'] = $localstyledir;
		    	$localpath = trailingslashit($stylesheet_dir_path); // 16-02-2010 changed _path to _url - shows thumbs
//		    	$localpath = trailingslashit(/* outcommented 16-02-2010 WP_CONTENT_URL . */ $localstyledir);
		    		if ($debug_mode) $debug_array['last localpath, as example'] = $localpath;
		    	$localurl = trailingslashit($stylesheet_dir_url); // URL to style/theme directory
		    		if ($debug_mode) $debug_array['last localurl, as example'] = $localurl;	
		    	$localwpdir = WP_CONTENT_DIR;
		    		if ($debug_mode) $debug_array['WP_CONTENT_DIR'] = WP_CONTENT_DIR;
		    	
		    	$local_thumbnail = $localurl . $smallsize_user_screenshot;
		    		if ($debug_mode) $debug_array['last local thumbnail, as example'] = $local_thumbnail;
		    	$path_thumbnail = $localpath . $smallsize_user_screenshot;
		    	
		    	$local_mediumsize = $localurl . $mediumsize_user_screenshot;
		    		if ($debug_mode) $debug_array['last local medium-size, as example'] = $local_mediumsize;
		    	$local_fullsize_path = trailingslashit($stylesheet_dir_path) . $fullsize_user_screenshot;
		    		if ($debug_mode) $debug_array['last local fullsize path, as example'] = $local_fullsize_path;
		    	$local_fullsize_url = $localurl . $fullsize_user_screenshot;
		    		if ($debug_mode) $debug_array['last local fullsize url, as example'] = $local_fullsize_url;			    	
	    		
	    		// $readme = $options['readme_filename']; // SLETTES
		    	// $localreadme = $localpath . $readme;
		    	//	if ($debug_mode) $debug_array['last local readme, as example'] = $localreadme;
		    	
		    	$download_instructions_directory = $options['download_instructions_directory'];
		    		if ($debug_mode) $debug_array['download instructions directory'] = $download_instructions_directory;
		    	$internal_links_directory = $options['internal_links_directory'];
		    		if ($debug_mode) $debug_array['internal links directory'] = $internal_links_directory;
		    	$debug_report_path = $options['debug_report_path'];
		    		if ($debug_mode) $debug_array['debug report path'] = $debug_report_path;

	    	
		  	/* Creation of name index, if so chosen */
		   		
		  	if ($display_name_index) {
					$name_index_content .= $separator . '<a class="name_index_links" href="#' . $anchorized_title . '">' . $title . '</a>';
					$separator = $options['user_separator'];
		
				}
	
				/* Creation of thumbnail index, if so chosen */
				
				if ($display_thumbnail_index) {
		
					/*	Variables for the creation of the thumbnail index */
					
					$number_of_columns = $options['number_of_columns'];
					$number_of_rows = ceil(($number_of_rows/$number_of_columns));
					$row_uncomplete = true;
		
					$name_of_thumbnail_index = __('Thumbnail Index','showcaseext');
					$anchorized_name_of_thumbnail_index = str_replace(' ', '_', $name_of_thumbnail_index);

					// optionally user-defined content of thumbnail index title
					
					if (!empty($options['user_thumbnail_index_title']))
					{
						$name_of_thumbnail_index = $options['user_thumbnail_index_title'];
					}

					
					$table_caption = __('Thumbnail index of %d themes','showcaseext');
					
					// optionally user-defined content of table caption
					
					if (!empty($options['user_caption']))
					{
						$table_caption = $options['user_caption'];
					}
					
					
					$click_picture_message = __('Click on a picture to see details about and test run the theme','showcaseext');
					
					
					// optionally user-defined content of messages about clicking on theme images
					
					if (!empty($options['user_click_picture_message']))
					{
						$click_picture_message = $options['user_click_picture_message'];
					}
					
					
					/*	Here the table is build for the display of thumbnails with theme names
						Building header of table */
					
					$thumbnail_index_begin = '<div id="thumbnail_index"><h3 id="' . $anchorized_name_of_thumbnail_index . '"><a href="#' . $anchorized_name_of_thumbnail_index . '">' . $name_of_thumbnail_index . '</a></h3>' . '<table><caption>' . '<span id="number_of_thumbnail_index_themes">' . sprintf(__($table_caption,'showcaseext'), $number_of_themes) . '</span><br /><span id="click_picture_message">' . $click_picture_message . '</span><br />';
					
					if ($display_name_index) 
					{
						$thumbnail_index_begin .= '<span id="jump_to_name_index_in_thumbnail_index">' . __('Or jump to ','showcaseext') . '<a href="#' . $anchorized_name_of_name_index . '">' . $name_of_name_index . '</a>' . '</span></caption>';
					} else 
					{ 
						$thumbnail_index_begin .= '</caption>';
					}
					
					/* Building content of table, i.e. building rows */
					
					if ($col_number == 1) 
					{
						$thumbnail_index_content .= '<tr>';
					}
				
					if (!(file_exists($path_thumbnail))) {
						// echo "thumbnail does not exist";
						$local_thumbnail = SHOWCASEEXT_URL . 'images/placeholder.png';
					}
					
					$thumbnail_index_content .= '<td><a href="#' . $anchorized_title . '"><img title="' . $title . '" alt="' . $anchorized_title . '" src="' . $local_thumbnail . '" /></a>' . '<p class="thumb_themenames">' . $title . '</p></td>';
					
				
					if ($col_number == $number_of_columns) 
					{
						$thumbnail_index_content .= '</tr>';
						$col_number = 0;
						$row_uncomplete = false;
					}
					
					$col_number = $col_number + 1;
		
					if ($row_uncomplete)
					{
						$thumbnail_index_end = '</tr></table></div>';
					}
					else
					{
						$thumbnail_index_end = '</table></div>';
					}
		
				} /* end of if display_thumbnail_index section */
		
				/*	Creates clickable H3-header with theme name and
					creates an id as well as a clickable link. */
				
				$showcase .= '<div class="theme"><h3 class="theme_headers" id="' . $anchorized_title . '"><a href="#' . $anchorized_title . '">' . $title . '</a></h3>';
		
				/* 	Creates thumbnails and, if so configured, information about theme author, description and version 
					
					as well as a clickable link to the readme.txt file 
					NOTE that the plugin user is responsible for creating the readme.txt file if it is not included with the theme */
		
				
				// Inserts theme image with link to full-size edition, if so chosen and if available
				
				$showcaseTmp2begin = '';
				$showcaseTmp2end = '';
				$showcaseTmp2 = '';
				
				if ($display_fullsize_images) {
					if ($include_shutter_class) {
						$showcaseTmp2begin .= '<a class="link_images shutterset_mini"';
					}
					else {
						$showcaseTmp2begin .= '<a class=link_images"';
					}
					
					if (file_exists($local_fullsize_path)) {
						$local_fullsize_debug[] = 'Local fullsize image is found: <br/> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ' . $local_fullsize_url;
						
						$showcaseTmp2begin .= ' href="' . $local_fullsize_url . '" target="_blank">';
					}
					else {
						$local_fullsize_debug[] = 'Warning: The following local fullsize image file was not found<br/> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ' . $local_fullsize_url;
					}
					$showcaseTmp2end .= '</a>';
										
				}
				else {
					$showcaseTmp2end = '';
				}
				
				
				/**	producing HTML code for the display of the medium-size theme image,
				 *  assigned to the tmp variable showcase2tmp;
				 *  the first filename that matches a theme image file will be used
				 */

				/** $file_found_counter primarily used for returning correct grammatical numerus
				 *  and for debugging purposes
				 */

				$file_found_counter = 0;
				
				// loop through possible screenshot filenames
				foreach ($mediumsize_filenames as $mediumsize_filename) {

					// generates URI for file_exists and for use in the output

					$path_and_mediumsizefile = trailingslashit($stylesheet_dir_path) . $mediumsize_filename;
					$url_and_mediumsizefile = $localurl . $mediumsize_filename; // 16-02-2010 changed $localpath to $localurl
					$absolute_path = $localwpdir . $stylesheet_dir_path;
					
					if ($debug_mode) {
						$local_mediumsize_debug[] = 'Mediumsize filename is: ' . $mediumsize_filename . '';
						$local_mediumsize_debug[] = 'Mediumsize URL er  <br/> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ' . $url_and_mediumsizefile . '';
						$local_mediumsize_debug[] = 'Mediumsize path and filename is<br/> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ' . $path_and_mediumsizefile . '';
					}
					
					
					if (file_exists($path_and_mediumsizefile)) {

						$file_found_counter++;
						
						if ($file_found_counter == 1) {
							if ($debug_mode) {
								$local_mediumsize_debug[] = 'File found counter is now: ' . $file_found_counter . '';
								$local_mediumsize_debug[] = 'The following file has been found: <br/> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ' . $path_and_mediumsizefile . '';
								$local_mediumsize_debug[] = 'The following URL will be used: <br/> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ' . $localpath . $mediumsize_filename;
							}
							$showcaseTmp2 = '';
							$showcaseTmp2 .= '<img class="theme_images" src="' . $url_and_mediumsizefile . '" alt="' . __('Let me test run this theme','showcaseext') . '" />';

						}
						if ($file_found_counter > 1) {
							if ($display_additional_screenshots)
							{
								if ($debug_mode) {
									$local_additional_screenshots[] = 'Right now the file found counter for ' . $title . ' is ' . $file_found_counter . '';
									$local_additional_screenshots[] = 'Additional screenshots are included ...: <br/> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ' . $path_and_mediumsizefile;
								}
								if ($include_shutter_class_2) {
									$additional_screenshots .= ' <a class="shutterset_additional"';
									if ($debug_mode) $local_additional_screenshots[] = 'Shutter class additional included';
								}
								else {
									$additional_screenshots .= ' <a';
								}
								
								$additional_screenshots .= ' href="' . $localpath . $mediumsize_filename . '" title="' . __('Additional screenshot','showcaseext') . '" />' . $mediumsize_filename . '</a>';
							}
							else {
								break; // out of foreach loop
							}
							if ($file_found_counter == 2) {
								$additional_screenshots_begin = '<p><span class="theme_info_intro">' . __('Extra screenshot:','showcaseext') . '</span> <span class="additional_images_link">';
							}
							elseif ($file_found_counter > 2) {
								$additional_screenshots_begin = '<p><span class="theme_info_intro">' . __('Extra screenshots:','showcaseext') . '</span> <span class="additional_images_link">';
							}

							$additional_screenshots_end .= '</span></p>';
						}
					}
					else {

					//					}
					}
				}
				if ($file_found_counter == 0) {
					
					// Insert placeholder instead of missing screenshot
					$showcaseTmp2 = '';
					$showcaseTmp2 .= '<img class="theme_images" src="' . SHOWCASEEXT_URL . 'images/placeholder300.png' . '" alt="' . __('Let me test run this theme','showcaseext') . '" />';
				}
				
				$showcase .= $showcaseTmp2begin . $showcaseTmp2 . $showcaseTmp2end;
				

				if ($display_author) 
				{
//					$showcase .= '<p class="theme_author"><span class="theme_info_intro">' . __('Author: ','showcaseext') . '</span> <span class="theme_author_link"> <a target="_blank" href="' . $authoruri . '">' . $author . '</a></span></p>
					$showcase .= '<p class="theme_author"><span class="theme_info_intro">' . __('Author: ','showcaseext') . '</span> <span class="theme_author_link">' /* <a target="_blank" href="' . $authoruri . '">' */ . $author . '</span></p>
					';
				}
		
				if ($display_description) 
				{
					$theme_description_directory = $options['theme_description_directory'];
					$user_description_file = trailingslashit(trailingslashit(WP_CONTENT_DIR) . $theme_description_directory) . $anchorized_title . '.txt';
					if ($debug_mode) $local_user_description_file[] = 'User description file is <br/> &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;' . $user_description_file;
					
					if (file_exists($user_description_file))
					{
						if ($debug_mode) $local_user_description_file[] = 'User description file ' . $user_description_file . ' is found!';
						$user_description = file_get_contents ($user_description_file);
						
						$showcase .= '<p><span class="theme_info_intro">' . __('Description of version ','showcaseext') . $version . ':</span> <span class="theme_description">'. $user_description . '</span></p>
						';
					}
					else
					{
						$showcase .= '<p><span class="theme_info_intro">' . __('Description of version ','showcaseext') . $version . ':</span> <span class="theme_description">'. $description . '</span></p>
						';
						if ($debug_mode) $local_user_description_file[] = 'User description file ' . $user_description_file . ' is not found!';
					}
				}
				
				if ($display_readme_link) {
					$readmepath = $stylesheet_dir_path; // HERTIL i arbejdet med ny widget
					$showcaseTmp = '';
					$readme_file_counter = 0;
					
					foreach ($readme_filenames as $readme_file) {
						$path_and_readmefile = trailingslashit($readmepath) . $readme_file;
							if ($debug_mode) $local_readme_files[] = 'Local path and readme file is ' . $path_and_readmefile;
						if (file_exists($path_and_readmefile)) {
							$readme_file_counter++;
							if ($debug_mode) $local_readme_files[] = 'Found ' . $path_and_readmefile . '';
							if ($debug_mode) $local_readme_files[] = 'Readme file counter is ' . $readme_file_counter . '';
							
							if ($readme_file_counter > 1) $showcaseTmp .= ' ';
							$showcaseTmp .= '<a href="' . trailingslashit($stylesheet_dir_url) . $readme_file . '">' . $readme_file . '</a>';
							
						}
					}
					if (!($readme_file_counter === 0)) {
						if ($readme_file_counter == 1) {
							$showcase .= '<p><span class="theme_info_intro">' . __('Read the readme file:','showcaseext') . '</span> <span class="theme_readmelinks">' . $showcaseTmp;
						}
						elseif ($readme_file_counter > 1) {
							$showcase .= '<p><span class="theme_info_intro">' . __('Read the readme files:','showcaseext') . '</span> <span class="theme_readmelinks">' . $showcaseTmp;
						}
						$showcase .= '</span></p>
						';
					}
				}

				if ($display_additional_screenshots)
				{
					$showcase .= $additional_screenshots_begin . $additional_screenshots . $additional_screenshots_end;
					$additional_screenshots_begin = '';
					$additional_screenshots = '';
					$additional_screenshots_end = '';
				}

				if ($display_tags) {
		
					/* 	If $tags contain any tags,
						then a foreach-loop reads the $tags array for use by the form builder below */
					
					if (!empty($tags)) {
					
						$formtags = ''; /* resetting variables */
						$formtagsseparator = ''; /* resetting variables */
						foreach ($tags as $tag)  {
							$spacechar = ' ';
							$replacechar = '-';
							$new_tmp_tag = str_replace($spacechar, $replacechar, $tag);
							$new_tag = strtolower($new_tmp_tag);
							$formtags = $formtags . $formtagsseparator . $new_tag;
							$formtagsseparator = ', ';
						}
					
						/* tags building completed; now use the variable! */
						
						$showcase .= '<p><span class="theme_info_intro">' . __('The developer\'s tags','showcaseext') . ':</span> <span class="theme_tags">' . $formtags . '</span>';


						/*	if so chosen, tags will now be translated, using the appropriate locale */
						
						if ($display_translated_tags) {
						
							/* Translating the possible variables into, e.g., Danish -- first, set up the array with tags and translations */
						
							// Colors						
						
						    $tags_en[0] = '/black/';								$tags_i18n[0] = __('black','showcaseext'); 
							$tags_en[1] = '/blue/';									$tags_i18n[1] = __('blue','showcaseext');
							$tags_en[2] = '/brown/';								$tags_i18n[2] = __('brown','showcaseext');
							$tags_en[3] = '/green/';								$tags_i18n[3] = __('green','showcaseext');
						    $tags_en[4] = '/orange/';								$tags_i18n[4] = __('orange','showcaseext');
						    $tags_en[5] = '/pink/';									$tags_i18n[5] = __('pink','showcaseext');
						    $tags_en[6] = '/purple/';								$tags_i18n[6] = __('purple','showcaseext');
						    $tags_en[7] = '/red/';									$tags_i18n[7] = __('red','showcaseext');
						    $tags_en[8] = '/silver/';								$tags_i18n[8] = __('silver','showcaseext');
						    $tags_en[9] = '/tan/';									$tags_i18n[9] = __('tan','showcaseext');
						    $tags_en[10] = '/white/';								$tags_i18n[10] = __('white','showcaseext');
						    $tags_en[11] = '/yellow/';								$tags_i18n[11] = __('yellow','showcaseext');
						    $tags_en[12] = '/dark/';								$tags_i18n[12] = __('dark','showcaseext');
						    $tags_en[13] = '/light/';								$tags_i18n[13] = __('light','showcaseext');

							// Columns

						    $tags_en[14] = '/one-column/';							$tags_i18n[14] = __('one-column','showcaseext');
						    $tags_en[15] = '/two-columns/';							$tags_i18n[15] = __('two-column','showcaseext');
						    $tags_en[16] = '/three-columns/';						$tags_i18n[16] = __('three-column','showcaseext');
						    $tags_en[17] = '/four-columns/';						$tags_i18n[17] = __('four-column','showcaseext');
						    $tags_en[18] = '/left-sidebar/';						$tags_i18n[18] = __('left-sidebar','showcaseext');
						    $tags_en[19] = '/right-sidebar/';						$tags_i18n[19] = __('right-sidebar','showcaseext');

							// Features

						    $tags_en[20] = '/custom-colors/';						$tags_i18n[20] = __('custom-colors','showcaseext');
						    $tags_en[21] = '/custom-header/';						$tags_i18n[21] = __('custom-header','showcaseext');
						    $tags_en[22] = '/theme-options/';						$tags_i18n[22] = __('theme-options','showcaseext');
						    $tags_en[23] = '/threaded-comments/';					$tags_i18n[23] = __('threaded-comments','showcaseext');
						    $tags_en[24] = '/sticky-post/';							$tags_i18n[24] = __('sticky-post','showcaseext');
								$tags_en[25] = '/microformats/';						$tags_i18n[25] = __('microformat','showcaseext');
						    

							// Subject

						    $tags_en[26] = '/holiday/';								$tags_i18n[26] = __('holiday','showcaseext');
						    $tags_en[27] = '/photoblogging/';						$tags_i18n[27] = __('photoblogging','showcaseext');
						    $tags_en[28] = '/seasonal/';							$tags_i18n[28] = __('seasonal','showcaseext');
						    
							// Width and developer-defined width
						    
						   	$tags_en[29] = '/fixed-width/';							$tags_i18n[29] = __('fixed-width','showcaseext');
						   	$tags_en[38] = '/flexible-width/';						$tags_i18n[38] = __('flexible-width','showcaseext');

							// Developer-defined tags - validation, SEO, etc.

						    $tags_en[30] = '/valid-CSS/';							$tags_i18n[30] = __('valid-css','showcaseext');
						    $tags_en[31] = '/valid-XHTML/';							$tags_i18n[31] = __('valid-XHTML','showcaseext');
						    $tags_en[32] = '/SEO-friendly/';						$tags_i18n[32] = __('SEO-friendly','showcaseext');
						    $tags_en[33] = '/clean/';								$tags_i18n[33] = __('clean','showcaseext');
						    $tags_en[34] = '/gray/';								$tags_i18n[34] = __('gray','showcaseext');
						    $tags_en[35] = '/widget-ready/';						$tags_i18n[35] = __('widget-ready','showcaseext');
						    $tags_en[36] = '/simple/';								$tags_i18n[36] = __('simple','showcaseext');
						    $tags_en[37] = '/gravatars/';							$tags_i18n[37] = __('gravatars','showcaseext');

						    $tags_en[39] = '/grid-based/';							$tags_i18n[39] = __('grid-based','showcaseext');
						    $tags_en[40] = '/blank-slate/';							$tags_i18n[40] = __('blank-slate','showcaseext');
						    $tags_en[41] = '/starter-theme/';						$tags_i18n[41] = __('starter-theme','showcaseext');
						    $tags_en[42] = '/variable-width/';						$tags_i18n[42] = __('variable-width','showcaseext');
						    $tags_en[43] = '/mantle-color/';						$tags_i18n[43] = __('mantle-color','showcaseext');
						    $tags_en[44] = '/grey/';								$tags_i18n[44] = __('grey','showcaseext');
						    
						    // New features
						    
						    $tags_en[45] = '/rtl-language-support/';				$tags_i18n[45] = __('rtl-language-support','showcaseext');
						    $tags_en[46] = '/translation-ready/';					$tags_i18n[46] = __('translation-ready','showcaseext');
						    $tags_en[47] = '/front-page-post-form/';				$tags_i18n[47] = __('front-page-post-form','showcaseext');
						    $tags_en[48] = '/widgets/';								$tags_i18n[48] = __('widgets','showcaseext');
						    
						    
						
							/* Now, replace the original tags with the translated tags */
							
							$showcase_translatedtags = preg_replace($tags_en, $tags_i18n, $formtags);


							/* Now, use the translated strings */
							
							$showcase .= ' &middot; <span class="theme_info_intro">' . __('Translation:','showcaseext') . '</span> <span class="theme_tags_translated">' . $showcase_translatedtags . '</span></p>
							';
						
						} /* here is the endif for the if($display_translated_tags) above */

					} /* here is the endif for the if(empty($tags)) above */

				} /* here is the endif for the if($display_tags) above */
		
				
				if ($display_test_run_link)
				{
					$nopreview_file = trailingslashit($stylesheet_dir_path) . $anchorized_title . '_no_preview.txt';
						$internal_variables['last nopreview_file'] = $nopreview_file;
					if (!(file_exists($nopreview_file))) {

						/* Now displaying a link for test running the theme(s) */
	
						$showcase .= '<p><span class="theme_testrun2_intro">' . __('Let me test run this theme','showcaseext') . ':</span> <a href="' . get_bloginfo('url') . '/?preview_theme=' . $theme_name . '" target="_blank" title="' . __('Let me test run this theme','showcaseext') . '"><span class="theme_testrun2_link">' . __('Run','showcaseext') . '</span></a></p>
						';
					}
					else {
						
						$showcase .= '<p><span class="theme_nopreview">' . __('Sorry, test run is not available for this theme','showcaseext') . '</span></p>
						';
					}
				}


				if ($display_download_instruction) 
				{
					$download_instruction_file = trailingslashit(trailingslashit($localwpdir) . $download_instructions_directory) . $anchorized_title . '.txt';
					if ($debug_mode) $local_download_instructions[] = 'Download instruction file is ' . $download_instruction_file;
					
					if (file_exists($download_instruction_file))
					{
						if ($debug_mode) $local_download_instructions[] = 'Download instruction file ' . $download_instruction_file . ' is found!';
						$dl_instruction = file_get_contents ($download_instruction_file);
						
						$showcase .= '<p><span class="theme_info_intro">' . __('Download instructions','showcaseext') . ':</span> <span class="download_instructions">'. $dl_instruction . '</span></p>';

					}
				}
				
				if ($display_dlm_download_link) 
				{

					if (function_exists('wp_dlm_shortcode_download')) {
					
						$download_dlm_instruction_file = trailingslashit(trailingslashit($localwpdir) . $download_instructions_directory) . $anchorized_title . '_id.txt';
						if ($debug_mode) $local_dlm_download_links[] = 'Download dlm instruction link file is ' . $download_dlm_instruction_file;
						
						if (file_exists($download_dlm_instruction_file))
						{
							if ($debug_mode) $local_dlm_download_links[] = 'Download dlm instruction link file ' . $download_dlm_instruction_file . ' is found!';
							$dl_dlm_tmp = file_get_contents ($download_dlm_instruction_file);
							settype($dl_dlm_tmp, "integer");
							$dl_dlm_instruction = '[download id="' . $dl_dlm_tmp . '"]';
							
							$dlm_instruction = do_shortcode($dl_dlm_instruction);
							
							$showcase .= '<p><span class="theme_info_intro">' . __('Internal WordPress Download Monitor link','showcaseext') . ':</span> <span class="download_dlm_instructions">'. $dlm_instruction . '</span></p>
							';
	
						}
					}
				}
				
				if ($display_internal_links) 
				{
					$internal_links_file = trailingslashit(trailingslashit($localwpdir) . $internal_links_directory) . $anchorized_title . '.txt';
						if ($debug_mode) $local_internal_links[] = 'Internal links file is ' . $internal_links_file;
					
					if (file_exists($internal_links_file))
					{
						if ($debug_mode) $local_internal_links[] = 'Internal_links file ' . $internal_links_file . ' is found!';
						$internal_links = file_get_contents ($internal_links_file);
						
						$showcase .= '<p><span class="theme_info_intro">' . __('See also','showcaseext') . ':</span> <span class="internal_links">'. $internal_links . '</span></p>
						';
					}
				}


				// Generating widget data if so chosen in the Showcase ext options
				if ($generate_widget_code)
				{
					// resetting variables for the use of this section
					$showcaseext_current_no_save = false;
					$showcaseext_last_widget_time_save = false;
					$showcaseext_widget_theme_code_save = false;

					// assigning default value for widget update_frequency
					$scew_update_frequency = 20;
					// reading widget option for update frequency, if it is set
					if ( !! (get_option('showcaseext_options_update_frequency'))) {
						$scew_update_frequency = get_option('showcaseext_options_update_frequency');
					}
					
					/** Continues with last theme number or, if non-existent, begins with theme number 1
					 * (theme numbers change when new themes are installed
					 *  in the long run all themes will be displayed one by one
					 *  unless a no_preview file exists for a given theme
					 **/
					if ( !! (get_option('showcaseext_current_no')))
					{
						$showcaseext_current_no = get_option('showcaseext_current_no');
						// echo 'Current saved no. is ' . $showcaseext_current_no . '<br/>';
						if ($debug_mode) $debug_array['Widget: Current saved theme number'] = $showcaseext_current_no;
					}
					else
					{
						$showcaseext_current_no = 1;
						add_option('showcaseext_current_no', $showcaseext_current_no);
					}
					
					/** The widget creation statements below saves a value
					 *  that defines when the widget creation statement will run again
					 *  and make the widget display the next theme thumbnail.
					 *  It reads the current time
					 *  and adds the number of minutes defined in the widget control.
					 */

					if ( !! (get_option('showcaseext_last_widget_time')))
					{
						$showcaseext_last_widget_time = get_option('showcaseext_last_widget_time');
						if ($debug_mode) $debug_array['showcaseext_last_widget_time GMT'] = date('j. F Y H.i', $showcaseext_last_widget_time);
					}
					else
					{
						$showcaseext_last_widget_time = (time() + ($scew_update_frequency * 60)); // now plus one hour
						add_option('showcaseext_last_widget_time', $showcaseext_last_widget_time);
					}
					
					// The next statements check that a page id is entered in the widget control
					
					if ( !! (get_option('showcaseext_options_pageid')))
					{
						$scew_pageid = get_option('showcaseext_options_pageid');
					}
					else
					{
						echo "No page id entered in the widget control. Please add it!";
					}

					/** If it is time for generating a new widget code snippet,
					 *  then generate
					 */					

					if ($showcaseext_last_widget_time < time())	{

						if ($debug_mode) $debug_array['Widget time'] = "Widget time less than now. Widget should update";

						/** Only generate new code snippet for widget, if it is the right theme number
						 *  Remeber that each run of this plugin loops through all the themes returned by get_themes()
						 */
						 
						if ($showcaseext_current_no == $theme_number) {
							
							// Now generate the widget code snippet, please
							$showcaseext_widget_theme_code = '<a href="' . get_bloginfo('siteurl') . '/?page_id=' . $scew_pageid . '#' . $anchorized_title . '" title="' . $title . '" ><img alt="' . $anchorized_title . '" src="' . $local_thumbnail . '" /></a>';
							
							// echo "<br/>Now using $title<br/> and code:<pre>" . $showcaseext_widget_theme_code . '</pre>';
							$showcaseext_widget_theme_code_save = true;
							
							$showcaseext_current_no++;
							$showcaseext_current_no_save = true;
							
							// computes time for next creation of theme code:
							// now plus either the time chosen in the widget control or the default value of twenty minutes
							$showcaseext_last_widget_time = (time() + ($scew_update_frequency * 60));
							$showcaseext_last_widget_time_save = true;
						
						}
						else
						{
							// No statements here
						}
					}
					else
					{
						if ($debug_mode) $debug_array['Widget time'] = 'Just wait about ' . ($showcaseext_last_widget_time - time()) . ' sekunder!';
					}
					
					// Ensure that no non-existing theme number is used
					if ($showcaseext_current_no > $number_of_themes)
					{
						$showcaseext_current_no = 1;
						$showcaseext_current_no_save = true;
					}
						
					if ($showcaseext_current_no_save)
					{
						update_option('showcaseext_current_no', $showcaseext_current_no);
					}
					
					// save updated time for next creation of widget code
					if ($showcaseext_last_widget_time_save)
					{
						update_option('showcaseext_last_widget_time', $showcaseext_last_widget_time);
					}
					
					// save code that widget uses for the display of a theme thumbnail etc.
					if ($showcaseext_widget_theme_code_save)
					{
						update_option('showcaseext_widget_theme_code', $showcaseext_widget_theme_code);
					}	

					
					// echo 'Current theme is ' . $title . '<br/>';
					// echo 'Current theme no. is ' . $theme_number . '<br/>';
					// echo 'Saved after: ' . date("j. F Y H.i.s", $showcaseext_last_widget_time) . '<br/>';
					// echo 'Current after: ' . date("j. F Y H.i.s", time()) . '<br/><br/>';
				}					

				/*	Now, finally, adding link for going to the thumbnail and/or name index
					First the initial <p> tag surrounding the jump links */
				
				$showcase .= '<p class="jumps">';

				if ($display_name_index) 
				{
					$showcase .= __('Jump to','showcaseext') . ' <a href="#' . $anchorized_name_of_name_index . '">' . $name_of_name_index . '</a> ';
				}
				
				if ($display_name_index && $display_thumbnail_index) /* adding separator, if both */ 
				{
					$showcase .= $separator;
				}
				
				if ($display_thumbnail_index) 
				{
					 $showcase .= __('Jump to','showcaseext') . ' <a href="#' . $anchorized_name_of_thumbnail_index . '">' . $name_of_thumbnail_index . '</a>';
				}
					

				/* 	Now, finalizing the html for each theme, including the closing <p> tag 
					the <div> tags resets the image float:left declaration above.
					The final </div> tag closes the <div class="theme"> above. */ 

				$showcase .= '</p><div style="clear: left"></div></div>';
//					} /* end of if is_array */
//				}	  /* end of if in_array */
				
//			} /* end of if screenshot */
	
		}
	
	}
		

	/* 	Now building an index summary with the number of themes
    	Using the variables in the end of the index form */

    if ($display_name_index) 
    {
    	$name_index_end = $separator . '<span id="total_theme_number">' . sprintf(__("%d themes in total",'showcaseext'),$number_of_themes)  . '</span></p>
    	' . $div_name_index_end;
    } 
    else 
    {
    	$name_index_end = '
    	' . $div_name_index_end;
    } 
    

	/* 	Adding <div> tags to the showcase proper */
	
	$showcase = '<div id="showcase">' . $showcase . '</div>';


	/* 	Completing last row if so chosen by the user */
	
	if ($row_uncomplete && $complete_last_row)
	{
		$missing_column = $number_of_columns - $col_number + 1; /* +1 because $col_number has already been incremented */
		
		for ($i = 1; $i <= $missing_column; $i++)
		{
			$thumbnail_rest = $thumbnail_rest . '<td>&nbsp;</td>';
		}
	}


	/*	Building the Showcase ext output */	

	$name_index = $name_index_begin . $name_index_content . $name_index_end;
	$thumbnail_index = $thumbnail_index_begin . $thumbnail_index_content . $thumbnail_rest . $thumbnail_index_end;

	if ($reverse_order_of_indices)
	{
		$returnform = $thumbnail_index . $name_index . $showcase;
	}
	else
	{
		$returnform = $name_index . $thumbnail_index . $showcase;
	}


	if ($display_acknowledgement)
	{
		$acknowledgement .= __('<a href="http://wordpress.blogos.dk/showcaseext/">WP Theme Showcase ext and i18n</a> is developed by <a href="http://wordpress.blogos.dk/showcaseext/">GeorgWP</a>','showcaseext');
			if ($debug_mode) $debug_array['acknowledgement'] = $acknowledgement;
		
		$returnform .= '<div id="acknowledgement">' . $acknowledgement;
		
		if ($display_translator_acknowledgement)
		{
			$translator_acknowledgement .= __(" and kindly translated by <insert translator's name here>)", 'showcaseext');
		if ($debug_mode) $debug_array['translator_acknowledgement'] = $translator_acknowledgement;
			$returnform .= $translator_acknowledgement;
		}
		
		$returnform .= '</div>';

	}


	/*	if debug mode is enabled and if the debug report is to be included on the showcase page
		then include the debug report and return the entire output; else return the output */

	if ($debug_mode) {
		include('showcaseext-debug-report.php');
	}
	else {
		$returnform = '<div id="showcaseext">' . $returnform . '</div>';
	}
	
	if ($generate_widget_code) {
		if ( !! (get_option('showcaseext_widget')))
		{
			update_option('showcaseext_widget', $showcaseext_widget_array);
		}
		else {
			add_option('showcaseext_widget', $showcaseext_widget_array);
		}
	}
		
	
	
	
//	return str_replace('[showcaseext]', $returnform, $content);

//	new return for short-code mode

	return $returnform;

}
add_shortcode('showcaseext', 'showcaseext_function'); // registers the shortcode [showcaseext]


/* The next section contains to procedures and a hook register function 
 * for setting up the showcaseext options at first-time activation of a given version
 */

function showcaseext_activate() {
	// global $options; for later use
	
	$options = array
	(
		'current_version' => SHOWCASEEXT_VERSION,
		'display_name_index' => 'on',
		'display_thumbnail_index' => 'on',
		'display_fullsize_images' => 'on',
		'include_shutter_class' => 'on',
		'display_additional_screenshots' => 'off',
		'include_shutter_class_2' => 'on',
		'display_author' => 'on',
		'display_description' => 'on',
		'display_readme_link' => 'off',
		'display_tags' => 'on',
		'display_translated_tags' => 'on',
		'display_download_instruction' => 'off',
		'download_instructions_directory' => 'dl_instructions',
		'display_user_theme_description' => 'off',
		'theme_description_directory' => 'theme_descriptions',
		'reverse_order_of_indices' => 'off',
		'fullsize_user_screenshot' => 'screenshot.png',
		'mediumsize_user_screenshot' => 'screenshot.png',
		'smallsize_user_screenshot' => 'screenshot.png',
		'number_of_columns' => 5,
		'complete_last_row' => 'off',
		'user_separator' => '&nbsp;&middot; ',
		'debug_mode' => 'off',
		'dump_debug_report' => 'off',
		'dump_debug_report_all' => 'off',
		'debug_report_path' => '',
		'readme_filenames' => 'readme readme.txt readme.htm readme.html readme.pdf readme.rtf',
		'display_acknowledgement' => 'off',
		'display_translator_acknowledgement' => 'off',
		'display_widget_credit' => 'off',
		'generate_widget_code' => 'off',
		'display_internal_links' => 'off',
		'internal_links_directory' => 'internal_links'
	);
	
	if (!get_option('showcaseext_options')) {
		add_option ('showcaseext_options', $options, '', '');
	}
	else {
	// updating function not developed yet; will be included in the next version
	}
}
register_activation_hook(__FILE__, 'showcaseext_activate'); // this function initializes showcaseext_activate()


/* The next section contains three procedures and a hook register function 
 * for resetting and deleting the showcaseext options
 */


function deleteAllOptions() {
	$OptionsToBeDeleted = "showcaseext_options showcaseext_S_POST showcaseext_widget showcaseext_widgetoptions showcaseext_options_number_of_themes showcaseext_widget_count_themes showcaseext_current_no showcaseext_last_widget_time showcaseext_options_widgettitle showcaseext_options_widgetcaption showcaseext_options_pageid showcaseext_options_update_frequency showcaseext showcase_widget showcase_widget_count_themes showcase_widget_counter showcase_widget_counter showcase_widget showcase_widget_count_themes showcase_widget_counter";
	 
	$delAllOptions = explode(" ", $OptionsToBeDeleted);
	
	foreach ($delAllOptions as $delAllOption) {
		if(!!(get_option($delAllOption))) {
			delete_option($delAllOption);
		}		
	}
	
	/*
	
	// general options
	delete_option ('showcaseext_options');
	
	// used by plugin for debugging purposes
	delete_option ('showcaseext_S_POST'); //used for debugging

	// used by widget or widget generating code
	delete_option ('showcaseext_widget');
	delete_option ('showcaseext_widgetoptions');
	delete_option ('showcaseext_options_number_of_themes');
	delete_option ('showcaseext_widget_count_themes');
	delete_option ('showcaseext_current_no');
	delete_option ('showcaseext_last_widget_time');
	delete_option ('showcaseext_widget_theme_code');
	delete_option ('showcaseext_options_widgettitle');
	delete_option ('showcaseext_options_widgetcaption');
	delete_option ('showcaseext_options_pageid');
	delete_option ('showcaseext_options_update_frequency');

	// legacy options that will be deleted if still present
	delete_option ('showcaseext');
	delete_option ('showcase_widget');
	delete_option ('showcase_widget_count_themes');
	delete_option ('showcase_widget_counter');
	delete_option ('showcase_widget');
	delete_option ('showcase_widget_count_themes');
	delete_option ('showcase_widget_counter');
	*/
}





function resetAllOptions() {
	echo "resetter ...";
	// first, delete all options
	deleteAllOptions();
	
	// then, set up all options
	showcaseext_activate();
}

function showcaseext_deactivate() {

		$options = get_option('showcaseext_options');

		// check whether the user wants to reset or delete options
		if (!(empty($options['reset_showcaseext_options']))) resetAllOptions();
		if (!(empty($options['delete_showcaseext_options']))) deleteAllOptions();
}
register_deactivation_hook(__FILE__, 'showcaseext_deactivate'); // this function initializes showcaseext_deactivate()

function showcaseext_option_menu() {
	// display the admin options subpage under Appearance
add_theme_page(__('WP Theme Showcase ext and i18n Options','showcaseext'), __('Showcase Options','showcaseext'), 'manage_options', 'theme-showcase-ext.php', 'showcaseext_options_page');
// add_submenu_page(__FILE__, __('Edit Table of Contents','showcaseext'),  __('TOC','showcaseext') , 'admin_options', __FILE__, 'showcaseext_toc');

} 
add_action('admin_menu', 'showcaseext_option_menu'); // initializes the plugin options page

function POST_variable_reader()
{
			// get options and set path and filename for dump report
			
			$optionshere = get_option('showcaseext');
			
			if (!($optionshere['debug_mode'] == 'on')) return;
			
			
			// read $_POST variable and copy the keys and values to an array that can be joined
			
			$S_POST = array();
			foreach ($_POST as $key => $value)
			{
				$S_POST_tmp[] = "$key = $value";
			}
		
			$S_POST_tmp['Date_and_time_for_submittance'] = date ('Y-m-d H:i:s');
			
			$S_POST = join ("##", $S_POST_tmp);
			unset($S_POST_tmp);
			
			// save for use in the debug report (see showcaseext-debug-report.php)
			
			if (!get_option('showcaseext_S_POST'))
			{ 
				add_option('showcaseext_S_POST', $S_POST);
			}
			else
			{
				update_option('showcaseext_S_POST', $S_POST);
			}
			
}


function showcaseext_validate_path ($sce_user_path)
{
	$sce_user_path_tmp = untrailingslashit(trim($sce_user_path));
	
	if ( (false !== strpos($sce_user_path_tmp, '..')) || (false !== strpos($sce_user_path_tmp, './')) || (':' == substr($sce_user_path_tmp, 1, 1)) )
	{
		_e('Path validation error!','showcaseext');
		echo '<br/>' . _e('Path is reset to nothing.','showcaseext');
		$sce_user_path_tmp = '';
	}
	$sce_user_path = $sce_user_path_tmp;
	return $sce_user_path;
}
	

function showcaseext_options_page()
{
	global $debug_mode, $debug_array, $S_POST, $showcase_plugin_url;

	include ('showcaseext-options-page.php');
	
}		

function showcaseext_widget( $args = array() ) {
	
	$showcaseext_widget_version = '2.5'; // remember to update variable before release - HUSK
	// extracts the parameters
	
	extract($args);
	
	// get our options
	
	if ( !! (get_option('showcaseext_options_widgettitle'))) {
		$scew_title = get_option('showcaseext_options_widgettitle');
	}
	if ( !! (get_option('showcaseext_options_widgetcaption'))) {
		$scew_caption = get_option('showcaseext_options_widgetcaption');
	}
	if ( !! (get_option('showcaseext_options_pageid'))) { 
		$scew_pageid = get_option('showcaseext_options_pageid');
	}
	if ( !! (get_option('showcaseext_options_number_of_themes'))) {
		$scew_number_of_themes = get_option('showcaseext_options_number_of_themes');
	}
	
	// print the compatibility code
	
	echo $before_widget;

	// only echo title section if there is a title
	if (!(empty($scew_title)))
	{
		echo $before_title . $scew_title . $after_title;
	}
	
	// only echo content of widget if there is a theme thumbnail to display
	if ( !! (get_option('showcaseext_widget_theme_code')))
	{
		$showcaseext_widget_thumbnail = get_option('showcaseext_widget_theme_code');
	
		echo '<div id="showcaseext_widget">'; // open main div for showcaseext widget
		echo '<table>'; // open table tag
		echo '<caption><a href="' . trailingslashit(get_bloginfo('url')) . '?page_id=' . $scew_pageid . '">'; // open caption tag and echo beginning of link tag
		
		// echo user defined link text for caption		
		if (!(empty($scew_caption))) {
			echo sprintf($scew_caption, $scew_number_of_themes);
		}
		// or the default caption, if no user defined caption
		else {
			echo sprintf(__('Visit my Theme Showcase with %d&nbsp;themes','showcaseext'), $scew_number_of_themes);
		}
		
		echo '</a></caption>'; // close link tag and caption tag
		echo '<tr><td>'; // echo begin of table content (open row, new data cell)
		
		echo $showcaseext_widget_thumbnail; // display theme thumbnail
		echo '</td></tr></table>'; // close data cell, row and table

		/* don't show credit with external link
		 * unless the user has permitted it
		 */
		 
		if ( !! (get_option('showcaseext_options'))) {
			$showcaseext_widgetTmpOptions = get_option('showcaseext_options');
			$showcaseext_widgetTmpOptions['display_widget_credit'] == "on" ? $display_widget_credit = TRUE : $display_widget_credit = FALSE;
		}
		else {
			$display_widget_credit = FALSE;
		}

		if ($display_widget_credit) {
		
			// display/echo widget credit with link to plugin site
			echo '<p class="credit"><a href="http://wordpress.blogos.dk/showcaseext">Showcase ext ' . $showcaseext_widget_version . '</a></p>';
		}
		
		echo '</div>'; // closes main div
	}
	
	echo $after_widget;
	
}


function showcaseext_widget_control() {
	$showcaseext_options_widgettitle = get_option('showcaseext_options_widgettitle');
	$showcaseext_options_widgetcaption = get_option('showcaseext_options_widgetcaption');
	$showcaseext_options_pageid = get_option('showcaseext_options_pageid');
	$showcaseext_options_update_frequency = get_option('showcaseext_options_update_frequency');
	
	if ($_POST['scew_submit'] ) {
		$showcaseext_options_widgettitle = $_POST['showcaseext_options_widgettitle'];
		update_option('showcaseext_options_widgettitle', $showcaseext_options_widgettitle);
		
		$showcaseext_options_widgetcaption = $_POST['showcaseext_options_widgetcaption'];
		update_option('showcaseext_options_widgetcaption', $showcaseext_options_widgetcaption);
		
		$showcaseext_options_pageid = $_POST['showcaseext_options_pageid'];
		update_option('showcaseext_options_pageid', $showcaseext_options_pageid);
		
		$showcaseext_options_update_frequency = $_POST['showcaseext_options_update_frequency'];
		update_option('showcaseext_options_update_frequency', $showcaseext_options_update_frequency);
		
		
	}
		
	$scew_title = $showcaseext_options_widgettitle;
	$scew_caption = $showcaseext_options_widgetcaption;
	$scew_pageid = $showcaseext_options_pageid;
	
	// print form
	
	include('showcaseext-widget-control.php');
}


function showcaseext_widget_init() {
	//register widget
	
	register_sidebar_widget(__('Showcase Widget','showcaseext'), 'showcaseext_widget'); 
	
	register_widget_control(__('Showcase Widget','showcaseext'), 'showcaseext_widget_control','275px'); 
}
add_action('init', 'showcaseext_widget_init'); // initializes the widget

/** The next two sections create links on the plugin page
 *  Don't change unless the API changes
 */

$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'my_plugin_actlinks' ); 

function my_plugin_actlinks( $links ){ 
	// Add a link to this plugin's settings page
 	$settings_link = '<a href="' . get_bloginfo('url') . '/wp-admin/themes.php/?page=' . basename(__FILE__) . '">Options</a>'; 
 	array_unshift( $links, $settings_link ); 
 	return $links; 
}


function showcaseext_admin_init() { // whitelists options and registers a validation function
	
	register_setting('showcaseext_options', 'showcaseext_options', 'showcaseext_options_validate');
	// the widget variables function whether the following is enabled or not
	register_setting('showcaseext_options', 'showcaseext_widgetoptions', 'showcaseext_widgetoptions_validate');
}
add_action('admin_init', 'showcaseext_admin_init'); // initializes the register settings function


function showcaseext_options_validate($input) {

	$input['smallsize_user_screenshot'] = trim($input['smallsize_user_screenshot']);
	$input['mediumsize_user_screenshot'] = trim($input['mediumsize_user_screenshot']);
	$input['fullsize_user_screenshot'] = trim($input['fullsize_user_screenshot']);
	$input['readme_filenames'] = trim($input['readme_filenames']);
	$input['number_of_columns'] = intval(trim($input['number_of_columns']));
	$input['user_name_index_title'] = trim($input['user_name_index_title']);
	$input['user_thumbnail_index_title'] = trim($input['user_thumbnail_index_title']);
	$input['user_caption'] = trim($input['user_caption']);
	$input['user_click_picture_message'] = trim($input['user_click_picture_message']);
	$input['download_instructions_directory'] = showcaseext_validate_path($input['download_instructions_directory']);
	$input['internal_links_directory'] = showcaseext_validate_path($input['internal_links_directory']);
	$input['theme_description_directory'] = showcaseext_validate_path($input['theme_description_directory']);
	$input['debug_report_path'] = showcaseext_validate_path($input['debug_report_path']);
	
	return $input;
}


function showcaseext_widgetoptions_validate($input) {

	$input['showcaseext_widgetoptions_widgettitle'] = trim($input['showcaseext_widgetoptions_widgettitle']);
	$input['showcaseext_widgetoptions_widgetcaption'] = trim($input['showcaseext_widgetoptions_widgetcaption']);
	$input['showcaseext_widgetoptions_pageid'] = intval(trim($input['showcaseext_widgetoptions_pageid']));
	$input['showcaseext_widgetoptions_update_frequency'] = absint(trim($input['showcaseext_widgetoptions_update_frequency']));
	
	return $input;
}


function Showcaseext_HeadAction() { // load the .css file for Showcase Ext and Showcase Ext Widget
	echo '<link type="text/css" rel="stylesheet" href="' . trailingslashit(SHOWCASEEXT_URL) . 'showcaseext.css" />';
}
add_action('wp_head', 'Showcaseext_HeadAction'); // registers the .css loading function above



// Finally, adds some filters

add_filter('stylesheet', 'preview_theme_stylesheet_ext'); // makes it possible to preview a stylesheet
add_filter('template', 'preview_theme_template_ext'); // makes it possible to preview a theme
//add_filter('the_content', 'wp_theme_preview_ext');

?>