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
class Db_Settings_General extends Db_Settings_Page {

    public function __construct() {    
        add_action('bubble_current_image',array($this, 'bubble_current_image'));
        add_action('bubble_current_title',array($this, 'bubble_current_title'));        
        add_action('bubble_current_short_description',array($this, 'bubble_current_short_description'));
        add_action('bubble_current_short_description2',array($this, 'bubble_current_short_description2'));                
        parent::__construct('bubbles_settings');       
        $this->register_script_blogic();
        
    }


        protected function init_Settings(){
        $this->settings = array(
             'bubble_active' => array(
                'class' => '',
                'type' => 'checkbox',
                'label-class' => '',
                'label' =>  __( 'Activate bubble', 'simply-share-links-using-bubbles' ),
                'name' => 'bubble_active',
                'value' => '',
                'information' => __('Activate / Deactivate the bubble in your site','simply-share-links-using-bubbles')
            ),            
             'bubble_type' => array(
                'class' => '',
                'type' => 'checkbox',
                'label-class' => '',
                'label' =>  __( 'Image bubble', 'simply-share-links-using-bubbles' ),
                'name' => 'bubble_type',
                'value' => '',
                'information' => __('Image bubble won\'t have title,description, and description2 use 320x320 images.','simply-share-links-using-bubbles')
            ),
            'title' => array(
                'class' => '',
                'type' => 'text',
                'label-class' => 'screen-reader-text',
                'label' =>  __( 'Title', 'simply-share-links-using-bubbles' ),
                'name' => 'bubble_title',
                'value' => ''
            ),
            'short_description' => array(
                'class' => '',
                'type' => 'text',
                'label-class' => 'screen-reader-text',
                'label' =>  __( 'Short description', 'simply-share-links-using-bubbles' ),
                'name' => 'bubble_short_description',
                'value' => ''                
            ),
            'short_description2' => array(
                'class' => '',
                'type' => 'text',
                'label-class' => 'screen-reader-text',
                'label' =>  __( 'Short description 2', 'simply-share-links-using-bubbles' ),
                'name' => 'bubble_short_description2',
                'value' => ''                
            ),            
            'image' => array(
                'class' => '',
                'type' => 'file',
                'label-class' => 'screen-reader-text',
                'label' =>  __( 'Image', 'simply-share-links-using-bubbles' ),
                'name' => 'bubble_image',
                'value' => ''                
            ),
            'url' => array(
                'class' => '',
                'type' => 'text',
                'label-class' => 'screen-reader-text',
                'label' =>  __( 'Url', 'simply-share-links-using-bubbles' ),
                'name' => 'bubble_url',
                'value' => ''                
            ),
            'left' => array(
                'class' => '',
                'type' => 'text',
                'label-class' => 'screen-reader-text',
                'label' =>  __('Image aligment, some times the image must be aligment in the left', 'damses-bubbles' ),
                'information' => __('Image aligment, some times the image must be aligment in the left, add the number of pixels to align the image if it is needed.', 'damses-bubbles' ),
                'name' => 'bubble_image_aligment',
                'value' => ''                
            ),'open_new_tab' => array(
                'class' => '',
                'type' => 'checkbox',
                'label-class' => '',
                'label' =>  __( 'Open in a new tab', 'simply-share-links-using-bubbles' ),
                'name' => 'bubble_allow_open_in_new_tab',
                'value' => ''     ,
                'information' => __('Open the link in a new tab','simply-share-links-using-bubbles')
            ),
            'allow_all' => array(
                'class' => '',
                'type' => 'checkbox',
                'label-class' => '',
                'label' =>  __( 'Allow all pages', 'simply-share-links-using-bubbles' ),
                'name' => 'bubble_allow_all_pages',
                'value' => ''     ,
                'information' => __('If you want to add only is some posts, you need to add the allowed urls in the url settings','simply-share-links-using-bubbles')
            ),
            'show_only_seconds' => array(
                'class' => '',
                'type' => 'checkbox',
                'label-class' => '',
                'label' =>  __( 'Show only first seconds', 'simply-share-links-using-bubbles' ),
                'name' => 'bubble_show_only_seconds',
                'value' => ''     ,
                'information' => __('If you want to show only a number of seconds.','simply-share-links-using-bubbles')
            ),
            'number_of_seconds_to_show' => array(
                'class' => '',
                'type' => 'text',
                'label-class' => 'screen-reader-text',
                'label' =>  __( 'Number of seconds', 'simply-share-links-using-bubbles' ),
                'name' => 'bubble_number_of_seconds',
                'value' => ''                
            ),
            'delay_to_show' => array(
                'class' => '',
                'type' => 'text',
                'label-class' => 'screen-reader-text',
                'label' =>  __( 'Delay to show the bubble in seconds', 'simply-share-links-using-bubbles' ),
                'name' => 'bubble_delay_seconds',
                'value' => '',
                'information' => __('If you want to show the bubble after X number of seconds (Default 0).','simply-share-links-using-bubbles')
            )
        );
        
    }
    public function bg_settings_field() {

        $val = '';// ( isset( $this->options['title'] ) ) ? $this->options['background'] : '';
        echo '<input type="text" name="cpa_settings_options[background]" value="' . $val . '" class="cpa-color-picker" >';

    }
    public function save($post_id, $post) {                
        foreach ($this->settings as $setting ) {
            $setting['value'] = isset($post[$setting['name']]) ? $post[$setting['name']] : '';
            $setting = $this->sanitaize($setting);
            update_option('simply-share-links-using-bubbles_'.$setting['name'], $setting['value']);
        }
        $this->messages[] =  __( 'Settings saved', 'simply-share-links-using-bubbles' );
        $this->generateFiles();
        
    }

    public function show_form_image() {
     
    }

    public function includes() {
        include_once  DAMSES_PLUGIN_DIR.'/includes/admin/views/form-view2.php';
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
    
    public function register_script_blogic(){
        wp_register_style( 'simply-share-links-using-bubbles4', plugins_url( 'simply-share-links-using-bubbles/css/prototype.css' ) );        
        wp_enqueue_style( 'simply-share-links-using-bubbles4' );  
        wp_register_script( 'simply-share-links-using-bubbles-blogic', plugins_url( 'simply-share-links-using-bubbles/js/blogic.js' ) ,   array( 'jquery' ));
        wp_enqueue_script( 'simply-share-links-using-bubbles-blogic' );          
        wp_register_style( 'simply-share-links-using-bubbles71', plugins_url( 'simply-share-links-using-bubbles/js/custom/' ) .get_option('simply-share-links-using-bubbles_bubble_style_backend'));        
        wp_enqueue_style( 'simply-share-links-using-bubbles71' );          
    }
    public function generateFiles() {        
        

        Db_Script_Helper::generateScript();
    }
}

return new Db_Settings_General();