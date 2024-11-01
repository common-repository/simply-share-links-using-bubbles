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

if ( ! class_exists( 'Db_Settings_Page' ) ) :


abstract class Db_Settings_Page extends Db_Action_Utils{

	protected $id    = '';
	protected $label = '';
        protected $settings = array();
        protected $messages = array();
        protected $errors = array();

        /**
	 * Constructor
	 */
	public function __construct($id) {
            parent::__construct();  
            $this->id = $id;            
            add_action( 'damses_bubbles_register_scripts', array($this,'register_scripts') );             
            add_action('damses_bubble_post_'.$this->id,array($this, 'save'),10,2);
            add_action( 'damses_bubbles_save_settings', array($this,'doSave') );
            add_action('damses_bubble_image_'.$this->id,array($this, 'show_form_image'));
            add_action('damses_bubbles_show_messages',array($this, 'get_messages'));
            add_action( 'damses_bubbles_generate_form', array($this,'generateForm') );
            add_action( 'damses_bubbles_get_values', array($this,'get_values') );            
            add_action('init_settings_'.$this->id,array($this, 'render'));  
            $this->init_Settings();  
            $this->includes();
	}
        
        public function getId(){
            return $this->id;
        }

        abstract public function save($post_id, $post);
        
        abstract public function show_form_image();
        
        abstract protected function init_Settings();
        
        abstract public function includes();
        
        abstract public function generateFiles();

        public function get_values(){
            $aux = array();
            foreach($this->settings as $setting){
                if(empty($setting['value'])){
                    $setting['value'] = get_option('simply-share-links-using-bubbles_'.$setting['name']);
                }
                $aux[] = $setting; 
            }
            $this->settings = $aux;
        }
        
        public function render() {
            foreach ($this->settings as $key => $setting) {
                $this->getFormItem($setting);
            }
        }
                
        
        public function generateForm(){            
            echo '<form id="post" name="post" method="POST" action="admin.php?page='.$this->id.'"  enctype="multipart/form-data">';
            echo '  <input type="hidden" name="action" value="'.$this->id.'">';
               
            $this->render();
            $this->get_submit_button();
            echo '</form>';
            do_action('damses_bubble_image_'.$this->id);
        }     
        
        public function doSave(){        
            switch ($this->action){
                case 'bubbles_settings':
                case 'bubbles_style':
                case 'activation_settings':
                case 'bubbles_urls':
                    do_action('damses_bubble_post_'.$this->getId(), $this->id,$this->params);
                    break;                
                default:
                    break;
            }            
            
        }

    
        public function sanitaize($setting){
            switch ($setting['type']){
                case 'text' :
                    $setting['value'] = sanitize_text_field($setting['value']);
                    break;
                case 'file' :
                    $setting['value'] = esc_url($setting['value']);
                    break;    
                default:
                    $setting['value'] = sanitize_text_field($setting['value']);
                    break;                    
            }
            return $setting;
        }    
        
        public function get_messages(){
            if(count($this->messages) > 0){
                echo '<div id="message" class="updated notice notice-success is-dismissible below-h2">';
                foreach ($this->messages as $message) {
                    echo '<p>'.$message.'</p>';
                }
                echo '</div>';
            }
        }    
                
        
        public function register_scripts(){
            wp_enqueue_style( 'color-picker' );
            wp_enqueue_script( 'color-picker');           
        }
        
}

endif;
