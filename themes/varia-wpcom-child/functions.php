<?php
   add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
   
   function enqueue_parent_styles() {
      wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
   }

   //Hiding admin bar for users that are not administrators
   add_action('after_setup_theme', 'remove_admin_bar');
   
   function remove_admin_bar() {
      if (!current_user_can('administrator') && !is_admin()) {
      show_admin_bar(false);
      }
   }

   add_action( 'woocommerce_thankyou', 'add_courses_link', 4 );
   
   function add_courses_link( $order_id ) {
   
      echo 'View your purchases courses: <a href="/my-account/courses">My Courses</a>';
   
   }
?>