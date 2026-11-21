<?php
/**
 * Template Name: Volle Breite
 * Template Post Type: page
 *
 * Página sem título e sem limite de largura no contêiner.
 *
 * @package CS_Theme_1
 */

get_header();
get_template_part( 'template-parts/singular', null, array( 'layout' => 'full' ) );
get_footer();
