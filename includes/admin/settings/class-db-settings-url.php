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
class Db_Settings_Url extends Db_Settings_Url_Page {

    protected $factory;
    public function __construct() {        
        include_once 'class-db-options-url.php';        
        add_action('damses_bubbles_input', array($this, 'url_input'));
        $this->factory = new Options_Url();
        do_action('damses_bubbles_get_items');
        parent::__construct('bubbles_urls');  
        wp_enqueue_script( 'logic_js_urls', plugins_url( '../../../js/burls.js', __FILE__ ), array( 'jquery' ), '', true  );         
        
    }

    protected function init_Settings() {
        $this->settings = $this->factory->getSettings();                
    }

    public function save($post_id, $post) {
        $this->factory->update($post);
        $this->messages[] =  __( 'Settings saved', 'simply-share-links-using-bubbles' );   
        
    }

    public function show_form_image() {
        
    }

    public function generateFiles() {
        
    }
        
    public function generateForm(){  
        switch ($this->action){
            case 'bubbles_urls':
                $this->settings = array();
                $this->factory = new Options_Url();
                do_action('damses_bubbles_get_items');
                $this->init_Settings();
                break;                
            default:
                break;
        }            
        echo '<form id="post" name="post" method="POST" action="admin.php?page='.$this->id.'"  enctype="multipart/form-data">';
        echo '  <input type="hidden" name="action" value="'.$this->id.'">';

        $this->render();
        $this->get_submit_button();
        echo '</form>';
        do_action('damses_bubble_image_'.$this->id);
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
    
    public function url_input(){
        include_once  DAMSES_PLUGIN_DIR.'/includes/admin/views/urls-view.php';
    }

}

return new Db_Settings_Url();
