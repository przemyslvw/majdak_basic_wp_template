<?php
/**
 *
 * @link https://majdak.online
 *
 * @package WordPress
 * @subpackage majdak_basic_wp_template
 * @since 1.0.0
 */


 require get_template_directory() . '/inc/theme-settings.php';
 

function my_theme_styles() {
    wp_enqueue_style('main-styles', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('additional-styles', get_template_directory_uri() . '/assets/css/style.css');
}
add_action('wp_enqueue_scripts', 'my_theme_styles');

function create_pages() {
    // Tablica stron do utworzenia
    $pages = include('inc/pages_array.php');

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

    $menu_name = 'Main Menu';
    $menu_exists = wp_get_nav_menu_object($menu_name);
    
    if(!$menu_exists){
        // Create a new menu
        $menu_id = wp_create_nav_menu($menu_name);
    
        // Add each page to the menu
        foreach ($pages as $page) {
            $page_object = get_page_by_title($page['title']);
    
            if ($page_object) {
                wp_update_nav_menu_item($menu_id, 0, array(
                    'menu-item-title' => $page['title'],
                    'menu-item-object-id' => $page_object->ID,
                    'menu-item-object' => 'page',
                    'menu-item-status' => 'publish'
                ));
            }
        }
        // Assign the menu to the 'main-menu' theme location
        set_theme_mod('nav_menu_locations', array('main-menu' => $menu_id));
    }
    

}


// drugie menu na strone główną

$menu_names = array('Home Menu 1', 'Home Menu 2');

foreach ($menu_names as $menu_name) {
    $menu_exists = wp_get_nav_menu_object($menu_name);

    if(!$menu_exists){
        wp_create_nav_menu($menu_name);
    }
}
$pages = include('inc/pages_array.php');
$half = ceil(count($pages) / 2);

$pages1 = array_slice($pages, 0, $half);
$pages2 = array_slice($pages, $half);

add_pages_to_menu($pages1, 'Home Menu 1', 'home-menu-1');
add_pages_to_menu($pages2, 'Home Menu 2', 'home-menu-2');

function add_pages_to_menu($pages, $menu_name, $menu_location) {
    $menu_object = wp_get_nav_menu_object($menu_name);

    // Sprawdź, czy obiekt menu istnieje
    if (!$menu_object) {
        return;
    }

    $menu_id = $menu_object->term_id;

    // Przypisz lokalizację wyświetlania
    set_theme_mod('nav_menu_locations', array($menu_location => $menu_id));

    foreach ($pages as $page) {
        // Sprawdź, czy element menu o danym tytule już istnieje
        $menu_items = wp_get_nav_menu_items($menu_id);
        $exists = false;
        foreach ($menu_items as $menu_item) {
            if ($menu_item->title == $page['title']) {
                $exists = true;
                break;
            }
        }

        // Jeśli element menu nie istnieje, dodaj go
        if (!$exists) {
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' =>  $page['title'],
                'menu-item-classes' => 'page',
                'menu-item-url' => home_url('/' . $page['slug'] . '/'), 
                'menu-item-status' => 'publish'
            ));
        }
    }
}

// Wywołaj funkcję podczas aktywacji motywu
add_action('after_switch_theme', 'create_pages');

// Rejestracja nawigacji
// function register_my_menu() {
//     register_nav_menu('main-menu',__( 'Main Menu' ));
// }

function register_home_menu() {
    register_nav_menus(
      array(
        'main-menu',__( 'Main Menu' ),
        'home-menu-1' => __( 'Home Menu 1' ),
        'home-menu-2' => __( 'Home Menu 2' )
      )
    );
}

function deregister_menus() {
    unregister_nav_menu( 'main-menu' );
    unregister_nav_menu( 'home-menu-1' );
    unregister_nav_menu( 'home-menu-2' );
}



add_action( 'init', 'register_home_menu' );
// add_action( 'init', 'register_my_menu' );

function assign_menus_to_locations() {
    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
    $home_menu_1 = get_term_by( 'name', 'Home Menu 1', 'nav_menu' );
    $home_menu_2 = get_term_by( 'name', 'Home Menu 2', 'nav_menu' );

    $locations = array();

    if ($main_menu) {
        $locations['main-menu'] = $main_menu->term_id;
    }

    if ($home_menu_1) {
        $locations['home-menu-1'] = $home_menu_1->term_id;
    }

    if ($home_menu_2) {
        $locations['home-menu-2'] = $home_menu_2->term_id;
    }

    set_theme_mod( 'nav_menu_locations', $locations );
}

add_action( 'after_setup_theme', 'assign_menus_to_locations' );

function remove_menus() {
    $menu_name = 'Home Menu 1';
    $menu_to_remove = get_term_by('name', $menu_name, 'nav_menu');
    if ($menu_to_remove) {
        wp_delete_nav_menu($menu_to_remove->term_id);
    }

    $menu_name = 'Home Menu 2';
    $menu_to_remove = get_term_by('name', $menu_name, 'nav_menu');
    if ($menu_to_remove) {
        wp_delete_nav_menu($menu_to_remove->term_id);
    }

    $menu_name = 'Main Menu';
    $menu_to_remove = get_term_by('name', $menu_name, 'nav_menu');
    if ($menu_to_remove) {
        wp_delete_nav_menu($menu_to_remove->term_id);
    }
}

// Wywołaj funkcję remove_menus podczas dezaktywacji motywu
add_action('switch_theme', 'remove_menus');
add_action( 'switch_theme', 'deregister_menus' );

?>