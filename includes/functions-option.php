<?php


if( ! function_exists( 'acid_get_decimal' ) ) {
    
    function acid_get_decimal( $id, $default ) {
        
        $val = absint( get_theme_mod( $id, $default ) );
        
        return floatval( $val/100 );
        
    }
    
}