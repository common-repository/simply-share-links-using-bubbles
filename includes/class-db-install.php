<?php

/**
 * @author      David Alcaraz Moreno
 * @category    Admin
 * @package     simply-share-links-using-bubbles/Admin
 * @version     1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class Db_Install {

    public function __construct() {
        global $wp_version;
        if ( version_compare( $wp_version, '3.5', '<' ) ) {
            wp_die( 'This plugin requires WordPress version 3.5 or higher.' );
        }   
       
        if(!(get_option('bubble_installed'))){
            $exist = file_exists(DAMSES_PLUGIN_DIR_JS);
            $created = !$exist;
            if(!$exist)
                $created = mkdir(DAMSES_PLUGIN_DIR_JS);
            if(!$created && !$exist){
                wp_die( 'The directory: ' .DAMSES_PLUGIN_DIR_JS. ' can\'t be created please check permissions.' );
            }              
            add_option( 'simply-share-links-using-bubbles_bubble_title', 'damses' ); 
            add_option( 'simply-share-links-using-bubbles_bubble_short_description', 'More visibilty to your post or products' ); 
            add_option( 'simply-share-links-using-bubbles_bubble_image', 'Fright Night' ); 
            add_option( 'simply-share-links-using-bubbles_bubble_url', 'http://plugins-damses.com' ); 
            add_option( 'simply-share-links-using-bubbles_damses_url', 'http://plugins-damses.com' ); 
            add_option( 'simply-share-links-using-bubbles_bubble_js', 'empty' ); 
            add_option( 'simply-share-links-using-bubbles_bubble_style', 'empty' );
            add_option( 'simply-share-links-using-bubbles_bubble_active', '' );
            add_option( 'simply-share-links-using-bubbles_bubble_installed', '1' ); 
       }
          add_filter( 'plugin_action_links_'. DB_PLUGIN_BASENAME, array( __CLASS__, 'plugin_action_links' ) );


    }
    public function plugin_action_links( $links ) {
            $action_links = array(
                   'settings' => '<a href="' . admin_url( 'admin.php?page=bubbles_settings' ) . '" title="' . esc_attr( __( 'View Settings', 'simply-share-links-using-bubbles' ) ) . '">' . __( 'Settings', 'simply-share-links-using-bubbles' ) . '</a>',
            );

            return array_merge( $action_links, $links );
    } 

        
}
return new Db_Install();
