<?php
/**
 * Register Advanced Custom Fields Option Pages
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'redirect'		=> false,
	));

}
