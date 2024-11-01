<?php

/**
 *
 * @author      David Alcaraz Moreno
 * @category    Admin
 * @package     simply-share-links-using-bubbles/includes
 * @version     1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class Db_File {

    public static function create($str,$ext){
        $filename = 'db'.uniqid().'.'.$ext;
        $fh = fopen(DAMSES_PLUGIN_DIR_JS .$filename , "w");
        if($fh==false)
            die("unable to create file");
        fputs ($fh, $str);
        fclose ($fh);   
        return $filename;
    }
    
    public static function delete($path){
        unlink($path);
    }
}
