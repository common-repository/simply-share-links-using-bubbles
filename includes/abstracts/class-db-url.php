<?php

/**
 * @author      David Alcaraz Moreno
 * @category    Front
 * @package     simply-share-links-using-bubbles/Front
 * @version     1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Db_Url' ) ) :
abstract class Db_Url {
    protected $current;
    public function __construct(){
        global $_SERVER;
        $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
        $this->current = $protocol.$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ;
    }        
       
}

endif;