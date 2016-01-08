<?php
/**
 * WIS WP Theme functions and definitions.
 */

/**
 * Enqueue scripts and styles.
 */
function wis_wp_theme_enqueue() {
	// Don't do Twenty Fifteen enqueue
	remove_action( 'wp_enqueue_scripts', 'twentyfifteen_scripts' );

	// Use minified libraries if SCRIPT_DEBUG is turned off
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	// Add Bootstrap files
	wp_enqueue_style( 'bootstrap', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap' . $suffix . '.css', array(), null );
	wp_enqueue_script( 'bootstrap', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap' . $suffix . '.js', array( 'jquery-core' ), null, true );

	// Add React files
	wp_enqueue_script( 'react', 'https://cdnjs.cloudflare.com/ajax/libs/react/0.14.3/react' . $suffix . '.js', array(), null );
	wp_enqueue_script( 'react-dom', 'https://cdnjs.cloudflare.com/ajax/libs/react/0.14.3/react-dom' . $suffix . '.js', array( 'react' ), null );

	// Add Babel file
	wp_enqueue_script( 'babel', 'https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.34/browser' . $suffix . '.js', array(), null );

	// Add JSX file
	wp_enqueue_script( 'wis-jsx', get_stylesheet_directory_uri() . '/vendor/dimadin/wis-jsx/wis-jsx.js', array( 'react', 'react-dom', 'babel', 'jquery-core' ), '0.1-beta-4' );

	// Add endpoint base to be used by JSX file
	wp_localize_script( 'wis-jsx', 'wisJSX', array(
		'EndpointBase' => rest_url(),
	) );
}
add_action( 'wp_enqueue_scripts', 'wis_wp_theme_enqueue', 1 );

/**
 * Make JSX file loader of Babel type.
 */
function wis_wp_theme_script_loader_tag( $tag, $handle, $src ) {
	if ( 'wis-jsx' == $handle ) {
		$tag = str_replace( "<script type='text/javascript'", "<script type='text/babel'", $tag );
	}

	return $tag;
}
add_filter( 'script_loader_tag', 'wis_wp_theme_script_loader_tag', 10, 3 );
