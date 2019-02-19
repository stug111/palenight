<?php
/**
 * Blocks Initializer
 *
 * Enqueue CSS/JS of all the blocks.
 *
 * @since   1.0.0
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue Gutenberg block assets for both frontend + backend.
 *
 * @uses {wp-editor} for WP editor styles.
 * @since 1.0.0
 */
function palenight_block_assets() { // phpcs:ignore
	// Styles.
	wp_enqueue_style(
		'palenight-style-css', // Handle.
		get_template_directory_uri() . '/palenight/dist/blocks.style.build.css', // Block style CSS.
		array( 'wp-editor' ) // Dependency to include the CSS after it.
		// filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.style.build.css' ) // Version: File modification time.
	);
}

// Hook: Frontend assets.
add_action( 'enqueue_block_assets', 'palenight_block_assets' );

/**
 * Enqueue Gutenberg block assets for backend editor.
 *
 * @uses {wp-blocks} for block type registration & related functions.
 * @uses {wp-element} for WP Element abstraction — structure of blocks.
 * @uses {wp-i18n} to internationalize the block's text.
 * @uses {wp-editor} for WP editor styles.
 * @since 1.0.0
 */
function palenight_editor_assets() { // phpcs:ignore
	// Scripts.
	wp_enqueue_script(
		'palenight-block-js', // Handle.
		get_template_directory_uri() . '/palenight/dist/blocks.build.js', // Block.build.js: We register the block here. Built with Webpack.
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ), // Dependencies, defined above.
		// filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ), // Version: File modification time.
		true // Enqueue the script in the footer.
	);

	// Styles.
	wp_enqueue_style(
		'palenight-block-editor-css', // Handle.
		get_template_directory_uri() . '/palenight/dist/blocks.editor.build.css', // Block editor CSS.
		array( 'wp-edit-blocks' ) // Dependency to include the CSS after it.
		// filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.editor.build.css' ) // Version: File modification time.
	);
}

// Hook: Editor assets.
add_action( 'enqueue_block_editor_assets', 'palenight_editor_assets' );


// Create custom category
function palenight_block_categories ( $categories ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' 	=> 'palenight',
				'title'	=> __( 'Palenight', 'palenight' ),
			)
		)
	);
}

add_filter( 'block_categories', 'palenight_block_categories', 10, 2 );
