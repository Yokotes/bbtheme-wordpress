<?php 
    // Creating One-cat widget
    class One_Cat_Widget extends WP_Widget {

        function __construct() {
            parent::__construct( 'bbtheme-one-cat-widget', 'One-category widget', [
                'description' => 'Show all posts with the same category',
                'classname' => 'one-cat-widget'
            ]);
        }

        // Front end
        function widget($args, $instance) {

            $current_lang = pll_current_language('slug');
            $cat_slug = ($current_lang != 'en') ? $instance["cat"] . '-' . $current_lang : $instance["cat"];
            $cat = get_category_by_slug($cat_slug);
            $posts = wp_get_recent_posts([
                'numberposts' => 3,
                'category' => $cat->term_id,
                'post_status' => 'publish',
            ]);

            echo $args['before_widget'];
            
            // Title
            echo $args['before_title'] . $cat->name . $args['after_title'];

            // Content
            echo '<div class="one-cat-widget__posts">';
            foreach ($posts as $p) {
                ?>

                <!-- Post -->
                <div class="one-cat-widget__post d-flex">

                    <!-- Thumbnail -->
                    <?php if (get_post_thumbnail_id( $p['ID'] )): ?>
                        <div class="one-cat-widget__post-img">
                           <img src="<?php echo get_the_post_thumbnail_url( $p['ID'] ); ?>" alt="Post thumbnail">
                        </div>
                    <?php endif; ?>

                    <!-- Info -->
                    <div class="post-info one-cat-widget__post-info d-flex flex-column justify-content-between">

                        <!-- Title -->
                        <h4 class="post-title one-cat-widget__post-title">
                            <?php echo $p['post_title'] ?>
                        </h4>

                        <!-- Date -->
                        <div class="post-date one-cat-widget__post-date">
                            <?php echo get_the_date( $d="", $id=$p['ID'] )?>
                        </div>

                        <!-- Link -->
                        <a href=<?php the_permalink( $p['ID'] ); ?> class="post-link one-cat-widget__post-link">
                            Read...
                        </a>
                    </div>
                </div>
                <?php
            }
            echo '</div>';

            // See all posts in selected category
            echo '<a href="' . get_category_link( $cat->term_id ) . '" class="custom-widget__more-link">See more...</a>';

            echo $args['after_widget'];

            wp_reset_postdata();
        }

        // Widget settings
        function form($instance) {
            $select = $instance['cat'] ?: '';

            ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'cat' ); ?>">Category:</label>
                <select class="widefat" name="<?php echo $this->get_field_name( 'cat' ); ?>" id="<?php echo $this->get_field_id( 'cat' ); ?>">
                    <?php 
                        $cats = get_categories([
                            'lang' => 'en'
                        ]);

                        foreach($cats as $cat) {
                            ?>
                            <option <?php echo ($instance['cat'] == $cat->slug) ? 'selected' : '' ?> value="<?php echo $cat->slug ?>"><?php echo $cat->name ?></option>
                            <?php
                        }
                    ?>
                </select>
            </p>
            <?php
        }

        // Update widget
        function update( $new_instance, $old_instance ) {
            return $new_instance;
        }
    }