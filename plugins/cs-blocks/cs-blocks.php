<?php
/**
 * Plugin Name: CS Blocks
 * Description: Grundlage für projektspezifische Gutenberg-Blöcke.
 * Version: 1.0.0
 * Requires at least: 6.6
 * Requires PHP: 7.4
 * Author: Carolina Ciolin
 * License: GPL-2.0-or-later
 * Text Domain: cs-blocks
 *
 * @package CS_Blocks
 */

defined( 'ABSPATH' ) || exit;

/**
 * Registra metadados de blocos incluídos no diretório do plugin.
 */
function cs_blocks_register_blocks() {
	$metadata_files = glob( __DIR__ . '/blocks/*/block.json' );
	if ( ! $metadata_files ) {
		return;
	}

	foreach ( $metadata_files as $metadata_file ) {
		register_block_type( $metadata_file );
	}
}
add_action( 'init', 'cs_blocks_register_blocks' );
