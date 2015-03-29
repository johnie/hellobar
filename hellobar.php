<?php
/*
* Plugin Name: Hellobar
* Plugin URI: https://github.com/johnie/hellobar
* Description: Simple WordPress plugin to display hellobars a.k.a "Notifcations"
* Version: 1.0.0
* Author: Johnie Hjelm
* Author URI: http://johnie.se
* License: MIT
*/

/*
Copyright 2015 Johnie Hjelm <johniehjelm@me.com> (http://johnie.se)

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'HelloBar' ) ) {

  class HelloBar {

    private static $instance;

    /**
     * Tag identifier used by file includes and selector attributes.
     * @var string
     */

    public $tag;

    /**
     * User friendly name used to identify the plugin.
     * @var string
     */

    public $name;

    /**
     * Description of the plugin.
     * @var string
     */

    public $description;

    /**
     * Current version of the plugin.
     * @var string
     */

    public $version;


    /**
     * Hellobar loader instance.
     *
     * @since 1.0.0
     *
     * @return object
     */

    public static function instance() {
      if ( ! isset( self::$instance ) ) {
			   self::$instance = new static;
			   self::$instance->setup_globals();
			   self::$instance->setup_actions();
		  }

      return self::$instance;
    }

    /**
     * Initiate the plugin by setting the default values and assigning any
     * required actions and filters.
     *
     * @access private
     */

    private function setup_actions() {

      if ( is_admin() ):
        // Add options page
        add_action( 'admin_menu', array( $this, '_hello_menu_page' ) );
        add_action( 'admin_init', array( $this, '_hellobar_meta_data' ) );
        add_action( 'save_post', array( $this, 'save_hellobar_data' ), 10, 2 );
        add_filter('user_can_richedit', array( $this, '_hellobar_disable_visual_editor') );

      endif;

      add_action( 'init', array( $this, '_hellobar_post_type' ), 0 );
      add_action( 'rss_item', array( $this, '_hellobar_rss_fields' ) );
      add_action( 'atom_entry', array( $this, '_hellobar_rss_fields' ) );
      add_action( 'rss2_item', array( $this, '_hellobar_rss_fields' ) );

    }

    private function setup_globals() {
      $this->tag = 'hellobar';
      $this->name = 'Hellobar';
      $this->description = 'Simple WordPress plugin to display hellobars a.k.a "Notifcations"';
      $this->version = '1.0.0';
    }

    /**
     * Plugin menu page
     */

    function _hello_menu_page() {
      add_menu_page( __( $this->name . 's', $this->tag ), __( $this->name . 's', $this->tag ), 'manage_options', 'hellobar-plugin-options', array( $this, '_hello_render_plugin_options' ), 'dashicons-megaphone' );
      add_submenu_page( 'hellobar-plugin-options', __( $this->name . ' Settings', $this->tag ), __( $this->name . ' Settings', $this->tag ), 'manage_options', 'hellobar-plugin-settings', array( $this, '_hello_render_plugin_options' ) );
    }

    /**
     * Render the plugin options view.
     */

    function _hello_render_plugin_options() {
      include_once dirname( __FILE__ ) . '/views/plugin-options.php';
    }

    /**
     * Markup for hellobar
     */

    public function render() {
      include_once dirname( __FILE__ ) . '/public/inc/hellobar.php';
    }

    /**
     * Registering hellobar post type
     */

    function _hellobar_post_type() {
      register_post_type( 'hellobar', array(
        'labels' => array(
          'name'                => __( 'Hellobars', 'hellobar' ),
          'singular_name'       => __( 'Hellobar', 'hellobar' ),
          'menu_name'           => __( 'All Hellobars', 'hellobar' ),
          'new_item'            => __( 'Add Hellobar', 'hellobar' ),
          'add_new'             => __( 'Add Hellobar', 'hellobar' ),
          'add_new_item'        => __( 'Add Hellobar', 'hellobar' ),
          'not_found'           => __( 'No hellobars found', 'hellobar' ),
          'not_found_in_trash'  => __( 'No hellobars found in trash', 'hellobar' )
        ),
        'taxonomies'          => array('category'),
        'public'              => true,
        'show_ui'             => true,
        'show_in_nav_menus'   => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => true,
        'rewrite'             => array('slug' => 'status'),
        'show_in_menu'        => 'hellobar-plugin-options',
        'supports'            => array( 'title' , 'excerpt', 'editor' ),
        'capability_type'     => 'post'
      ) );
    }

    /**
     * Register meta box
     */

    function _hellobar_meta_data() {
      add_meta_box( 'hellobar_type',
        'Hellobar Type',
        array( $this, 'display_hellobar_type' ),
        'hellobar', 'normal', 'high'
      );

    }

    /**
     * Markup for meta box
     */

    function display_hellobar_type( $post ) {
      $values   = get_post_custom( $post->ID );
      $selected = get_post_meta( $post->ID, '_hellobar_type_select', true );
			$statuses = get_post_meta( $post->ID, '_hellobar_status', true );
      $link     = get_post_meta( $post->ID, '_hellobar_type_link', true );
      $text     = get_post_meta( $post->ID, '_hellobar_button_text', true );
      wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );

      ?>
        <p><strong>What kind of hellobar is it?</strong></p>
        <p>
        <label for="hellobar_type_select">Type</label>
          <select name="hellobar_type_select" id="hellobar_type_select">
              <option value="alert" <?php selected( $selected, 'alert' ); ?>>Alert</option>
              <option value="notice" <?php selected( $selected, 'notice' ); ?>>Notice</option>
              <option value="campaign" <?php selected( $selected, 'campaign' ); ?>>Campaign</option>
          </select>
        </p>
        <p><strong>Link to another place</strong></p>
        <p>
          <label for="hellobar_type_link">Link</label>
          <input type="text" name="hellobar_type_link" value="<?php echo $link ?>" placeholder="Link to another place">
        </p>
        <p><strong>Text for button (default: Read more)</strong></p>
        <p>
          <label for="hellobar_button_text">Text</label>
          <input type="text" name="hellobar_button_text" value="<?php echo $text ?>" placeholder="Text for button">
        </p>
        <p><strong>What's the status for it?</strong></p>
        <p>
        <label for="hellobar_status">Status</label>
          <select name="hellobar_status" id="hellobar_status">
              <option value="unsolved" <?php selected( $statuses, 'unsolved' ); ?>>Unsolved</option>
              <option value="pending" <?php selected( $statuses, 'pending' ); ?>>Pending</option>
              <option value="resolved" <?php selected( $statuses, 'resolved' ); ?>>Resolved</option>
          </select>
        </p>
      <?php
    }

    /**
     * Save meta box data
     */

    function save_hellobar_data( $post_id ) {
      // Bail if we're doing an auto save
      if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
      // if our nonce isn't there, or we can't verify it, bail
      if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;

      if( isset( $_POST['hellobar_type_select'] ) ) {
        update_post_meta( $post_id, '_hellobar_type_select', esc_attr( $_POST['hellobar_type_select'] ) );
      }

      if( isset( $_POST['hellobar_type_link'] ) ) {
        update_post_meta( $post_id, '_hellobar_type_link', esc_attr( $_POST['hellobar_type_link'] ) );
      }

      if( isset( $_POST['hellobar_button_text'] ) ) {
        update_post_meta( $post_id, '_hellobar_button_text', esc_attr( $_POST['hellobar_button_text'] ) );
      }

      if( isset( $_POST['hellobar_status'] ) ) {
        update_post_meta( $post_id, '_hellobar_status', esc_attr( $_POST['hellobar_status'] ) );
      }

    }

    /**
     * Remove the ability to use the visual editor
     */

    function _hellobar_disable_visual_editor( $default ) {
      global $post;
      if ( $this->tag == get_post_type($post) )
        return false;
      return $default;
    }

    /**
     * Add custom fields to RSS
     */

    function _hellobar_rss_fields() {
      if ( get_post_type() == 'hellobar' && $status = get_post_meta( get_the_ID(), '_hellobar_status', true ) ) {
        if ( is_feed() ) {
          if( !empty($status) ) {
            echo '<hellobar_status>';
            echo ucfirst($status);
            echo '</hellobar_status>';
          }
        }
      }
    }

  }

}

