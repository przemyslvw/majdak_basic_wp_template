<?php
/**
 *
 * @link https://majdak.online
 *
 * @package WordPress
 * @subpackage majdak_basic_wp_template
 * @since 1.0.0
 */
get_header(); ?>
<?php 
if ( is_homw() ) {
    get_template_part('partials/content', 'home');
} else {
    get_template_part('partials/content', 'page');
}
?>
<?php get_footer(); ?>