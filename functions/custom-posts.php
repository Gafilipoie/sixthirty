<?php

function custom_post_projects() {
    $labels = array(
        'name' => _x( 'Projects', 'post type general name' ),
        'singular_name' => _x( 'Project', 'post type singular name' ),
        'add_new' => _x( 'Add New', 'projects' ),
        'add_new_item' => __( 'Add New' ),
        'edit_item' => __( 'Edit' ),
        'new_item' => __( 'New' ),
        'view_item' => null,
        'search_items' => __( 'Search' ),
        'not_found' =>  __( 'Nothing found' ),
        'not_found_in_trash' => __( 'Nothing found in Trash' ),
        'parent_item_colon' => ''
    );
    $args = array( 'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'has_archive' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'show_in_nav_menus' => true,
        'menu_position' => null,
        'supports' => array( 'title' ),
        'rewrite' => array( 'slug' => 'projects' )
    );
    register_post_type( 'projects', $args );
}
add_action( 'init', 'custom_post_projects' );
