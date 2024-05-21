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
    wp_enqueue_style('additional-styles', get_template_directory_uri() . '/assets/css/style.css');
}
add_action('wp_enqueue_scripts', 'my_theme_styles');

function create_pages() {
    // Tablica stron do utworzenia
    $pages = array(
        array(
            'title' => 'Company',
            'slug' => 'company',
            'template' => '',
            'menu_order' => 1
        ),
        array(
            'title' => 'News',
            'slug' => 'news',
            'template' => 'partials/archive.php',
            'menu_order' => 2
        ),
        array(
            'title' => 'Products',
            'slug' => 'products',
            'template' => '',
            'menu_order' => 3
        ),
        array(
            'title' => 'Contact',
            'slug' => 'contact',
            'template' => '',
            'menu_order' => 4
        )
    );

    foreach ($pages as $page) {
        // Sprawdź, czy strona już istnieje
        $existing_page = get_page_by_title($page['title']);

        if (!$existing_page) {
            // Utwórz nową stronę
            wp_insert_post(
                array(
                    'post_title'     => $page['title'],
                    'post_type'      => 'page',
                    'post_name'      => $page['slug'],
                    'comment_status' => 'closed',
                    'ping_status'    => 'closed',
                    'post_content'   => '',
                    'post_status'    => 'publish',
                    'menu_order'     => $page['menu_order'],
                    'post_author'    => 1,
                    'page_template'  => $page['template']
                )
            );
        }
    }
}

// Wywołaj funkcję podczas aktywacji motywu
add_action('after_switch_theme', 'create_pages');
?>