<?php
/**
 * 
 * Includes various sanitization methods
 * 
 */


/**
 * 
 * Sanitize dates
 * @since 0.0.1
 * 
 * @param String
 * @return String
 */
function acid_sanitize_date( $input ) {
    $date = new DateTime( $input );
    return $date->format('m-d-Y');
}

/**
 * Sanitize checkbox
 * @since 0.0.1
 * 
 * @param int $input
 * @return boolean
 */
function acid_sanitize_checkbox( $input ) {
    return ( isset( $input ) ? true : false );
}

/**
 * 
 * Sanitize Radio input
 * 
 * @param String $input
 * @param type $setting
 * @return boolean
 */
function acid_sanitize_radio( $input, $setting ){

    
    $input = sanitize_key( $input );
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                

}

/**
 * 
 * @since 0.0.1
 * @param String $input
 * @param type $setting
 * @return boolean
 */
function acid_sanitize_select( $input, $setting ){

    
    $input = sanitize_key( $input );
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                

}


function acid_sanitize_colorselect( $input, $setting ) {
    
    $input = sanitize_key( $input );
    $input = '#' . $input;
    
    
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );  
    
}
