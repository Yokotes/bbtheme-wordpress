<?php get_header(); ?>

<div class="page-content">
    <div class="container">
        
        <!-- Title -->
        <div class="sep-title">
            <?php pll_e('Search result'); ?>
        </div>

        <!-- Posts -->
        <div class="posts-container">
            <div class="row">
                <?php while ( have_posts() ){ the_post(); ?>
                                
                    <!-- Post -->
                    <div class="col-12 col-md-4 col-lg-3">
                        <div class="post custom-shadow">

                            <!-- Thumbnail -->
                            <div class="post__thumbnail">
                                <?php the_post_thumbnail(); ?>
                            </div>

                            <!-- Title -->
                            <h4 class="post__title">
                                <?php the_title(); ?>
                            </h4>
                                            
                            <!-- Link & Date -->
                            <div class="post__link-date d-flex justify-content-between">
                                                
                                <!-- Link -->
                                <a href="<?php the_permalink(); ?>" class="post__link">Read...</a>

                                <!-- Date -->
                                <div class="post__date">
                                    <?php the_date();  ?>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>
                <?php if ( ! have_posts() ){ ?>
                    <div class="col-12">
                        <?php pll_e('There is no posts'); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>