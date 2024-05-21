<?php
/*
Template Name: Custom Page Template
*/

?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

    <?php
    // Start the loop.
    while ( have_posts() ) : the_post();

        // Display post title.
        the_title( '<h1 class="entry-title">', '</h1>' );

        // Check if there is a post content.
        if ( get_the_content() ) {
            // Display post content.
            the_content();
        }

    // End the loop.
    endwhile;
    ?>

    </main><!-- .site-main -->
</div><!-- .content-area -->