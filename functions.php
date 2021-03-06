<?php
/**
 * WIS WP Theme functions and definitions.
 */

 // Load dependencies
 if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
 	require __DIR__ . '/vendor/autoload.php';
 }


/**
 * Enqueue scripts and styles.
 */
function wis_wp_theme_enqueue() {
	// Don't do Twenty Fifteen enqueue
	remove_action( 'wp_enqueue_scripts', 'twentyfifteen_scripts' );

	// Use minified libraries if SCRIPT_DEBUG is turned off
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	// Add Bootstrap files
	wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap' . $suffix . '.css', array(), null );
	wp_enqueue_script( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap' . $suffix . '.js', array( 'jquery-core' ), null, true );

	// Add React files
	wp_enqueue_script( 'react', 'https://cdn.jsdelivr.net/npm/react@15.3.0/dist/react' . $suffix . '.js', array(), null );
	wp_enqueue_script( 'react-dom', 'https://cdn.jsdelivr.net/npm/react-dom@15.3.0/dist/react-dom' . $suffix . '.js', array( 'react' ), null );

	// Add React Router file
	wp_enqueue_script( 'react-router', 'https://cdn.jsdelivr.net/npm/react-router@2.6.1/umd/ReactRouter' . $suffix . '.js', array( 'react' ), null );

	// Add Babel file
	wp_enqueue_script( 'babel', 'https://cdn.jsdelivr.net/npm/babel-core@5.8.34/browser' . $suffix . '.js', array(), null );

	// Add JSX file
	$jsx_path = '/vendor/dimadin/wis-jsx/wis-jsx.js';
	wp_enqueue_script( 'wis-jsx', get_stylesheet_directory_uri() . $jsx_path, array( 'react', 'react-dom', 'babel', 'jquery-core' ), filemtime( get_stylesheet_directory() . $jsx_path ) );

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

/**
 * Set list of paths used by WIS.
 *
 * @return array $paths List of WIS paths.
 */
function wis_wp_theme_allowed_paths() {
	return [ 'radar', 'satellite', 'lightning', 'animated', 'forecast' ];
}

/**
 * Create virtual post for WIS paths when there is no database content.
 *
 * @param WP $wp Current WordPress environment instance.
 */
function wis_wp_theme_maybe_no_404( $wp ) {
	if ( in_array( $wp->request, wis_wp_theme_allowed_paths() ) ) {
		$v = new WP_Virtual_Posts( [ [ 'post_name' => $wp->request ] ], [ 'is_singular' => false, 'is_page' => false ] );

		// Robots still shouldn't index this path
		add_action( 'wp_head', 'wp_no_robots' );
	}
}
add_action( 'parse_request', 'wis_wp_theme_maybe_no_404' );
