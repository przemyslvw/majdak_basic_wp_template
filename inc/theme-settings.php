<?php
function my_theme_settings_page() {
    // Wyświetl formularz
    ?>
    <div class="notice notice-success is-dismissible">
        <form method="post">
            <label for="my_theme_option">Wprowadź wartość:</label>
            <input type="text" id="my_theme_option" name="my_theme_option" value="<?php echo get_option('my_theme_option'); ?>">
            <input type="submit" name="submit" value="Zapisz i aktywuj motyw">
        </form>
    </div>
    <?php
}

function my_theme_settings() {
    // Sprawdź, czy formularz został wysłany
    if ($GLOBALS['pagenow'] == 'themes.php' && isset($_POST['submit'])) {
        // Zapisz ustawienia do bazy danych
        update_option('my_theme_option', $_POST['my_theme_option']);
        // Przekieruj do strony aktywacji motywu
        wp_redirect(admin_url('themes.php'));
        exit;
    }

    if ($GLOBALS['pagenow'] == 'themes.php') {
        add_action('admin_notices', 'my_theme_settings_page');
    }
}
add_action('load-themes.php', 'my_theme_settings');
?>