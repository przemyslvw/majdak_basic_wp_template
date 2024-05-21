<?php
// Zapytanie do bazy danych o ostatnie 10 postów
$args = array(
    'posts_per_page' => 10
);

$query = new WP_Query($args);

// Pętla przez posty
if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        ?>
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <p><?php the_excerpt(); ?></p>
        <?php
    }
} else {
    // Wyświetl wiadomość, jeśli nie znaleziono postów
    echo 'Nie znaleziono postów.';
}

// Zresetuj zapytanie
wp_reset_postdata();
?>
<div>2</div>