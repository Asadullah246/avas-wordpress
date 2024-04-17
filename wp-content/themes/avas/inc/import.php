<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
* ======================================================================
*   Demo Data Import 
* ======================================================================
*/

// Demo instruction
function tx_plugin_intro_text() { ?>
  
    <div class="tx-demo-instructon">
      <h3 style="color:#e84d3e;">&#8594; Important Instruction:</h3>
      <p>&#9957; Best if used on new WordPress install.</p>
      <p>&#9957; If you plan to import more than one demo then please clear the existing demo before import the new demo. You can use the "WP Reset" plugin to reset everything.</p>
      <p>&#9957; If the import process gets stuck, please reload the page and click the "Continue & Import" button again.</p>
      <p>&#9957; Before start importing demo data please check your server resources to meet our server minimum requirements below.</p>
      <h3>System Requirements</h3>
<?php
    // system requirements
    tx_Welcome_Screen::tx_system_requirements();
    echo '</div>';
}
add_filter( 'ocdi/plugin_intro_text', 'tx_plugin_intro_text' );

// Demo admin menu
function tx_plugin_page_setup( $default_settings ) {
    $default_settings['page_title']  = esc_html__( 'Avas Demo Data Import' , 'avas' );
    $default_settings['menu_title']  = esc_html__( 'Import Demo Data' , 'avas' );
 
    return $default_settings;
}
add_filter( 'ocdi/plugin_page_setup', 'tx_plugin_page_setup' );

// Demo menu setup
function tx_demo_menu_setup() {
  
          //Set Menu
          $top_menu = get_term_by( 'name', 'Top Menu', 'nav_menu' );
          $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
          $footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
          $left_menu = get_term_by( 'name', 'Left Menu', 'nav_menu' );
          $right_menu = get_term_by( 'name', 'Right Menu', 'nav_menu' );
          $side_menu = get_term_by( 'name', 'Side Menu', 'nav_menu' );
          $mobile_menu = get_term_by( 'name', 'Mobile Menu', 'nav_menu' );
          set_theme_mod( 'nav_menu_locations' , array( 
                'top_menu' => $top_menu->term_id,
                'main_menu' => $main_menu->term_id,
                'footer_menu'  => $footer_menu->term_id,
                'left_menu'  => $left_menu->term_id,
                'right_menu'  => $right_menu->term_id,
                'side_menu'  => $side_menu->term_id,
                'mobile_menu'  => $mobile_menu->term_id,
               ) 
          );
          
        
        wp_delete_post( 1, true ); // delete Hello world post 
       // wp_delete_post( 2, true ); // delete Sample Page

        // update permalinks Post name
        // update_option('permalink_structure', '/%postname%/');
        // update_option('permalink_structure', '/%year%/%monthnum%/%postname%/');

}
add_action('tx_demo_menu_setup', 'tx_demo_menu_setup');

// Themebuilder settings
add_action('tx_themebuilder_demo_setup','tx_themebuilder_demo_setup');
function tx_themebuilder_demo_setup() {
  $tb_templates = array(
    'global' => 'Entire Site',
    'archive' => 'Archives',
    'single' => 'Singular',
  );

  update_option('global_condition_select', 'global');

  flush_rewrite_rules();

}

// LearnPress Settings
add_action('tx_learnpress_settings', 'tx_learnpress_settings');
function tx_learnpress_settings() {
  $lp_pages = array(
    'learn_press_courses_page_id' => 'Courses',
    'learn_press_profile_page_id' => 'Profile',
    'learn_press_checkout_page_id'  => 'Checkout',
    'learn_press_become_a_teacher_page_id'  => 'Become A Teacher',
    'learn_press_term_conditions_page_id' => 'Term Conditions',
  );
  foreach( $lp_pages as $lp_page_name => $lp_page_title ) {
    $lp_page = get_page_by_title( $lp_page_title );
      if( isset( $lp_page->ID ) && $lp_page->ID ) {
        update_option($lp_page_name, $lp_page->ID);
      }
  }
  flush_rewrite_rules();
}

// WooCommerce Settings
add_action('tx_woocommerce_settings', 'tx_woocommerce_settings');
function tx_woocommerce_settings() {
      $woopages = array(
        'woocommerce_shop_page_id'      => 'Shop',
        'woocommerce_cart_page_id'     => 'Shopping Cart',
        'woocommerce_checkout_page_id'   => 'Checkout',
        'woocommerce_myaccount_page_id'  => 'My Account'
      );
      foreach( $woopages as $woo_page_name => $woo_page_title ) {
        $woopage = get_page_by_title( $woo_page_title );
        if( isset( $woopage->ID ) && $woopage->ID ) {
          update_option($woo_page_name, $woopage->ID);
        }
      }

      if( class_exists('WC_Admin_Notices') ) {
        WC_Admin_Notices::remove_notice('install');
      }
      delete_transient( '_wc_activation_redirect' );
      
      
      flush_rewrite_rules();
}

