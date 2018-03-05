<?php

if ( ! class_exists( 'AcidPanel' ) ) {

    class AcidPanel implements AcidComponent{

        private $panel;
        private $id;

        public function __construct( $parent, $id, $panel ) {
            
            $this->panel = $panel;
            $this->id = $id;
            $this->render();
            
        }
        
        public function __get( $name ) {
            return isset( $this->panel[ $name ] ) ? $this->panel[ $name ] : false;
        }
        
        public function render() {
            
            global $wp_customize;
            
            if( ! empty( $this->id ) ) {

                $wp_customize->add_panel( $this->id, array(

                    'title'             => $this->title,
                    'description'       => $this->description,

                ) );
                
            }
            
            foreach( $this->sections as $section_id => $section ) {
                $this->create_section( $section_id, $section );
            }
            
        }
        
        private function create_section( $section_id, $section ) {
            
            $section = new AcidSection( $this->id, $section_id, $section );
            
        }
        
        
    }


}