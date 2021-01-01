<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>
</head>
<body>

    <header class="header custom-shadow">

        <!-- Content -->
        <div class="header__content">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-between">

                    <!-- Logo & title -->
                    <div class="col-auto">
                        <div class="logo-title d-flex align-items-center">

                            <!-- Logo -->
                            <?php if ( has_custom_logo() )
                                the_custom_logo();
                            ?>
                            
                            <!-- Title -->
                            <div class="logo-title__title d-none d-sm-block">
                                <?php echo get_theme_mod('bbtheme-header-title') ?>
                            </div>
                        </div>
                    </div>

                    <!-- Functional buttons -->
                    <div class="col-auto">
                        <div class="btns-container d-flex align-items-center">

                            <!-- Search form widget -->
                            <?php dynamic_sidebar('search-sidebar'); ?>

                            <!-- Language button -->
                            <?php  
                                wp_nav_menu([
                                    'theme_location'    => 'lang-switcher',
                                    'container'         => 'nav',
                                    'container_class'   => 'lang-switch',
                                ]); 
                            ?>

                            <!-- Burger button -->
                            <button class="burger-btn">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu -->
        <div class="header__menu">
            <div class="container">
                <div class="row">

                    <!-- Pages -->
                    <div class="col-6 col-md-4">
                        <?php 
                            wp_nav_menu([
                                'theme_location' => 'header-pages',
                                'container'         => 'nav',
                                'container_class'   => 'header-submenu',
                            ]);
                        ?>
                    </div>

                    <!-- Cats -->
                    <div class="col-6 col-md-4">
                        <?php 
                            wp_nav_menu([
                                'theme_location' => 'header-cats',
                                'container'         => 'nav',
                                'container_class'   => 'header-submenu',
                            ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </header>