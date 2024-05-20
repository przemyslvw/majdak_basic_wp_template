<?php
function my_theme_styles() {
    wp_enqueue_style('main-styles', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('additional-styles', get_template_directory_uri() . '/assets/style.css');
}
add_action('wp_enqueue_scripts', 'my_theme_styles');
?>