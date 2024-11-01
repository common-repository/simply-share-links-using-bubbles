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

if ( ! class_exists( 'Db_Options' ) ) :
abstract class Db_Options_Factory {

    protected $items; 
    
    public function __construct(){
        $this->items = array();
        add_action('damses_bubbles_get_items',array($this, 'get_values'));
    }
    
    public abstract function check();
    
    public abstract function getSettings();


    public function get_values(){
        $this->items = unserialize( get_option('simply-share-links-using-bubbles-settings-options'));
        if(!is_array($this->items)){
            $this->items = array();
        }
    }
        
    public function save(){
        update_option('simply-share-links-using-bubbles-settings-options', serialize($this->items));
    }
}
endif;