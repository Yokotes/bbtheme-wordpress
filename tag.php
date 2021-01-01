<?php get_header(); ?>

<div class="page-content">
    <div class="container">
        
        <?php $tag = get_queried_object() ?>
    
        <!-- Title -->
        <div class="sep-title">
            <?php echo pll_e('Tag') . ': ' . $tag->name ?>
        </div>

        <!-- Posts -->
        <div class="posts-container">
            <div class="row">
                <?php 
                    $posts = wp_get_recent_posts([
                        'numberposts' => -1,
                        'tag' => $tag->name,
                        'post_status' => 'publish'
                    ]);

                    foreach ($posts as $p) {
                        ?>
                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="post custom-shadow">

                                <!-- Thumbnail -->
                                <div class="post__thumbnail">
                                    <?php the_post_thumbnail( $p['ID'] ); ?>
                                </div>

                                <!-- Title -->
                                <h4 class="post__title">
                                    <?php echo $p['post_title']; ?>
                                </h4>

                                <!-- Link & Date -->
                                <div class="post__link-date d-flex justify-content-between">
                                            
                                    <!-- Link -->
                                    <a href="<?php the_permalink( $p['ID'] ); ?>" class="post__link">Read...</a>

                                    <!-- Date -->
                                    <div class="post__date">
                                        <?php echo get_the_date( $d="", $id=$p['ID'] )  ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }

                    wp_reset_postdata();
                ?>


            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>