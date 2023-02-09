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
        add_action('init', 'custom_post_type');
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

    function custom_post_type(){
        register_post_type('book', array('public' => true));
    }
}

if(class_exists('CustomPlugin')){
    $customPluginInstance = new CustomPlugin();
}

//activation
register_activation_hook(__FILE__, array($customPluginInstance, 'activate'));

//deactivate
register_deactivation_hook(__FILE__, array($customPluginInstance, 'deactivate'));