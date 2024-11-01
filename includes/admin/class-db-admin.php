<?php

/**
 * @author       David Alcaraz Moreno
 * @category    Admin
 * @package     simply-share-links-using-bubbles/Admin
 * @version     1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


class Db_Admin {

    public function __construct() {
		add_action( 'admin_menu', array( $this, 'includes' ), 9 );   
    }
	/**
	 * Add menu items
	 */
	public function includes() {
            include_once 'class-db-admin-menus.php';            
	}    
}


return new Db_Admin();
