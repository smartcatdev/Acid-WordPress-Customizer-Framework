<?php

if ( !interface_exists( 'AcidComponent' ) ) {

    interface AcidComponent {


        public function __construct( $parent, $id, $args );
        
        public function __get( $arg );
        
        public function render();
        
        
    }


}