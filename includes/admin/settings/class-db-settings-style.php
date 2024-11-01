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
class Db_Settings_Style extends Db_Settings_Page {

    public function __construct() {
        add_action('bubble_current_image',array($this, 'bubble_current_image'));
        add_action('bubble_current_title',array($this, 'bubble_current_title'));        
        add_action('bubble_current_short_description',array($this, 'bubble_current_short_description'));
        add_action('bubble_current_short_description2',array($this, 'bubble_current_short_description2'));
        add_action('bubble_current_styles',array($this, 'bubble_current_styles'));
        parent::__construct('bubbles_style');           
        $this->enqueue_scripts();
        

    }

    protected function init_Settings() {
$this->settings = array(
            'colorStart1' => array(
                'class' => 'colorpicker',
                'type' => 'color',
                'label-class' => '',
                'label' =>  __( 'Color start 1', 'simply-share-links-using-bubbles' ),
                'name' => 'bubble_cs_1',
                'value' => ''
            ),    
            'colorStart2' => array(
                'class' => 'colorpicker',
                'type' => 'color',
                'label-class' => '',
                'label' =>  __( 'Color start 2', 'simply-share-links-using-bubbles' ),
                'name' => 'bubble_cs_2',
                'value' => ''                
            ),
            'colorEnd2' => array(
                'class' => 'colorpicker',
                'type' => 'color',
                'label-class' => '',
                'label' =>  __( 'Color end 2', 'simply-share-links-using-bubbles' ),
                'name' => 'bubble_ce_2',
                'value' => ''                
            )
        );        
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
    
    private function enqueue_scripts(){
        wp_enqueue_script( 'cpa_custom_js', plugins_url( '../../../js/jquery.custom.js', __FILE__ ), array( 'jquery', 'wp-color-picker' ), '', true  );
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker' );   
        wp_register_style( 'simply-share-links-using-bubbles4', plugins_url( 'simply-share-links-using-bubbles/css/prototype.css' ) );        
        wp_enqueue_style( 'simply-share-links-using-bubbles4' );  
        wp_register_style( 'simply-share-links-using-bubbles71', plugins_url( 'simply-share-links-using-bubbles/js/custom/' ) .get_option('simply-share-links-using-bubbles_bubble_style_backend'));        
        wp_enqueue_style( 'simply-share-links-using-bubbles71' );            
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
    
    public function bubble_current_styles(){
        include_once  get_home_path().'/wp-content/plugins/simply-share-links-using-bubbles/includes/admin/views/predefined-bubbles.php';
    }

    public function generateFiles() {
        $str = Db_Script_Helper::bubble_style(get_option('simply-share-links-using-bubbles_bubble_cs_1'),
                get_option('simply-share-links-using-bubbles_bubble_cs_2'),get_option('simply-share-links-using-bubbles_bubble_ce_2'));
        $js = Db_File::create($str, 'css');
        $old = get_option('simply-share-links-using-bubbles_bubble_style');
        Db_File::delete(DAMSES_PLUGIN_DIR_JS.$old);
        update_option('simply-share-links-using-bubbles_bubble_style', $js);        
    }

} 

return new Db_Settings_Style();

