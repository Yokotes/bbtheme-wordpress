<?php get_header(); ?>

<div class="container">

    <?php the_post(); ?>

    <!-- Post page -->
    <div class="post-page custom-shadow">

        <!-- Post thumbnail -->
        <img src="<?php the_post_thumbnail_url(); ?>" alt="Post thumbnail" class="post-page__img">

        <!-- Post content -->
        <div class="post-page__content">

            <!-- Title -->
            <h1 class="post-page__title">
                <?php the_title(); ?>
            </h1>

            <!-- Content -->
            <div class="post-page__post-content">
                <?php the_content(); ?>
            </div>

            <!-- Category & Date -->
            <div class="post-page__cat-date d-flex justify-content-between">

                <!-- Category -->
                <div class="post-page__cat">
                    <?php the_category(', '); ?>
                </div>

                <!-- Date -->
                <div class="post-page__date">
                    <?php the_date(); ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Tags -->
    <div class="post-tags custom-shadow">

        <!-- Title -->
        <div class="post-page-title">
           <?php pll_e('Tags'); ?>
        </div>

        <!-- Tags -->
        <div class="post-tags__tags tagcloud">
            <?php the_tags( '' , ' ', '' ) ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>