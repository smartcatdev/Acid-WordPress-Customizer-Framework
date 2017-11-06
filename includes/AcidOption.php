<?php

if( !class_exists( 'AcidOption' ) ) {
    
    class AcidOption {
        
        private $types = array(
            'text',
            'checkbox',
            'radio',
            'select',
            'textarea',
            'dropdown-pages',
            'email',
            'url',
            'number',
            'hidden',
            'date',
            
        );
        
        const TRANSPORT = 'refresh';
        
        private $section;
        
        private $id;
        
        private $option;
        
        private $sanitize_callback;
        
        private $transport;
        
        private $acid_type;
        
        private $setting_args = array();
        
        private $control_args = array();
        
        /**
         * 
         * @param type $name
         * @return String
         */
        public function __get( $name ) {
            return $this->option[ $name ];
        }
        
        public function __construct( $section, $id, $option ) {
            
            $this->section = $section;
            $this->id = $id;
            $this->option = $option;


            $this->set_type();
            $this->set_args();
            $this->set_sanitization();
            $this->create_option();
            
            
        }
        
        private function set_type() {
            
            if( ! in_array( $this->type, $this->types ) ) {
                
                _doing_it_wrong( 'AcidOption->set_type', __( 'You used a non valid option type', 'acid' ), '0.0.1' );
                
            }
            
        }
        

        
        private function has_default() {
            return $this->default ? true : false;
        }
        
        private function has_transport() {
            
        }
        
        private function has_sanitize_callback() {
            
        }
        
        private function has_section() {
            
            if( ! $this->section ) {
                _doing_it_wrong( 'AcidOption->has_section', __( 'You created an option without specifying the section' . $this->id, 'acid' ), '0.0.1' );
            }
            
        }
        
        private function set_sanitization() {
            
        }
        
        private function create_option() {
            
            global $wp_customize;
            
            $setting_args = array(
                
                'default'               => $this->default ?: '',
                'transport'             => $this->transport ?: self::TRANSPORT,
                'sanitize_callback'     => 'sanitize_text_field',
                
            );
            
            $control_args = array(
                
                'type'                  => $this->type,
                'section'               => $this->section,
                'label'                 => $this->label,
                
            );
            
            
            
            $wp_customize->add_setting( $this->id, $this->setting_args );
            $wp_customize->add_control( $this->id, $this->control_args );
            
            
        }
        
        private function set_args() {
            
            if( $this->has_sanitize_callback() ) {
                $this->settings_args[ 'sanitize_callback' ] = $this->sanitize_callback;
            }else {
                $this->set_sanitization();
            }
            
            if( $this->has_default() ) {
                $this->setting_args[ 'default' ] = $this->default;
            }
            
            if( $this->has_transport() ) {
                $this->setting_args[ 'transport' ] = $this->default;
            }else {
                $this->setting_args[ 'transport' ] = self::TRANSPORT;
            }
            
        }
        
    
    }
    
    
}