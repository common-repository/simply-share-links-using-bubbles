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

if ( ! class_exists( 'Db_Admin_Bubble' ) ) :
class Db_Admin_Bubble {
    
    public function __construct(){
        $this->addResources();
        $this->registerStyle();
        
    }
    
    protected function registerStyle(){
        wp_register_style( 'simply-share-links-using-bubbles4', plugins_url( 'simply-share-links-using-bubbles/css/prototype.css' ) );        
        wp_enqueue_style( 'simply-share-links-using-bubbles4' );          
        wp_register_style( 'simply-share-links-using-bubbles71', plugins_url( 'simply-share-links-using-bubbles/js/custom/' ) .get_option('simply-share-links-using-bubbles_bubble_style_backend'));        
        wp_enqueue_style( 'simply-share-links-using-bubbles71' );           
    }
    public function bubble_current_image(){
        
        echo get_option('simply-share-links-using-bubbles_bubble_image');
    }
    
    public function bubble_current_title(){
        echo get_option('simply-share-links-using-bubbles_bubble_title');
    }
    
    public function bubble_current_short_description(){
        echo get_option('simply-share-links-using-bubbles_bubble_short_description');
    }
    
    public function bubble_current_short_description2(){
        echo get_option('simply-share-links-using-bubbles_bubble_short_description2');
    }     
    
    public function addResources(){
        $type = get_option('simply-share-links-using-bubbles_bubble_type') == 'on' ? TRUE : FALSE;
        if(!$type){
            add_action('bubble_current_image',array($this, 'bubble_current_image'));
            add_action('bubble_current_title',array($this, 'bubble_current_title'));        
            add_action('bubble_current_short_description',array($this, 'bubble_current_short_description'));
            add_action('bubble_current_short_description2',array($this, 'bubble_current_short_description2'));            
        }        
    }
}
endif;
return new Db_Admin_Bubble();