// Update WooCommerce Lookup Table
add_action('tx_update_woocommerce_lookup_table', 'tx_update_woocommerce_lookup_table');
function tx_update_woocommerce_lookup_table() {
      if( function_exists('wc_update_product_lookup_tables_is_running') && function_exists('wc_update_product_lookup_tables') ){
        if( !wc_update_product_lookup_tables_is_running() ){
          if( !defined('WP_CLI') ){
            define('WP_CLI', true);
          }
          wc_update_product_lookup_tables();
        }
      }
}

// Import Slider Revolution
function tx_rev_slider_import($slider_urls) {

        foreach( $slider_urls as $slider_url ) {

          if (!class_exists('WP_Http'))
              include_once( ABSPATH . WPINC . '/class-http.php' );
          $http = new WP_Http();

          $response = $http->request($slider_url);

          if ($response['response']['code'] != 200) {
              return false;
          }

          $upload = wp_upload_bits(basename($slider_url), null, $response['body']);

          if (!empty($upload['error'])) {
              return false;
          }

          $file_path = $upload['file'];

          $slider = new RevSliderSliderImport();

          $slider->importSliderFromPost(true,true,$file_path);

        }
        return $slider_urls;
}

// Theme Builder import
function tx_theme_builder_import($tb_url) {
  $encode_options = file_get_contents($tb_url);
  $options = json_decode($encode_options, true);      
            
  foreach ($options as $key => $value) {
    update_option($key, $value);  
  } 

  return $tb_url;

}

