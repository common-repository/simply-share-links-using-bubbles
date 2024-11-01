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
class Options_Url extends Db_Options_Factory{
    
    protected $settings;
    public function __construct() {
        parent::__construct();
        $this->settings = array();
    }

    public function check() {
        
    }

    public function getSettings() {
        foreach ($this->items as $setting) {
            $this->settings[] =  array(
                'class' => 'urls-input',
                'type' => 'text-url',
                'label-class' => 'screen-reader-text',
                'label' => '',
                'name' => $setting->getKey(),
                'value' => $setting->getValue()
            );
        }
        return $this->settings;
    }
    public function update($items){
        $this->items = array();
        foreach ($items as $key => $value) {
            if(!filter_var($value, FILTER_VALIDATE_URL) === false){
                $this->items[] = new Db_Option(sanitize_text_field($value));
            }
        }
        $this->save();
    }

}
