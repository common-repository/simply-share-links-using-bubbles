<?php

/**
 * @author      David Alcaraz Moreno
 * @category    Admin/Front
 * @package     simply-share-links-using-bubbles/Admin/Front
 * @version     1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Db_Option' ) ) :
class Db_Option {

    protected $key;
    protected $value;
    
    public function __construct($value,$key = NULL){
        if($key == NULL){
            $key = self::genkey();
        }
        $this->key = $key;
        $this->value = $value;
        
    }
    
    public static function genkey(){
        return uniqid();
    }
    
    public function check($path){
        return $this->value == $path;
    }
    
    public function getKey(){
        return $this->key;
    }
    
    public function getValue(){
        return $this->value;
    }
}
endif;