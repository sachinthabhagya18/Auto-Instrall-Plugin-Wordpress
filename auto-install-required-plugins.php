<?php
/*
Plugin Name: Auto Install My Plugins
Description: Automatically installs and activates my plugins.
Version: 1.2
Author: Sachintha 
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Include the TGM Plugin Activation library
require_once plugin_dir_path(__FILE__) . 'class-tgm-plugin-activation.php';

// Register the required plugins
add_action('tgmpa_register', 'my_register_required_plugins');

function my_register_required_plugins() {
  $plugins = array(
    array( 
      'name'     => 'Contact Form 7', 
      'slug'     => 'contact-form-7', 
      'required' => true,
    ),
    array( 
      'name'     => 'Elementor Website Builder', 
      'slug'     => 'elementor', 
      'required' => false,
    ),
    array( 
      'name'     => 'Elementor Header & Footer Builder', 
      'slug'     => 'header-footer-elementor', 
      'required' => false,
    ),
    array( 
      'name'     => 'Essential Addons for Elementor', 
      'slug'     => 'essential-addons-for-elementor-lite', 
      'required' => false,
    ),
    array( 
      'name'     => 'ElementsKit Elementor addons and Templates Library', 
      'slug'     => 'elementskit-lite', 
      'required' => false,
    ),
    array( 
      'name'     => 'Jeg Elementor Kit', 
      'slug'     => 'jeg-elementor-kit', 
      'required' => false,
    ),
    array( 
      'name'     => 'Sticky Header Effects for Elementor', 
      'slug'     => 'sticky-header-effects-for-elementor', 
      'required' => false,
    ),
    array( 
      'name'     => 'Envato Elements', 
      'slug'     => 'envato-elements', 
      'required' => false,
    ),
    array( 
      'name'     => 'EWWW Image Optimizer', 
      'slug'     => 'ewww-image-optimizer', 
      'required' => false,
    ),
    array( 
      'name'     => 'Under Construction', 
      'slug'     => 'under-construction-page', 
      'required' => false,
    ),
    array( 
      'name'     => 'UpdraftPlus', 
      'slug'     => 'updraftplus', 
      'required' => false,
    ),
    array( 
      'name'     => 'WooCommerce', 
      'slug'     => 'woocommerce', 
      'required' => false,
    ),
  );

  /*
   * Array of configuration settings.
  */
  $config = array(
    'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
    'default_path' => '',                      // Default absolute path to bundled plugins.
    'menu'         => 'tgmpa-install-plugins', // Menu slug.
    'parent_slug'  => 'themes.php',            // Parent menu slug.
    'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
    'has_notices'  => true,                    // Show admin notices or not.
    'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
    'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
    'is_automatic' => false,                   // Automatically activate plugins after installation or not.
    'message'      => '',                      // Message to output right before the plugins table.
    /*
    'strings'      => array(
      'page_title'                      => __( 'Install Required Plugins', 'theme-slug' ),
      'menu_title'                      => __( 'Install Plugins', 'theme-slug' ),
      // <snip>...</snip>
      'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
    )
    */
  );
  tgmpa( $plugins, $config );
}

// Enqueue JavaScript file
add_action('admin_enqueue_scripts', 'my_enqueue_auto_install_script');

function my_enqueue_auto_install_script($hook) {
    if ('tgmpa-install-plugins' !== $hook) {
        return;
    }

    wp_enqueue_script('auto-install-script', plugin_dir_url(__FILE__) . 'js/auto-install.js', array('jquery'), null, true);
}