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
class Db_Start {
    public function __construct() {
        include_once  DAMSES_PLUGIN_DIR.'/includes/admin/views/init-view.php';
    }
}
return new Db_Start();