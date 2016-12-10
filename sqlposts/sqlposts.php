<?php
/**
* Plugin Name: SqlPosts
* Plugin URI: http://wordpress.com/
* Description: Turns posts into SQL consoles
* Version: 1.0
* Author: Dennis Snell <dennis.snell@automattic.com>
* Author URI: dmsnell.com
* License: GPL-2.0
**/

namespace Dmsnell\BadPlugins\SqlPosts;

defined( 'ABSPATH' ) or die( 'Cannot access script directly' );

remove_filter( 'the_content', 'wptexturize' );
add_filter( 'the_content', function( $content ) {
	global $wpdb;

	$lines = explode( PHP_EOL, $content );

	$first_line = array_shift( $lines );
	if ( 'SQL' !== wp_strip_all_tags( $first_line, true ) ) {
		return $content;
	}

	$results = $wpdb->get_results( wp_strip_all_tags( implode( ' ', $lines ), true ) );

	if ( false === $results ) {
		return print_r( mysqli_error( $wpdb->dbh ), true );
	}

	return '<pre>' . print_r( $results, true ) . '</pre>';
}, 10, 1 );
