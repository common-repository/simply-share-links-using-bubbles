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

if ( ! class_exists( 'Db_Factory' ) ) :
class Db_Factory extends Db_Uri_Utils {
    public function __construct(){
        parent::__construct();  
    }
    public function check() {
        $showAllPages = get_option('simply-share-links-using-bubbles_bubble_allow_all_pages') == 'on' ? true : false;
        if($showAllPages){
            return TRUE;   
        }
        $this->buildItemsList();   
        return in_array($this->current, $this->items);
    }


}
endif;