<?php get_header(); ?>

<!-- Page content -->
<div class="page-content">
    <div class="container">

        <!-- Title -->
        <h1 class="main-title sep-title">
            <?php pll_e('Begginer webdev blog'); ?>
        </h1>

        <!-- Content -->
        <div class="row">

            <!-- Main content -->
            <div class="col-12 col-xl-9">

                <!-- Recent post -->
                <div class="recent-post custom-shadow">
                    <?php 
                        $recent = wp_get_recent_posts([
                            "numberposts" => 1,
                            "post_status" => "publish",
                        ])[0];
                    ?>
                    
                    <!-- Post thumbnail -->
                    <img src="<?php echo get_the_post_thumbnail_url( $recent['ID'] )?>" alt="Recent thumbnail">

                    <!-- Post container -->
                    <div class="recent-post__container d-flex align-items-end">
                        
                        <!-- Post info -->
                        <div class="recent-post__info">

                            <!-- Post title -->
                            <h2 class="recent-post__title">
                                <?php echo $recent['post_title'] ?>
                            </h2>
                            
                            <!-- Post text -->
                            <?php the_excerpt( $recent['ID'] ) ?>

                            <!-- Post link & date -->
                            <div class="recent-post__link-date d-flex justify-content-between">

                                <!-- Link -->
                                <a href=<?php the_permalink( $recent['ID'] ); ?> class="recent-post__link">
                                    Read more...
                                </a>

                                <!-- Date -->
                                <div class="recent-post__date">
                                    <?php 
                                        echo get_the_time( $d="", $id=$recent['ID'] ) . ' ' . get_the_date( $d="", $id=$recent['ID'] ); 
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Other posts -->
                <div class="other-posts">

                    <!-- Title -->
                    <div class="other-posts__header">
                        
                        <?php 
                        
                            $cats = get_categories();
                            
                            ?>
                            <a href="/" class="category-tab current" data-cat="0" data-lang="<?php echo pll_current_language(); ?>">
                                <?php pll_e('All'); ?>
                            </a>
                            <?php
                            foreach ($cats as $c) {
                                ?>
                                <a href="/" class="category-tab" data-cat="<?php echo $c->term_id ?>" data-lang="<?php echo pll_current_language(); ?>"><?php echo $c->name ?></a>
                                <?php
                            }
                        ?>

                    </div>

                    <!-- Posts -->
                    <div class="posts-container">
                        <div class="row">
                            
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="d-none d-xl-block col-3">

                <?php dynamic_sidebar('main-sidebar'); ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>