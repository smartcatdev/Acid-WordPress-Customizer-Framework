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
            
            foreach ( $this->options as $type => $node ) {

                if ( self::is_panel( $type ) ) {
                    
                    $this->create_panel( $node );
                    
                } elseif ( self::is_section( $type ) ) {
                    
                }
                
            }
            
        }
        
        private function create_panel( $panel ) {
            
            global $wp_customize;
            
            $id = key( $panel );
            
            
            $wp_customize->add_panel( $id, array(
                
                'title'             => $panel[ $id ]['title'],
                'description'       => $panel[ $id ]['description'],
                
            ) );
            
            if( ! isset( $panel[ $id ][ 'sections' ] ) ) {
                return;
            }
            
            foreach( $panel[ $id ]['sections'] as $section_id => $section ) {
                $this->create_section( $id, $section_id, $section );
            }
            
            
        }
        
        private function create_section( $panel_id, $id, $section ) {
            
            global $wp_customize;
            
            
            $wp_customize->add_section( $id, array(
                'title'                 => $section[ 'title' ],
                'description'           => $section[ 'description' ],
                'panel'                 => $panel_id
            ) );
            
            foreach( $section['options'] as $option_id => $option ) {
                
                $this->create_option( $id, $option_id, $option );
               
            }
            
        }
        
        private function create_option( $id, $option_id, $option ) {
            
            $option = new AcidOption( $id, $option_id, $option );
            
        }

        
        public static function is_panel( $node ) {

            return $node == 'panels' ? true : false;
        }

        public static function is_section( $node ) {

            return $node == 'sections' ? true : false;
        }

    }

}