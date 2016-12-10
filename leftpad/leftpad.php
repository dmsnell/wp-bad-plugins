<?php
/**
* Plugin Name: LeftPad
* Plugin URI: http://wordpress.com/
* Description: Provides the [leftpad] shortcode
* Version: 1.0
* Author: Dennis Snell <dennis.snell@automattic.com>
* Author URI: dmsnell.com
* License: GPL-2.0
**/

namespace Dmsnell\BadPlugins\Leftpad;

defined( 'ABSPATH' ) or die( 'Cannot access script directly' );

add_shortcode( 'leftpad', 'Dmsnell\BadPlugins\Leftpad\shortcode_leftpad' );

function shortcode_leftpad( $attributes, $content ) {
	$args = wp_parse_args( $attributes, [
		'width' => 0,
		'filler' => ' '
	] );

	$width = (int) $args[ 'width' ];
	$filler = (string) $args[ 'filler' ];

	if ( $width < 0 ) {
			return $content;
	}

	if ( mb_strlen( $filler ) < 1 ) {
			return $content;
	}

	return leftpad( $content, $width, $filler );
};

function leftpad( $content, $width, $filler ) {
	return str_pad( $content, $width, $filler, STR_PAD_LEFT );
}

add_shortcode( 'nested', function( $attributes, $content ) {
	return '<span style="padding-left: 1em;">' . $content . '</span>';
} );
