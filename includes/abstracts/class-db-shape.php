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

if ( ! class_exists( 'Db_Shape' ) ) :
abstract class Db_Shape {
    protected $settings;
    
    public function __construct() {
        $this->settings = array();
        
        $this->init();
        $this->get_values();
        add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );      
        add_action( 'wp_enqueue_scripts', array( $this, 'register_css' ) );                  
        add_filter( 'the_content',array( $this, 'render'));          
    }
    
    public abstract function init();
    
    public abstract function render($content);    

    public abstract function register_scripts();
    
    public abstract function getHtml();
    
    public function get_values(){
            $aux = array();
            foreach($this->settings as $key => $setting){
                $setting['value'] = get_option('simply-share-links-using-bubbles_'.$setting['name']);
                $aux[$key] = $setting; 
            }
            $this->settings = $aux;        
    }
    
    public abstract function register_css();
}
endif;