/**
 * Function for hellobar
 */
function hellobar_render() {
  hellobar()->render();
}

/**
* Check if request method is the same as the given method.
*
* @param string $method
* @since 1.0.0
*
* @return bool True if method match false otherwise.
*/
function hellobar_is_method( $method ) {
  return $_SERVER ['REQUEST_METHOD'] == strtoupper( $method );
}

/**
* Remove trailing dobule quote.
* PHP's $_POST object adds this automatic.
*
* @param string $str The string to check.
* @since 1.0.0
*
* @return string
*/
function hellobar_remove_trailing_quotes( $str ) {
  return str_replace( "\'", "'", str_replace( '\"', '"', $str ) );
}

/**
* Get plugin options prefix.
*
* @return string
*/
function _hellobar_get_plugin_options_prefix() {
  return 'hellobar_plugin_option_';
}

/**
* Save plugin options data.
*/
function _hellobar_save_plugin_options() {
  $pattern = '/^' . str_replace( '_', '\_', _hellobar_get_plugin_options_prefix() ) . '.*/';
  $data    = array();
  $keys    = preg_grep( $pattern, array_keys( $_POST ) );

  foreach ( $keys as $key ) {
    if ( ! isset( $_POST[ $key ] ) ) {
      continue;
    }

    $data[ $key ] = hellobar_remove_trailing_quotes( $_POST[ $key ] );

  }

  foreach ( $data as $key => $value ) {
    update_option( $key, $value );
  }
}

/**
* Get plugin option value.
*
* @param string $key
* @param mixed $default
*
* @return mixed
*/
function hellobar_get_plugin_option( $key, $default ='' ) {
  $prefix = _hellobar_get_plugin_options_prefix();
  $value = get_option( $prefix . $key );

  if ( $value === false || !empty( $value ) ) {
    return $value;
  }

  return $default;
}

/**
* Update plugin option.
*
* @param string $key
* @param mixed $value
*/
function hellobar_update_plugin_option( $key, $value ) {
  $prefix = _hellobar_get_plugin_options_prefix();
  update_option( $prefix . $key, $value );
}

if ( !function_exists( 'hellobar' ) ) {
  function hellobar() {
    return HelloBar::instance();
  }
}

add_action( 'plugins_loaded', 'hellobar' );
