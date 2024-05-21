<?php
if (isset($_POST['submit'])) {
    // Zapisz ustawienia do bazy danych
    update_option('my_theme_option', $_POST['my_theme_option']);
    // Przekieruj do strony aktywacji motywu
    wp_redirect(admin_url('themes.php'));
    exit;
}
?>

<form method="post">
    <label for="my_theme_option">Wprowadź wartość:</label>
    <input type="text" id="my_theme_option" name="my_theme_option" value="<?php echo get_option('my_theme_option'); ?>">
    <input type="submit" name="submit" value="Zapisz i aktywuj motyw">
</form>