// Demo plugin setup
function tx_register_plugins( $plugins ) {
  // List of plugins used by all theme demos.
  $theme_plugins = [
    [
          'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
    ],
    [
          'name'               => esc_html__( 'Contact Form 7', 'avas' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
    ],
    [
          'name'               => esc_html__( 'Slider Revolution', 'avas' ), // The plugin name.
          'slug'               => 'revslider', // The plugin slug (typically the folder name).
          'source'             => 'https://avas.live/revslider/revslider.zip', // The plugin source.
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
    ],  
  ];

  // Check if user is on the theme recommended plugins step and a demo was selected.
  if (
    isset( $_GET['step'] ) &&
    $_GET['step'] === 'import' &&
    isset( $_GET['import'] )
  ) {

    // Air Conditioning Services
    if ( $_GET['import'] === '1' ) {
      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'avas' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],

      ];
    }

    // Artificial Intelligence
    if ( $_GET['import'] === '4' ) {
      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'avas' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'MC4WP: Mailchimp for WordPress', 'avas' ), // The plugin name.
          'slug'               => 'mailchimp-for-wp', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],

      ];
    }
 
    // Bakery
    if ( $_GET['import'] === '5' ) {
      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'avas' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Woocommerce', 'avas' ), // The plugin name.
          'slug'               => 'woocommerce', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'WPC Smart Quick View for WooCommerce', 'avas' ), // The plugin name.
          'slug'               => 'woo-smart-quick-view', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'WPC Smart Wishlist for WooCommerce', 'avas' ), // The plugin name.
          'slug'               => 'woo-smart-wishlist', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'WPC Smart Compare for WooCommerce', 'avas' ), // The plugin name.
          'slug'               => 'woo-smart-compare', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Slider Revolution', 'avas' ), // The plugin name.
          'slug'               => 'revslider', // The plugin slug (typically the folder name).
          'source'             => 'https://avas.live/revslider/revslider.zip', // The plugin source.
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
      ];
    }

    // Beauty Salon
    if ( $_GET['import'] === '7' ) {
      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'avas' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'MC4WP: Mailchimp for WordPress', 'avas' ), // The plugin name.
          'slug'               => 'mailchimp-for-wp', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Woocommerce', 'avas' ), // The plugin name.
          'slug'               => 'woocommerce', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'WPC Smart Quick View for WooCommerce', 'avas' ), // The plugin name.
          'slug'               => 'woo-smart-quick-view', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'WPC Smart Wishlist for WooCommerce', 'avas' ), // The plugin name.
          'slug'               => 'woo-smart-wishlist', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'WPC Smart Compare for WooCommerce', 'avas' ), // The plugin name.
          'slug'               => 'woo-smart-compare', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],

      ];
    }

    // Bicycle Repair
    if ( $_GET['import'] === '8' ) {
      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'avas' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],

      ];
    }

    // Business Consultant
    if ( $_GET['import'] === '11' ) {
      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'avas' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'MC4WP: Mailchimp for WordPress', 'avas' ), // The plugin name.
          'slug'               => 'mailchimp-for-wp', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],

      ];
    }

    // Charity
    if ( $_GET['import'] === '12' ) {
      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'avas' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Give - Donation Plugin', 'avas' ), // The plugin name.
          'slug'               => 'give', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Slider Revolution', 'avas' ), // The plugin name.
          'slug'               => 'revslider', // The plugin slug (typically the folder name).
          'source'             => 'https://avas.live/revslider/revslider.zip', // The plugin source.
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
      ];
    }

    // Chef
    if ( $_GET['import'] === '13' ) {
      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Slider Revolution', 'avas' ), // The plugin name.
          'slug'               => 'revslider', // The plugin slug (typically the folder name).
          'source'             => 'https://avas.live/revslider/revslider.zip', // The plugin source.
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
      ];
    }

    // Coronavirus
    if ( $_GET['import'] === '17' ) {
      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'avas' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],

      ];
    }

    // Creative Agency
    if ( $_GET['import'] === '20' ) {
      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'avas' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Woocommerce', 'avas' ), // The plugin name.
          'slug'               => 'woocommerce', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'WPC Smart Quick View for WooCommerce', 'avas' ), // The plugin name.
          'slug'               => 'woo-smart-quick-view', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'WPC Smart Wishlist for WooCommerce', 'avas' ), // The plugin name.
          'slug'               => 'woo-smart-wishlist', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'WPC Smart Compare for WooCommerce', 'avas' ), // The plugin name.
          'slug'               => 'woo-smart-compare', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Slider Revolution', 'avas' ), // The plugin name.
          'slug'               => 'revslider', // The plugin slug (typically the folder name).
          'source'             => 'https://avas.live/revslider/revslider.zip', // The plugin source.
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
      ];
    }

    // Crypto News
    if ( $_GET['import'] === '21' ) {
      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'avas' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
      ];
    }

    // Cyber Security Services
    if ( $_GET['import'] === '22' ) {
      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'avas' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'MC4WP: Mailchimp for WordPress', 'avas' ), // The plugin name.
          'slug'               => 'mailchimp-for-wp', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],

      ];
    }

    // Designer
    if ( $_GET['import'] === '24' ) {
      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'avas' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
      ];
    }

    // Digital Marketing Agency
    if ( $_GET['import'] === '26' ) {
      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'avas' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'MC4WP: Mailchimp for WordPress', 'avas' ), // The plugin name.
          'slug'               => 'mailchimp-for-wp', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],

      ];
    }

    // eBook
    if ( $_GET['import'] === '28' ) {

      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'avas' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Woocommerce', 'avas' ), // The plugin name.
          'slug'               => 'woocommerce', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'WPC Smart Quick View for WooCommerce', 'avas' ), // The plugin name.
          'slug'               => 'woo-smart-quick-view', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'WPC Smart Wishlist for WooCommerce', 'avas' ), // The plugin name.
          'slug'               => 'woo-smart-wishlist', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'WPC Smart Compare for WooCommerce', 'avas' ), // The plugin name.
          'slug'               => 'woo-smart-compare', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Slider Revolution', 'avas' ), // The plugin name.
          'slug'               => 'revslider', // The plugin slug (typically the folder name).
          'source'             => 'https://avas.live/revslider/revslider.zip', // The plugin source.
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],

      ];
    }

    // Education
    if ( $_GET['import'] === '29' ) {

      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'avas' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'LearnPress', 'avas' ), // The plugin name.
          'slug'               => 'learnpress', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'LearnPress Course Review', 'avas' ), // The plugin name.
          'slug'               => 'learnpress-course-review', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Slider Revolution', 'avas' ), // The plugin name.
          'slug'               => 'revslider', // The plugin slug (typically the folder name).
          'source'             => 'https://avas.live/revslider/revslider.zip', // The plugin source.
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],

      ];
    }

    // Education Two
    if ( $_GET['import'] === '30' ) {

      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'avas' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'LearnPress', 'avas' ), // The plugin name.
          'slug'               => 'learnpress', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'LearnPress Course Review', 'avas' ), // The plugin name.
          'slug'               => 'learnpress-course-review', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Slider Revolution', 'avas' ), // The plugin name.
          'slug'               => 'revslider', // The plugin slug (typically the folder name).
          'source'             => 'https://avas.live/revslider/revslider.zip', // The plugin source.
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],

      ];
    }

    // Events
    if ( $_GET['import'] === '31' ) {

      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'avas' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'The Events Calendar', 'avas' ), // The plugin name.
          'slug'               => 'the-events-calendar', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Slider Revolution', 'avas' ), // The plugin name.
          'slug'               => 'revslider', // The plugin slug (typically the folder name).
          'source'             => 'https://avas.live/revslider/revslider.zip', // The plugin source.
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],

      ];
    }

    // Forum
    if ( $_GET['import'] === '34' ) {

      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'avas' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'bbPress', 'avas' ), // The plugin name.
          'slug'               => 'bbpress', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],

      ];
    }

    // ICO Cryptocurrency
    if ( $_GET['import'] === '38' ) {

      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'avas' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        
      ];
    }

    // ISP
    if ( $_GET['import'] === '41' ) {
      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'avas' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'MC4WP: Mailchimp for WordPress', 'avas' ), // The plugin name.
          'slug'               => 'mailchimp-for-wp', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],

      ];
    }

    // IT Solutions
    if ( $_GET['import'] === '42' ) {
      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'avas' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'MC4WP: Mailchimp for WordPress', 'avas' ), // The plugin name.
          'slug'               => 'mailchimp-for-wp', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],

      ];
    }

    // Magazine
    if ( $_GET['import'] === '45' ) {

      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'avas' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
      ];
    }

    // Movers
    if ( $_GET['import'] === '48' ) {

      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'avas' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
      ];
    }

    // News Dark
    if ( $_GET['import'] === '51' ) {

      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'avas' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
      ];
    }

    // Portfolio
    if ( $_GET['import'] === '53' ) {

      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'avas' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'MC4WP: Mailchimp for WordPress', 'avas' ), // The plugin name.
          'slug'               => 'mailchimp-for-wp', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
      ];
    }

    // Pet Care
    if ( $_GET['import'] === '54' ) {

      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'avas' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'MC4WP: Mailchimp for WordPress', 'avas' ), // The plugin name.
          'slug'               => 'mailchimp-for-wp', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Woocommerce', 'avas' ), // The plugin name.
          'slug'               => 'woocommerce', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'WPC Smart Quick View for WooCommerce', 'avas' ), // The plugin name.
          'slug'               => 'woo-smart-quick-view', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'WPC Smart Wishlist for WooCommerce', 'avas' ), // The plugin name.
          'slug'               => 'woo-smart-wishlist', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'WPC Smart Compare for WooCommerce', 'avas' ), // The plugin name.
          'slug'               => 'woo-smart-compare', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],

      ];
    }

    // Pinterest
    if ( $_GET['import'] === '56' ) {

      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'avas' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
      ];
    }

    // Real Estate
    if ( $_GET['import'] === '58' ) {

      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'avas' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Estatik', 'avas' ), // The plugin name.
          'slug'               => 'estatik', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Slider Revolution', 'avas' ), // The plugin name.
          'slug'               => 'revslider', // The plugin slug (typically the folder name).
          'source'             => 'https://avas.live/revslider/revslider.zip', // The plugin source.
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],

      ];

    }

    // Resume
    if ( $_GET['import'] === '60' ) {

      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'avas' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
      ];
    }

    // Shop
    if ( $_GET['import'] === '63' ) {

      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'avas' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Woocommerce', 'avas' ), // The plugin name.
          'slug'               => 'woocommerce', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'WPC Smart Quick View for WooCommerce', 'avas' ), // The plugin name.
          'slug'               => 'woo-smart-quick-view', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'WPC Smart Wishlist for WooCommerce', 'avas' ), // The plugin name.
          'slug'               => 'woo-smart-wishlist', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'WPC Smart Compare for WooCommerce', 'avas' ), // The plugin name.
          'slug'               => 'woo-smart-compare', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Slider Revolution', 'avas' ), // The plugin name.
          'slug'               => 'revslider', // The plugin slug (typically the folder name).
          'source'             => 'https://avas.live/revslider/revslider.zip', // The plugin source.
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],

      ];
    }

    // Tattoo Parlour
    if ( $_GET['import'] === '66' ) {

      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'avas' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
      ];
    }

    // Technology
    if ( $_GET['import'] === '67' ) {
      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'avas' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'MC4WP: Mailchimp for WordPress', 'avas' ), // The plugin name.
          'slug'               => 'mailchimp-for-wp', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Slider Revolution', 'avas' ), // The plugin name.
          'slug'               => 'revslider', // The plugin slug (typically the folder name).
          'source'             => 'https://avas.live/revslider/revslider.zip', // The plugin source.
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],

      ];
    }

    // Transportation & logistics
    if ( $_GET['import'] === '68' ) {

      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'avas' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
      ];
    }

    // Yoga
    if ( $_GET['import'] === '73' ) {

      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'avas' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'The Events Calendar', 'avas' ), // The plugin name.
          'slug'               => 'the-events-calendar', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Slider Revolution', 'avas' ), // The plugin name.
          'slug'               => 'revslider', // The plugin slug (typically the folder name).
          'source'             => 'https://avas.live/revslider/revslider.zip', // The plugin source.
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],

      ];
    }
 
    

  }
 
  return array_merge( $plugins, $theme_plugins );
}
add_filter( 'ocdi/register_plugins', 'tx_register_plugins' );

/* ---------------------------------------------------------
    EOF
------------------------------------------------------------ */