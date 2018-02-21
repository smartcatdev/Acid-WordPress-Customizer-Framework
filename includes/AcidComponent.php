<?php

if ( !interface_exists( 'AcidComponent' ) ) {

    interface AcidComponent {

        /**
         * 
         * @param String $parent
         * @param String $id
         * @param Array $args
         * 
         * @since 0.0.1
         */
        public function __construct( $parent, $id, $args );
        
        public function __get( $arg );
        
        public function render();
        
        
    }


}