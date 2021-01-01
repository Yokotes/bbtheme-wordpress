
<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">

            <!-- Pages -->
            <div class="col-12 col-md-4 mb-4 mb-md-0">
                <?php 
                    wp_nav_menu([
                        'theme_location' => 'header-pages',
                        'container'         => 'nav',
                        'container_class'   => 'header-submenu',
                    ]);
                ?>
            </div>

            <!-- Cats -->
            <div class="col-12 col-md-4 mb-4 mb-md-0">
                <?php 
                    wp_nav_menu([
                        'theme_location' => 'header-cats',
                        'container'         => 'nav',
                        'container_class'   => 'header-submenu',
                    ]);
                ?>
            </div>

            <!-- Info -->
            <div class="col-12 col-md-4 mb-4 mb-md-0">

                <!-- Logo & title -->
                <div class="logo-title d-flex align-items-center">

                    <!-- Logo -->
                    <?php if ( has_custom_logo() )
                        the_custom_logo();
                    ?>

                    <!-- Title -->
                    <div class="logo-title__title">
                        <?php echo get_theme_mod('bbtheme-header-title') ?>
                    </div>
                </div>

                <!-- Text -->
                <p class="footer-text">
                    <?php echo get_theme_mod('bbtheme-footer-text') ?>
                </p>
            </div>
        </div>

        <!-- Copyright -->
        <div class="footer-copy">
            <?php echo get_theme_mod('bbtheme-footer-copy'); ?>
        </div>
    </div>
</footer>
<? wp_footer(); ?>
</body>
</html>