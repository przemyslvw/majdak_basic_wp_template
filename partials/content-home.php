<div class="fullscreen-bg"
    style="background: url('<?php echo get_template_directory_uri(); ?>/assets/bg-main.jpg') no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <!-- <img src="logo_majdak_online.png" alt="Logo" style="max-height: 60px;"> -->
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <?php
                wp_nav_menu(array(
                    'theme_location' => 'main-menu',
                    'container' => 'div',
                    'container_class' => 'collapse navbar-collapse',
                    'container_id' => 'navbarNav',
                    'menu_class' => 'navbar-nav ml-auto',
                ));
            ?>
        </div>
    </nav>

    <div class="nav-container">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'home-menu-1',
            'menu_class' => 'nav-links',
        ));
        ?>
        <img src="<?php echo get_template_directory_uri(); ?>/assets/logo_majdak_online.png" alt="Logo">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'home-menu-2',
            'menu_class' => 'nav-links',
        ));
        ?>
    </div>
    <video loop muted autoplay class="fullscreen-bg__video">
        <source src="<?php echo get_template_directory_uri(); ?>/assets/desert.mp4" type="video/mp4">
    </video>
</div>