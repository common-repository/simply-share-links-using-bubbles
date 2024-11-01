<?php

// If uninstall is not called from WordPress, exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit();
}
function db_delete_plugin(){
    delete_option( 'simply-share-links-using-bubbles_bubble_title'); 
    delete_option( 'simply-share-links-using-bubbles_bubble_short_description'); 
    delete_option( 'simply-share-links-using-bubbles_bubble_short_description2'); 
    delete_option( 'simply-share-links-using-bubbles_bubble_image' ); 
    delete_option( 'simply-share-links-using-bubbles_bubble_url'); 
    delete_option( 'simply-share-links-using-bubbles_damses_url' ); 
    delete_option( 'simply-share-links-using-bubbles_bubble_js'); 
    delete_option( 'simply-share-links-using-bubbles_bubble_installed'); 
    delete_option('simply-share-links-using-bubbles_bubble_style');    
}

db_delete_plugin();