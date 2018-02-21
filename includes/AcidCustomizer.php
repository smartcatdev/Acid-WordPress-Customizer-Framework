<?php

if ( ! class_exists( 'AcidCustomizer' ) ) {

    class AcidCustomizer {

        private $theme;
        private $slug;
        private $theme_url;
        private $theme_path;
        private $panels = array ();
        private $sections = array ();
        private $mods = array ();
        private $options = array ();


        public function __construct( $theme, $slug ) {

            $this->theme = $theme;
            $this->slug = $slug;

            add_action( 'customize_register', array ( $this, 'add_options' ) );
        }

        public function config( $options ) {
            $this->options = $options;
        }

        public function add_options( ) {

            if ( empty( $this->options ) ) {
                return;
            }
            

            foreach ( $this->options['panels'] as $id => $panel ) {

                $this->create_panel( $id, $panel );

                
            }
            
        }
        
        private function create_panel( $id, $panel ) {
            
            $panel = new AcidPanel( null, $id, $panel );         
            
        }
       
        public static function is_panel( $node ) {

            return $node == 'panels' ? true : false;
        }

        public static function is_section( $node ) {

            return $node == 'sections' ? true : false;
        }

    }

}