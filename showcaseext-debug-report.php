<?php		
/*
 WP Theme Showcase ext and i18n
 Author: GeorgWP
 Included by theme-showcase-ext.php

*/
	global $debug_mode, $debug_report, $dumppost, $dump_debug_report, $dump_debug_report_all, $debug_report_path, $options, $tmpoptions;
		
	$options = get_option('showcaseext_options');
	
	$options['debug_mode'] == 'on' ? $debug_mode = true : $debug_mode = false;
	$options['dump_debug_report'] == 'on' ? $dump_debug_report = true : $dump_debug_report = false;
	$options['dump_debug_report_all'] == 'on' ? $dump_debug_report_all = true : $dump_debug_report_all = false;
	$debug_report_path = trailingslashit($options['debug_report_path']);
	$filename_to_use_for_saving = 'debug_report.htm';


	// create debug report
	
	print_debug_report();
	

	// save or attach to showcase page
	
	if ($dump_debug_report)
	{
		dump_debug_report($filename_to_use_for_saving);
	}
	else
	{
		$returnform = '<div id=showcaseext>' . $returnform . '</div>' . $debug_report;
	}
		
function dump_debug_report($filename_to_use_for_saving)
{
	global $debug_mode, $dumppost, $dump_debug_report, $dump_debug_report_all, $debug_report_path, $dump_debug_report_filename, $options;
	
	
	if ($dump_debug_report_all)
	{
		for ($i = 1; $i < 10000; $i++)
		{
			if (!empty($options['debug_report_path']))
			{
				$debug_report_path = trailingslashit(WP_CONTENT_DIR) . trailingslashit($options['debug_report_path']);
			}
			else
			{
				$debug_report_path = trailingslashit(WP_CONTENT_DIR) . trailingslashit('debug_reports');
			}
								
			$dump_debug_report_filename = $debug_report_path . 'debug_report[' . $i . '].htm';
			
			if (!file_exists($dump_debug_report_filename))
			{
				showcaseext_build_html_debug_report (__('Debug report', 'showcaseext'), $dump_debug_report_filename);
				break;
			}
		}
	}
	else
	{
		if (!empty($options['debug_report_path']))
		{
			$debug_report_path = trailingslashit(WP_CONTENT_DIR) . trailingslashit($options['debug_report_path']);
		}
		else
		{
			$debug_report_path = trailingslashit(WP_CONTENT_DIR) . trailingslashit('debug_reports');
			// echo "Debug-reports are saved in $debug_report_path";
		}
		$dump_debug_report_filename = trailingslashit($debug_report_path) . $filename_to_use_for_saving;
		showcaseext_build_html_debug_report (__('Debug report','showcaseext'), $dump_debug_report_filename);
	}
	$returnform = '<div id=showcaseext>' . $returnform . '</div>';
	
}


function showcaseext_build_html_debug_report($title, $filename_to_save_to)
{
	global $debug_report, $debug_report_path, $dump_debug_report_filename;
	
	$html_header = '<html><head><meta content="text/html; charset=UTF-8" http-equiv="Content-Type"/><title>' . $title . '</title></head><body>';
	$html_header .= '<h2>' .  sprintf(_c('%1$s dated %2$s|for debugging, feel free to ignore','showcaseext'), $title, date(__('Y-m-d H:i:s','showcaseext'))) . '</h2>';
	$html_footer = '</body></html>';
	$debug_report_all = $html_header . $debug_report . $html_footer;
	$dump_debug_report_filename = str_replace('//','/',$filename_to_save_to);
	
	file_put_contents ($dump_debug_report_filename, $debug_report_all);
}


