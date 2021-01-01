<?php 

    // Require widgets
    require get_template_directory() . '/widgets/one-cat_widget.php';
    require get_template_directory() . '/widgets/widgets.php';

    // Theme support
    function bbtheme_theme_support(){

        // Adding custom logo support
        add_theme_support('custom-logo');

        // Adding menu support
        add_theme_support('menus');
        register_nav_menus(array(
            'lang-switcher' => 'Language Switcher',
            'header-pages' => 'Header pages',
            'header-cats' => 'Header cats',
        ));

        // Adding title-tag support
        add_theme_support( 'title-tag' );

        // Adding post thumbnails support
        add_theme_support( 'post-thumbnails' );

        add_filter( 'upload_mimes', 'svg_upload_allow' );

        # Добавляет SVG в список разрешенных для загрузки файлов.
        function svg_upload_allow( $mimes ) {
            $mimes['svg']  = 'image/svg+xml';

            return $mimes;
        }

        add_filter( 'wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5 );

        # Исправление MIME типа для SVG файлов.
        function fix_svg_mime_type( $data, $file, $filename, $mimes, $real_mime = '' ){

            // WP 5.1 +
            if( version_compare( $GLOBALS['wp_version'], '5.1.0', '>=' ) )
                $dosvg = in_array( $real_mime, [ 'image/svg', 'image/svg+xml' ] );
            else
                $dosvg = ( '.svg' === strtolower( substr($filename, -4) ) );

            // mime тип был обнулен, поправим его
            // а также проверим право пользователя
            if( $dosvg ){

                // разрешим
                if( current_user_can('manage_options') ){

                    $data['ext']  = 'svg';
                    $data['type'] = 'image/svg+xml';
                }
                // запретим
                else {
                    $data['ext'] = $type_and_ext['type'] = false;
                }

            }

            return $data;
        }

        // Adding class to excerpt
        add_filter( 'the_excerpt', 'add_excerpt_class' );

        function add_excerpt_class($post_excerpt) {
            $new_post_excerpt = str_replace('<p>', '<p class="post__excerpt">', $post_excerpt);
            return $new_post_excerpt;
        }
    }

    bbtheme_theme_support();

    // Register sidebar
    function bbtheme_register_sidebars() {

        // Search sidebar in header
        register_sidebar(array(
            'name' => 'Search sidebar',
            'id' => 'search-sidebar',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => "</div>\n",
        ));

        // Main sidebar
        register_sidebar(array(
            'name' => 'Main sidebar',
            'id' => 'main-sidebar',
            'before_widget' => '<div id="%1$s" class="widget main-sidebar__widget %2$s custom-shadow">',
            'after_widget'  => "</div>\n",
            'before_title' => '<h3 class="widgettitle">',
            'after_title' => "</h3>\n"
        ));
    }
    
    add_action( 'widgets_init', 'bbtheme_register_sidebars' );

    // Adding styles and scripts
    function bbtheme_add_scripts() {

        // Adding styles
        wp_enqueue_style('bbtheme-bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css');
        wp_enqueue_style('bbtheme-style', get_stylesheet_uri());
        
        // Adding scripts
        wp_enqueue_script('bbtheme-jquery', 'https://code.jquery.com/jquery-3.4.1.min.js');
        wp_enqueue_script('bbtheme-popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js');
        wp_enqueue_script('bbtheme-bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js');
        wp_enqueue_script('bbtheme-js', get_template_directory_uri() . '/assets/js/script.js');
        wp_enqueue_script('bbtheme-render-posts-js', get_template_directory_uri() . '/assets/js/render-posts.js');
        wp_enqueue_script('bbtheme-icons', 'https://kit.fontawesome.com/7a6f88b9b9.js');
    }

    add_action('wp_enqueue_scripts', 'bbtheme_add_scripts');

    // Customizer
    add_action( 'customize_register', 'customizer_init' );

    function customizer_init( $wp_customize ) {

        // Adding settings for header
        $wp_customize->add_section( 'bbtheme-header', [
            'title' => 'Header',
            'priority' => 30
        ]);

        $wp_customize->add_setting( 'bbtheme-header-title', [
            'default' => '',
            'transport' => 'postMessage'
        ]);

        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize, 'bbtheme-header-title', [
                'label' => 'Header title',
                'description' => 'Put here text that will show in header',
                'section' => 'bbtheme-header',
                'settings' => 'bbtheme-header-title',
                'type' => 'text'
        ]));

        // Adding settings for footer
        $wp_customize->add_section( 'bbtheme-footer', [
            'title' => 'Footer',
            'priority' => 40
        ]);

        // Copyright
        $wp_customize->add_setting( 'bbtheme-footer-copy', [
            'default' => '',
            'transport' => 'postMessage'
        ]);

        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize, 'bbtheme-footer-copy', [
                'label' => 'Copyright',
                'description' => 'Put here copyright text that will show in footer',
                'section' => 'bbtheme-footer',
                'settings' => 'bbtheme-footer-copy',
                'type' => 'text'
        ]));

        // Footer text
        $wp_customize->add_setting( 'bbtheme-footer-text', [
            'default' => '',
            'transport' => 'postMessage'
        ]);

        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize, 'bbtheme-footer-text', [
                'label' => 'Text',
                'description' => 'Put here text that will show in footer',
                'section' => 'bbtheme-footer',
                'settings' => 'bbtheme-footer-text',
                'type' => 'textarea'
        ]));
    }

    function customizer_js_file(){
        wp_enqueue_script( 'bbtheme-customizer', get_stylesheet_directory_uri() . '/assets/js/customizer.js', [ 'jquery', 'customize-preview' ], null, true );
    }

    add_action('customize_preview_init', 'customizer_js_file');

    // Adding strings for polylang
    add_action('init', function() {
        pll_register_string('bbtheme-cat-string', 'Category');
        pll_register_string('bbtheme-tag-string', 'Tag');
        pll_register_string('bbtheme-tag-string', 'Tags');
        pll_register_string('bbtheme-no-posts-string', 'There is no posts');
        pll_register_string('bbtheme-search-string', 'Search result');
        pll_register_string('bbtheme-all-cats-string', 'All');
        pll_register_string('bbtheme-main-title-string', 'Begginer webdev blog');
    });

    // Adding AJAX handler
    add_action('wp_ajax_get_posts', 'get_posts_callback');
    add_action('wp_ajax_nopriv_get_posts', 'get_posts_callback');

    // Pack all posts with selected category
    function get_posts_callback() {

        $cat = $_REQUEST['id'];
        $lang = $_REQUEST['lang'];
        $posts = wp_get_recent_posts([
            'numberposts' => -1,
            'category' => $cat,
            'lang' => $lang,
            'post_status' => 'publish',
        ]);

        $packed_data = array();

        foreach ($posts as $p) {
            $packed_data[] = [
                'title'=> $p['post_title'],
                'permalink'=> get_the_permalink( $p['ID'] ),
                'thumbnail'=> get_the_post_thumbnail_url( $p['ID'] ),
                'date'=> get_the_date( $d="", $id=$p['ID'] )
            ];
        }
    
        if ($packed_data) echo json_encode($packed_data, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
        else echo pll_e('There is no posts');
        
        wp_reset_postdata();
        wp_die();
    }
?>