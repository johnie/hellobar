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
    public $tag = '';

    /**
    * User friendly name used to identify the plugin.
    * @var string
    */
    public $name = '';

    /**
    * Current version of the plugin.
    * @var string
    */
    public $version = '';

    public static function instance() {
      if ( ! isset( self::$instance ) ) {
			   self::$instance = new static;
			   self::$instance->setup_globals();
			   self::$instance->setup_actions();
		  }

      return self::$instance;
    }

    private function setup_actions() {

      if ( is_admin() ):
        // Add options page
        add_action( 'admin_menu', array( $this, '_hello_menu_page' ) );
      endif;

    }

    private function setup_globals() {
      $this->tag = 'hellobar';
      $this->name = 'Hellobar';
      $this->version = '1.0.0';
    }

    /**
     * Plugin menu page
     */
     function _hello_menu_page() {
       add_menu_page( __( 'Hellobar Settings', $this->tag ), __( 'Hellobar Settings', $this->tag ), 'manage_options', 'hellobar-plugin-options', array( $this, '_hello_render_plugin_options' ), 'dashicons-megaphone' );
     }

     /**
      * Render the plugin options view.
      */
     function _hello_render_plugin_options() {
       include_once dirname( __FILE__ ) . '/views/plugin-options.php';
     }

  }

}

if ( !function_exists('hellobar')) {
  function hellobar() {
    return HelloBar::instance();
  }
}

add_action('plugins_loaded', 'hellobar');
