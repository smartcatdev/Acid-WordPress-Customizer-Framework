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