function output_array_keys_and_values($title, $array_name)
{
	global $debug_report, $options;
	
	/*	requires the following arguments
		string with name for array,
		name of array */
	
	if(!empty($array_name))
	{
		ob_start();
		print_r($array_name);
		$tmp = ob_get_contents();
		ob_end_clean();
		$debug_report .= '<h4>Array: ' . $title . '</h4>';
		$debug_report .= '<pre>' . $tmp . '</pre>';
		$debug_report .=  sprintf(_c('%d element(s) in total.|for debugging, feel free to ignore','showcaseext'),count($array_name));
		unset($tmp);
	}
	else
	{
		$debug_report .= '<h4>Array: ' . $title . '</h4>';
		$debug_report .= sprintf(_c('Array %s is empty.|for debugging, feel free to ignore','showcaseext'),$title);
		$debug_report .= '<br/>' . _c('Check if this part of the script is enabled in the options.|for debugging, feel free to ignore','showcaseext');
	}
	
}
	

function showcaseext_read_s_post_dump($showcaseext_debug_report)
{
	global $showcaseext_S_POST;
	
	$tmp_get_filename_options = get_option ('showcaseext_options');
	
	if ($tmp_get_filename_options['dump_debug_report'] == 'on')
	{
		if (get_option('showcaseext_S_POST'))
		{
			$tmp1 = get_option('showcaseext_S_POST');
			$showcaseext_S_POST = explode ('##', $tmp1);
		}
			else
		{
			$showcaseext_debug_report .= '<h4>' . _c('Debug report: $_POST options missing|for debugging, feel free to ignore','showcaseext') . '</h4>';
			$showcaseext_debug_report .= '<p>' . _c('You have not yet submitted the options page with debugging enabled.|for debugging, feel free to ignore','showcaseext') . '</p>';
		}	
	}

	return $showcaseext_debug_report;
		
}


function print_debug_report ()
{
	global $debug_report, $debug_array, $options, $S_POST, $debug_anchorized_titles, $local_fullsize_debug, $local_mediumsize_debug, $local_additional_screenshots, $local_user_description_file, $local_readme_files, $local_download_instructions, $local_internal_links, $debug_mode, $dump_debug_report, $dump_debug_report_all, $debug_report_path, $internal_variables, $readme_filenames, $mediumsize_filenames, $showcaseext_S_POST, $debug_showcaseext_widget_array;
	
	$debug_report_path = trailingslashit($options['debug_report_path']);
	// $dumppost = trailingslashit($debug_report_path) . 'POST.txt'; SLETTES
	
	// opening div and adding header
	
	$debug_report .= '<div id="debugreport">';	
	// $debug_report .= '<h3>' . _c('Debug report|for debug-report, feel free to ignore','showcaseext') . '</h3>';
	
	
	// building content
	
	$debug_report = showcaseext_read_s_post_dump($debug_report);
	
	if (!empty($showcaseext_S_POST)) output_array_keys_and_values('&#36;_POST via S_POST',$showcaseext_S_POST);
	
	output_array_keys_and_values ('Options', $options);
	
	output_array_keys_and_values ('Debug array', $debug_array);
	
	output_array_keys_and_values ('This', $this);
	
	output_array_keys_and_values ('Local fullsize', $local_fullsize_debug);
	
	output_array_keys_and_values ('Medium-size filenames', $mediumsize_filenames);
	
	output_array_keys_and_values ('Local mediumsize', $local_mediumsize_debug);
	
	output_array_keys_and_values ('Local additional screenshots', $local_additional_screenshots);
	
	output_array_keys_and_values ('Local user description', $local_user_description_file);
	
	output_array_keys_and_values ('Local download instructions', $local_download_instructions);
	
	output_array_keys_and_values ('Internal links', $local_internal_links);
	
	output_array_keys_and_values ('Readme filenames', $readme_filenames);
	
	output_array_keys_and_values ('Local readme files', $local_readme_files);
	
	output_array_keys_and_values ('Internal variables', $internal_variables);
	
	output_array_keys_and_values ('Anchorized titles', $debug_anchorized_titles);
	
	output_array_keys_and_values ('Widget array', $debug_showcaseext_widget_array);
	
	output_array_keys_and_values ('Thumbnail array', $debug_showcaseext_widget_array);

	output_array_keys_and_values ('Theme-array', $debug_themes_array);
	
	
	// closing div
	
	$debug_report .= '<div>';
		
	
}
?>