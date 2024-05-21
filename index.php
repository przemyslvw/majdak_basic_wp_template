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
if ( is_page_template('page-all-posts.php') && locate_template('partials/archive.php') != '' ) {
    get_template_part('partials/archive');
} elseif ( is_home() && locate_template('partials/content-home.php') != '' ) {
    get_template_part('partials/content', 'home');
} elseif ( locate_template('partials/content-page.php') != '' ) {
    get_template_part('partials/content', 'page');
} else {
    get_template_part('partials/404');
}
?>
<?php get_footer(); ?>