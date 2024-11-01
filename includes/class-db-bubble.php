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

if ( ! class_exists( 'Db_Bubble' ) ) :
class Db_Bubble extends Db_Shape{
    public function __construct() {
        parent::__construct();    
        $this->factory = new Db_Factory();
        add_action('wp_head',array($this,'getHtml'));
    }

        public function register_css() {        
            wp_register_style( 'simply-share-links-using-bubbles4', plugins_url( 'simply-share-links-using-bubbles/css/prototype.css' ) );        
            wp_enqueue_style( 'simply-share-links-using-bubbles4' );             
        }

        public function register_scripts() {
            wp_register_script( 'simply-share-links-using-bubbles2', plugins_url( 'simply-share-links-using-bubbles/js/lib.js' ) ,   array( 'jquery' ) );
            wp_enqueue_script( 'simply-share-links-using-bubbles2' );
        }

        public function init() {
            $this->settings = array(
                'active' => array(
                    'name' => 'bubble_active',
                    'value' => ''
                ),                
                'title' => array(
                    'name' => 'bubble_title',
                    'value' => ''
                ),
                'short_description' => array(
                    'name' => 'bubble_short_description',
                    'value' => ''                
                ),
                'short_description2' => array(
                    'name' => 'bubble_short_description2',
                    'value' => ''                
                ),
                'image' => array(
                    'name' => 'bubble_image',
                    'value' => ''                
                ),
                'url' => array(
                    'name' => 'bubble_url',
                    'value' => ''                
                ),
                'image_aligment' => array(
                    'name' => 'bubble_image_aligment',
                    'value' => ''                
                )
            );                
        }

        public function render($content) {           
            if(!is_admin()){

                
            }    
            return $content;
        }
        
        public function getHtml() {
            if($this->settings['active']['value'] == 'on'){
                if($this->factory->check()){
                        $html = '';
                        $html .= '<section class="bubble">';
                            $html .= '<figure class="ball bubble-link">';
                             $type = get_option('simply-share-links-using-bubbles_bubble_type') == 'on' ? TRUE : FALSE;
                             if(!$type){
                                $html .= '<img style="width:100px;height: 100px;margin-top: 50px;margin-bottom: 0;margin-left: '.$this->settings['image_aligment']['value'].'px;" src="'.$this->settings['image']['value'].'"/>';
                                $html .= '<p style="margin-top: 0;"><strong>'.$this->settings['title']['value'].'</strong><br/>'.$this->settings['short_description']['value'];
                                $html .= '<strong><br/>'.$this->settings['short_description2']['value'].'</strong>';
                                $html .= '</p>';
                             }                            
                            $html .= '</figure>';
                        $html .= '</section>';
                        echo $html;
                    wp_register_script( 'simply-share-links-using-bubbles7', plugins_url( 'simply-share-links-using-bubbles/js/custom/'.get_option('simply-share-links-using-bubbles_bubble_js') ) ,   array( 'jquery' ) );
                    wp_enqueue_script( 'simply-share-links-using-bubbles7' );   
                    wp_register_style( 'simply-share-links-using-bubbles71', plugins_url( 'simply-share-links-using-bubbles/js/custom/' ) .get_option('simply-share-links-using-bubbles_bubble_style'));        
                    wp_enqueue_style( 'simply-share-links-using-bubbles71' );                 
                }        
            }
            
        }
        
        private function get_type(){
            return get_option('simply-share-links-using-bubbles_bubble_type') == 'on' ? TRUE : FALSE;
        }

    }
endif;

return new Db_Bubble();