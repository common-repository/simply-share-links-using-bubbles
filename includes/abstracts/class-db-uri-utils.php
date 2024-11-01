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

if ( ! class_exists( 'Db_Uri_Utils' ) ) :
abstract class Db_Uri_Utils extends Db_Url {

    protected $items;
    protected $allowed;
    private $options;
    public function __construct(){
        parent::__construct();  
        $this->options =  unserialize( get_option('simply-share-links-using-bubbles-settings-options'));
        if(!is_array($this->options)){
            $this->options = array();
        }                     
        $this->allowed = false;
        $this->items = array();             
    }    
    public abstract function check();
    
    public function buildItemsList(){
        foreach ($this->options as $option) {
            $this->add($option->getValue());
        }
    }
    public function add($item){
        $this->items[] = $item;
    }
    
    public function remove($index){
        if(count($this->items) && array_key_exists($index, $this->items)){
            unset($this->items[$index]);
        }
    }
    
    protected function isAllowed(){
        return $this->allowed;
    }
    
    protected function start(){
        do_action('damses_bubbles_start');
    }
    
    
    
}
endif;