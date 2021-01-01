<?php
    // Register custom widgets
    function register_custom_widgets() {
        register_widget('One_Cat_Widget');
    }

    add_action('widgets_init', 'register_custom_widgets');