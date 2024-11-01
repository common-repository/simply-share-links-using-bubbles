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

if ( ! class_exists( 'Db_Action_Utils' ) ) :

abstract class Db_Action_Utils {
        protected $action;
        protected $params = array();
        public function __construct(){
            $this->params = $_POST;
            $this->action = isset( $_POST['action']) ? $_POST['action'] : '';
            wp_enqueue_media();                            
        }
        
        protected function saveFile($name){
            /*
            global $_FILES;
            if ( ! function_exists( 'wp_handle_upload' ) ) {
                require_once( ABSPATH . 'wp-admin/includes/file.php' );
            }

            $uploadedfile = $_FILES[$name];

            $upload_overrides = array( 'test_form' => false );

            $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );

            if ( $movefile && !isset( $movefile['error'] ) ) {
                return $movefile;
            } 
            return FALSE;
             * 
             */
        }
        
        private function get_html_text_input($setting){
            if(isset($setting['information'])){
                echo '<p><strong>';
                    echo $setting['information'];
                echo '</strong></p>';
            }            
            echo '<div id="titlewrap" style="margin-top:20px;">';
            echo '<label id="'.$setting['name'].'-prompt-text" class="'.$setting['label-class'].'" for="'.$setting['name'].'">' .$setting['label'].'</label>';
            echo '<input type="text" name="'.$setting['name'].'" size="30"  class="'.$setting['class'].'" value="'.$setting['value'].'" id="'.$setting['name'].'" spellcheck="true" autocomplete="off" style="padding: 3px 8px;font-size: 1.7em;line-height: 100%;height: 1.7em;width: 100%;outline: 0px none;margin: 0px 0px 0px;background-color: rgb(255, 255, 255);"/>';
            echo '</div>';            
        }
        private function get_html_text_url($setting){
            echo '<div class="delete" style="margin-top:20px;">';
            echo '<input type="text" name="'.$setting['name'].'" size="30"  class="'.$setting['class'].'" value="'.$setting['value'].'" id="'.$setting['name'].'" spellcheck="true" autocomplete="off" style="padding: 3px 8px;font-size: 1.7em;line-height: 100%;background-color: rgb(255, 255, 255);width: 93%;height: 35px;margin-bottom:20px;"/>';
            echo '<button >delete</button>';
            echo '</div>';            
        }        
        private function get_html_color_input($setting){
            echo '<label id="'.$setting['name'].'-prompt-text" class="'.$setting['label-class'].'" style="margin-top:20px;">' .$setting['label'].'</label>';
            echo '<div id="titlewrap">';            
            echo '<input type="text" name="'.$setting['name'].'"  class="'.$setting['class'].'" value="'.$setting['value'].'" id="'.$setting['name'].'"/>';
            echo '</div>';
            
        }        
        private function get_add_media($setting){

            echo '<div style="margin-top:20px;">';
                echo '<a href="#" id="'.$setting['name'].'-media" class="button">'.__( 'Add bubble image', 'simply-share-links-using-bubbles' ).'</a>';
                echo '<input type="hidden" name="'.$setting['name'].'"  value="'.$setting['value'].'" id="'.$setting['name'].'" />';
                echo '<script type="text/javascript">';
                echo 'jQuery(function($) {
                        $(document).ready(function(){
                                $("#'.$setting['name'].'-media").click(open_media_window);
                            });

                        function open_media_window() {
                            var window = wp.media({
                                    title: "Insert bubble image",
                                    library: {type: "image"},
                                    multiple: false,
                                    button: {text: "Insert"}
                                }).open();     
                            window.on("select", function(){
                                var image = window.state().get("selection").first().toJSON();
                                console.log(image.url);
                                $("#image-container").html("<img style=\"width:100px;height: 100px;margin-left: 100px;margin-top: 50px;margin-bottom: 0;\"  id=\"image-view\" src=\"" + image.url + " \" title=\"'.__( 'Add bubble image', 'simply-share-links-using-bubbles' ).'\"/>");
                                $("#'.$setting['name'].'").val(image.url);
                                $("#dyanmic-bubble-image").attr("src",image.url);
                            });                            
                        }

                    });';
                echo '</script>';
                echo '<div id="image-container" >';
                echo '<img style="width:100px;height: 100px;margin-left: 100px;margin-top: 50px;margin-bottom: 0;"  id="image-view" src="'.$setting['value'].'" title="'.__( 'Add bubble image', 'simply-share-links-using-bubbles' ).'"/>';
                echo '</div>';
            echo '</div>';
            
        }
        
        private function get_html_checkbox($setting){
            echo '<div id="titlewrap" style="margin-top:20px;">';
            echo '<label id="'.$setting['name'].'-prompt-text" class="'.$setting['label-class'].'" style="margin-right:50px;font-size:16px;">' .$setting['label'].'</label>';
            echo '<input type="checkbox" name="'.$setting['name'].'" size="30" '.($setting['value'] == 'on' ? 'checked="checked"' : "" ).'  id="'.$setting['name'].'" spellcheck="true" autocomplete="off" style="padding: 3px 8px;font-size: 1.7em;line-height: 100%;height: 1.7em;width: 100%;outline: 0px none;margin: 0px 0px 3px;background-color: rgb(255, 255, 255);"/>';
            if(isset($setting['information']) && !empty($setting['information'])){
                echo $setting['information'];
            }
            echo '</div>';
            
        }        
        protected function get_submit_button(){
            echo '<div style="float: left;margin-top: 20px;margin-bottom: 20px;">';
                echo get_submit_button(__( 'Save', 'simply-share-links-using-bubbles' ));
            echo '</div>';
        }


        protected function getFormItem($setting){
            switch ($setting['type']) {
                case 'text':
                    $this->get_html_text_input($setting);
                    break;
                case 'text-url':
                    $this->get_html_text_url($setting);
                    break;                
                case 'file':
                    $this->get_add_media($setting);
                    break;
                case 'checkbox':
                    $this->get_html_checkbox($setting);
                    break;     
                case 'color':
                    $this->get_html_color_input($setting);
                    break;                 
                default:
                    break;
            }
        }
        
}

endif;
