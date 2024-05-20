<?php
/**
 *
 * @link https://majdak.online
 *
 * @package WordPress
 * @subpackage majdak_basic_wp_template
 * @since 1.0.0
 */
function my_theme_styles() {
    wp_enqueue_style('main-styles', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('additional-styles', get_template_directory_uri() . '/assets/style.css');
}
?>