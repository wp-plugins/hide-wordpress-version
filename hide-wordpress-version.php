<?php
/*
Plugin Name: Hide WordPress Version
Description: Hides your WordPress version from prying eyes.
Author: Kawauso
Version: 1.0
*/

class HideWordPressVersion {

	static function wp_version() {
		if ( !is_admin() )
			$GLOBALS['wp_version'] = rand( 99, 999 );
	}

	static function admin_footer() {
		if ( !current_user_can( 'update_core' ) )
			remove_filter( 'update_footer', 'core_update_footer' );
	}


	static function scripts() {
		global $wp_scripts;
		if ( !is_a( $wp_scripts, 'WP_Scripts' ) )
			return;
		foreach ( $wp_scripts->registered as $handle => $script ) {
			if ( $script->ver === false )
				$wp_scripts->registered[$handle]->ver = null;
		}
	}

	static function styles() {
		global $wp_styles;
		if ( !is_a( $wp_styles, 'WP_Styles' ) )
			return;
		foreach ( $wp_styles->registered as $handle => $style ) {
			if ( $style->ver === false )
				$wp_styles->registered[$handle]->ver = null;
		}
	}


	static function http() {
		return 'WordPress; ' . get_bloginfo( 'url' );
	}

	static function xmlrpc( $blog_options ) {
		unset( $blog_options['software_version'] );
		return $blog_options;
	}

	static function pingback( $new_useragent, $useragent ) {
		return "{$useragent} -- WordPress";
	}


	static function bloginfo( $output, $show ) {
		if ( $show != 'version' )
			return $output;
	}

}

add_action( 'init', array('HideWordPressVersion','wp_version'), 1 );
add_action( 'update_footer', array('HideWordPressVersion','admin_footer'), 1 );

add_action( 'wp_print_scripts', array('HideWordPressVersion','scripts'), 100 );
add_action( 'wp_print_footer_scripts', array('HideWordPressVersion','scripts'), 100 );
add_action( 'admin_print_styles', array('HideWordPressVersion','styles'), 100 );
add_action( 'wp_print_styles', array('HideWordPressVersion','styles'), 100 );

remove_action( 'wp_head', 'wp_generator' );
foreach ( array( 'rss2_head', 'commentsrss2_head', 'rss_head', 'rdf_header', 'atom_head', 'comments_atom_head', 'opml_head', 'app_head' ) as $hwv_action )
	remove_action( $hwv_action, 'the_generator' );
unset($hwv_action);

add_filter( 'http_headers_useragent', array('HideWordPressVersion','http'), 100 );
add_filter( 'xmlrpc_blog_options', array('HideWordPressVersion','xmlrpc'), 100 );
add_filter( 'pingback_useragent', array('HideWordPressVersion','pingback'), 100, 2 );

add_filter( 'bloginfo', array('HideWordPressVersion','bloginfo'), 100, 2 );