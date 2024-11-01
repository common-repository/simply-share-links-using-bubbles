<?php

/**
 *
 * @author      David Alcaraz Moreno
 * @category    Admin
 * @package     simply-share-links-using-bubbles/Admin
 * @version     1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Db_Admin_Menus' ) ) :
    
class Db_Admin_Menus {
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
        //add_action( 'admin_menu', array( $this, 'settings_menu' ), 50 );        
    }
    
    public function admin_menu(){
        global $menu;

        add_menu_page( __( 'Bubbles', 'simply-share-links-using-bubbles' ), __( 'Bubbles', 'simply-share-links-using-bubbles' ), 'manage_options', 'simply-share-links-using-bubbles-menu', array($this,'prowp_db_start_page' ), null, '55.5' );        

        add_submenu_page( 'simply-share-links-using-bubbles-menu', __( 'Settings', 'simply-share-links-using-bubbles' ),'Settings', 'manage_options', 'bubbles_settings',array($this,'prowp_db_settings_page' ));
        
        add_submenu_page( 'simply-share-links-using-bubbles-menu', __( 'Style', 'simply-share-links-using-bubbles' ),'Style', 'manage_options', 'bubbles_style',array($this,'prowp_db_style_page' ));
        
        add_submenu_page( 'simply-share-links-using-bubbles-menu', __( 'Urls', 'simply-share-links-using-bubbles' ),'Urls', 'manage_options', 'bubbles_urls',array($this,'prowp_db_urls_page' ));

    }
    public function prowp_db_settings_page(){        
        include_once 'settings/class-db-settings-general.php';
    }
    
    public function prowp_db_style_page(){        
       include_once 'settings/class-db-settings-style.php';
    }    
    public function prowp_db_start_page(){
        include_once 'settings/class-db-start.php';
    }
    public function prowp_db_urls_page(){
        include_once 'settings/class-db-settings-url.php';
    }
}

endif;
return new Db_Admin_Menus();
