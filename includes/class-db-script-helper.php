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
class Db_Script_Helper {

    public static function bubble_link_script($url,$isNewWindow,$onlySeconds,$number,$delay){
        
        $script = '(function($) {
                $(".bubble-link").click(function(){
                    '.($isNewWindow ? 'window.open("'.$url.'", "_blank");' : 'window.location.href = "'.$url.'";').'                        
                });
            }(jQuery));   
            '.($onlySeconds ? 'currentTime.setSeconds(currentTime.getSeconds() + '.$number.');nobound = false;' : '').'
            '.( intval($delay) > 0 ? 'setTimeout(adjustBubbleText, '.  intval($delay)*1000 .');' : 'setTimeout(adjustBubbleText, 1);') ;
        
        return $script;
      
    }
    
    public static function bubble_style($c1,$c2,$c3){
        $style = '.ball {display: inline-block;  width: 100%;  height: 100%;  margin: 0;  border-radius: 50%;  position: relative;  background: -webkit-gradient(radial, 50% 55%, 0, 50% 55%, 100, color-stop(0%, c_s_1), color-stop(40%, c_s_1), color-stop(60%, c_s_2), color-stop(100%, c_e_2));  background: -webkit-radial-gradient(50% 55%, circle cover, c_s_1, c_s_1 40%, c_s_2 60%, c_e_2);  background: -moz-radial-gradient(50% 55%, circle cover, c_s_1, c_s_1 40%, c_s_2 60%, c_e_2);  background: -o-radial-gradient(50% 55%, circle cover, c_s_1, c_s_1 40%, c_s_2 60%, c_e_2);  background: radial-gradient(50% 55%, circle cover, c_s_1, c_s_1 40%, c_s_2 60%, c_e_2);  -webkit-animation: bubble-anim 2s ease-out infinite;  -moz-animation: bubble-anim 2s ease-out infinite;  -o-animation: bubble-anim 2s ease-out infinite;  -ms-animation: bubble-anim 2s ease-out infinite;  animation: bubble-anim 2s ease-out infinite;}';
        $style = str_replace('c_s_1', self::getRGBA($c1, '0.9'), $style);
        $style = str_replace('c_s_2', self::getRGBA($c2, '0.8'), $style);
        $style = str_replace('c_e_2', self::getRGBA($c3, '0.4'), $style);
        return $style;
    }
    public static function bubble_style1($url){
        $style = '.ball {display: inline-block;  width: 100%;  height: 100%;  margin: 0;  border-radius: 50%;  position: relative;  background-image: url('.$url.');}';
        return $style;
    }    
    public static function getRGBA($c,$a){
        $hex = str_replace("#", "", $c);

        if(strlen($hex) == 3) {
           $r = hexdec(substr($hex,0,1).substr($hex,0,1));
           $g = hexdec(substr($hex,1,1).substr($hex,1,1));
           $b = hexdec(substr($hex,2,1).substr($hex,2,1));
        } else {
           $r = hexdec(substr($hex,0,2));
           $g = hexdec(substr($hex,2,2));
           $b = hexdec(substr($hex,4,2));
        }
        $rgba = 'rgba('.$r.','.$g.','. $b.','.$a.')';

        return $rgba;
    }
    public static function generateCss1() {
        $str = self::bubble_style(get_option('simply-share-links-using-bubbles_bubble_cs_1'),
                get_option('simply-share-links-using-bubbles_bubble_cs_2'),get_option('simply-share-links-using-bubbles_bubble_ce_2'));
        $js = Db_File::create($str, 'css');
        $old = get_option('simply-share-links-using-bubbles_bubble_style');
        Db_File::delete(DAMSES_PLUGIN_DIR_JS.$old);
        update_option('simply-share-links-using-bubbles_bubble_style', $js);        
    }    
    
    public static function generateCss2() {
        $str = self::bubble_style1(get_option('simply-share-links-using-bubbles_bubble_image'));
        $js = Db_File::create($str, 'css');
        $old = get_option('simply-share-links-using-bubbles_bubble_style');
        Db_File::delete(DAMSES_PLUGIN_DIR_JS.$old);
        update_option('simply-share-links-using-bubbles_bubble_style', $js);        
    }        
    
    public static function generateScript() {        
        
        $type = get_option('simply-share-links-using-bubbles_bubble_type') == 'on' ? TRUE : FALSE;
        if(!$type){
            self::generateCss1();
        }else{
            self::generateCss2();
        }
        $str = self::bubble_link_script(get_option('simply-share-links-using-bubbles_bubble_url'),  
                get_option('simply-share-links-using-bubbles_bubble_allow_open_in_new_tab') == 'on' ? true : false, get_option('simply-share-links-using-bubbles_bubble_show_only_seconds')  == 'on' ? true : false,
                get_option('simply-share-links-using-bubbles_bubble_number_of_seconds'),
                get_option('simply-share-links-using-bubbles_bubble_delay_seconds'));
        $js = Db_File::create($str, 'js');
        $old = get_option('simply-share-links-using-bubbles_bubble_js');
        Db_File::delete(DAMSES_PLUGIN_DIR_JS.$old);
        update_option('simply-share-links-using-bubbles_bubble_js', $js);
        self::generateCss3();
    }    
    
    public static function generateCss3(){
        $str = self::bubble_style(get_option('simply-share-links-using-bubbles_bubble_cs_1'),
                get_option('simply-share-links-using-bubbles_bubble_cs_2'),get_option('simply-share-links-using-bubbles_bubble_ce_2'));
        $str = str_replace('.ball', '.ball1', $str);
        $str .=' '. self::bubble_style1(get_option('simply-share-links-using-bubbles_bubble_image'));        
        $js = Db_File::create($str, 'css');
        $old = get_option('simply-share-links-using-bubbles_bubble_style_backend');
        if($old){
            Db_File::delete(DAMSES_PLUGIN_DIR_JS.$old);
        }
        update_option('simply-share-links-using-bubbles_bubble_style_backend', $js);           
    }
  
}
