<?php
/**
 * Plugin Name: IEWP Content Snippets
 * Plugin URI: https://github.com/corenominal/iewp-content-snippets
 * Description: A WordPress plugin for creating and displaying content snippets. Uses a custom post type to create content snippets which can be embedded into template files.
 * Author: Philip Newborough
 * Version: 0.0.1
 * Author URI: https://corenominal.org
 */

/**
 * Include the custom post type
 */
require_once( plugin_dir_path( __FILE__ ) . 'register_custom_post_type.php' );

/**
 * Include the template function
 */
require_once( plugin_dir_path( __FILE__ ) . 'template_functions.php' );

/**
 * Include shortcodes
 */
require_once( plugin_dir_path( __FILE__ ) . 'shortcodes.php' );
