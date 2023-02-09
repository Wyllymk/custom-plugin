<?php
/**
 * @package CustomPlugin
 */
/*
    Plugin Name: Custom Plugin
    Plugin URI: https://github.com/Wyllymk/custom-plugin
    Description: This is my first plugin
    Version: 1.0.0
    Author: Wilson
    Author URI: https://wyllymk.github.io/newport/
    License: GPLv2 or later
    Text Domain: custom-plugin
*/

/**
 * Securing a plugin
 */
//method 1
if(!defined('ABSPATH')){
    die;
}

//method 2
defined('ABSPATH') or die('Hey you hacker, got you!');

//method 3
if(!function_exists('add_action')){
    echo 'Hey you hacker, gerarahia!';
    exit;
}

class CustomPlugin{
    function __construct(){
        add_action('init', array($this, 'custom_post_type'));
    }

    function activate(){
        //Rewrites flush rules
        echo 'The Plugin was activated!';
        flush_rewrite_rules();
    }

    function deactivate(){
        //Rewrites flush rules
        flush_rewrite_rules();
    }

    function uninstall(){
        
    }

    function custom_post_type(){
        $labels = array(
            'name'                  => _x( 'Books', 'Post type general name', 'custom-plugin' ),
            'singular_name'         => _x( 'Book', 'Post type singular name', 'custom-plugin' ),
            'menu_name'             => _x( 'Books', 'Admin Menu text', 'custom-plugin' ),
            'name_admin_bar'        => _x( 'Book', 'Add New on Toolbar', 'custom-plugin' ),
            'show_in_menu'    	    => __( 'edit.php?post_type=page'),
            'add_new'               => __( 'Add New', 'custom-plugin' ),
            'add_new_item'          => __( 'Add New Book', 'custom-plugin' ),
            'new_item'              => __( 'New Book', 'custom-plugin' ),
            'edit_item'             => __( 'Edit Book', 'custom-plugin' ),
            'view_item'             => __( 'View Book', 'custom-plugin' ),
            'all_items'             => __( 'All Books', 'custom-plugin' ),
            'search_items'          => __( 'Search Books', 'custom-plugin' ),
            'parent_item_colon'     => __( 'Parent Books:', 'custom-plugin' ),
            'not_found'             => __( 'No books found.', 'custom-plugin' ),
            'not_found_in_trash'    => __( 'No books found in Trash.', 'custom-plugin' ),
            'featured_image'        => _x( 'Book Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'custom-plugin' ),
            'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'custom-plugin' ),
            'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'custom-plugin' ),
            'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'custom-plugin' ),
            'archives'              => _x( 'Book archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'custom-plugin' ),
            'insert_into_item'      => _x( 'Insert into book', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'custom-plugin' ),
            'uploaded_to_this_item' => _x( 'Uploaded to this book', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'custom-plugin' ),
            'filter_items_list'     => __( 'Filter Announcement list', 'custom-plugin' ),
            'filter_by_date'        => __( 'Filter by date', 'custom-plugin' ),
            'items_list_navigation' => __( 'Announcements list navigation', 'custom-plugin' ),
            'items_list'            => __( 'Announcements list', 'custom-plugin' ),
            'item_published'        => __( 'Announcement published.', 'custom-plugin' ),
            'item_published_privately' => __( 'Announcement published privately.', 'custom-plugin' ),
            'item_reverted_to_draft' => __( 'Announcement reverted to draft.', 'custom-plugin' ),
            'item_scheduled'        => __( 'Announcement scheduled.', 'custom-plugin' ),
            'item_updated'          => __( 'Announcement updated.', 'custom-plugin' ),
            'item_link'             => __( 'Announcement Link', 'custom-plugin' ),
            'item_link_description' => __( 'A link to an announcement.', 'custom-plugin' ),            
            'items_list'            => _x( 'Books list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'custom-plugin' ),
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'menu_icon' => 'dashicons-book',
            'has_archive' => true,
            'public_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus'     => false,
            'show_in_admin_bar'     => false,
            'show_in_rest'          => true,
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'supports' => array(
                'title',
                'editor',
                'author',
                'excerpt',
                'thumbnail',
                'comments',
                'revisions'
            ),
            'taxonomies' => array('book', 'post_tag'),
            'menu_position' => null,
            'show_in_rest' => true,
            'exclude_from_search' => false
        );
        register_post_type('book', $args);
    }
}

if(class_exists('CustomPlugin')){
    $customPluginInstance = new CustomPlugin();
}

//activation
register_activation_hook(__FILE__, array($customPluginInstance, 'activate'));

//deactivate
register_deactivation_hook(__FILE__, array($customPluginInstance, 'deactivate'));

//Uninstall
//register_uninstall_hook(__FILE__,array($customPluginInstance, 'uninstall'));