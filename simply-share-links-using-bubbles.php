<?php

/*
Plugin Name: simply share links using bubbles
Plugin URI: http:///wordpress-plugins.damses.com
Description: This plugin allow to show one product in the screen that it is moving for all the window, 
 that give more visibility to your product
Version: 4.5
Author: David Alcaraz Moreno
Author URI: http://damses.com
License: GPLv2 or later
*/

class Damses_Bubbles {
    public function __construct() {
        
        $this->defines();
        $this->includes();        
        add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_scripts' ) );                
        add_action('wp_footer', array($this,'before_body_end'));                
    }  
      
    
    public function register_plugin_scripts() {        

    }    
    
    public function before_body_end(){
        echo '<div id="tope" style="width:100%;height:2px;"></div>';
    }
    
    private function includes(){
        include_once( 'includes/class-db-file.php' );   
        include_once( 'includes/class-db-install.php' );        
        include_once 'includes/abstracts/class-db-option.php';
        include_once 'includes/abstracts/class-db-options-factory.php';
        
        if ( $this->is_request( 'admin' ) ) {
                include_once( 'includes/admin/class-db-admin.php' );
                include_once 'includes/abstracts/class-db-action-utils.php';
                include_once 'includes/abstracts/class-db-settings.php';
                include_once 'includes/abstracts/class-db-settings-url.php';
                include_once( 'includes/class-db-script-helper.php' ); 
        } else {
            include_once( 'includes/abstracts/class-db-url.php' );
            include_once( 'includes/abstracts/class-db-uri-utils.php' );
            include_once( 'includes/abstracts/class-db-shape.php' );
            include_once( 'includes/class-db-factory.php' );
            include_once( 'includes/class-db-bubble.php' );
        }   

    }
    private function is_request( $type ) {
            switch ( $type ) {
                    case 'admin' :
                            return is_admin();
                    case 'frontend' :
                            return ( ! is_admin() );
            }
    }    
    
    private function defines(){
        $this->define( 'DB_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
        $this->define('DAMSES_PLUGIN_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) ));
        $this->define('DAMSES_PLUGIN_DIR_JS', untrailingslashit( plugin_dir_path( __FILE__ ) ).'/js/custom/');
    }
    

    private function define( $name, $value ) {
            if ( ! defined( $name ) ) {
                    define( $name, $value );
            }
    }       
}
$instance = new Damses_Bubbles();
?>
