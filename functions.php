<?php

require('bootstrap-5-wp-nav-menu-walker.php');
// add style and scripts

function mystyles()
{
    wp_enqueue_style('style-bootstrap', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css');
    wp_enqueue_style('style-icons', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css');
    wp_enqueue_style('style-main', get_template_directory_uri() .  '/css/main.css');
}
function myscripts()
{
    wp_enqueue_script('script-popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js', array(), false, true);
    wp_deregister_script('jquery');
    wp_register_script('jquery' , includes_url('/js/jquery/jquery.js') , array() , false , true);
    wp_enqueue_script('jquery');
    wp_enqueue_script('script-bootstrap', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js', array(), false, true);
    wp_enqueue_script('script-main', get_template_directory_uri() . '/js/main.js', array(), false, true);
}

add_action('wp_enqueue_scripts', 'mystyles');
add_action('wp_enqueue_scripts', 'myscripts');

// add menu

function mymenu()
{
    register_nav_menus(array(
        'bootstrap-menu', 'Navigation Menu',
        'footer-menu', 'Footer Menu'
    ));
}
add_action('init', 'mymenu');

function bootstrap_menu(){
     wp_nav_menu(array(
        'theme_location' => 'bootstrap-menu',
        'menu_class' => 'navbar-nav ms-auto ',
        'container' => false,
        'depth' => 2,
        'walker' => new bootstrap_5_wp_nav_menu_walker
    ));
}

//add post thumbnail

add_theme_support('post-thumbnails');

// control of excerpt

function extends_excerpt_length() {
    if(is_author()) {
        return 20;
    }else if (is_category()) {
        return 15;
    }else{
        return 65;
    }
    
}

add_filter('excerpt_length', 'extends_excerpt_length');


function excerpt_change_dots($more) {
    return '...';
}

add_filter('excerpt_more', 'excerpt_change_dots');

// Numbering Pagination

function numbering_pagination(){
    global $wp_query; // instance from WP_Query Class
    $all_pages = $wp_query->max_num_pages;
    $current_page = max(1, get_query_var('paged'));

    if ($all_pages > 1) {
        return paginate_links(array(
            'base' => get_pagenum_link() . '%_%',
            'format' => 'page/%#%', // I deleted nut nothing happened
            'current' => $current_page,
            'mid_size' => 1,
            'end_size' => 1
        ));
    }

}

// add or register sidebar

function add_main_sidebar(){
    register_sidebar(array(
        'name' => 'Main Sidebar',
        'id' => 'main-sidebar',
        'description' => 'Main Sidebar Apear everywhere',
        'class' => 'main-sidebar',
        'before_widget' => '<div class="widget-content"> ',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widge-title">',
        'after_title'   => '</h3>'
    ));
}
add_action('widgets_init', 'add_main_sidebar');

// Remove autho parapaphs that is defult in WP

function elzero_remove_auto_p($content)
{

   remove_filter('the_conent', 'wpautop', 0); // make priotary (the lower the most) 
   return $content;
}

add_filter('the_content', 'elzero_remove_auto_p');