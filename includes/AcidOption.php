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
            'image',
        );
        
        const TRANSPORT = 'refresh';
        
        private $section;
        
        private $id;
        
        private $option;
        
        private $setting_args = array();
        
        private $control_args = array();
        
        
        public function __get( $name ) {
            return isset( $this->option[ $name ] ) ? $this->option[ $name ] : false;
        }
        
        public function __construct( $section, $id, $option ) {
            
            $this->section = $section;
            $this->id = $id;
            $this->option = $option;

            $this->set_args();
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
            return $this->transport ? true : false;
        }
        
        private function has_sanitize_callback() {
            return $this->sanitize_callback ? true : false;
        }
        
        private function has_label() {
            return $this->label ? true : false;
        }
        
        private function has_type() {
            return $this->type ? true : false;
        }
        
        private function has_choices() {
            
            return $this->choices ? true : false;
            
        }
        
        private function create_option() {
            
            global $wp_customize;
            
            $wp_customize->add_setting( $this->id, $this->setting_args );
            $wp_customize->add_control( $this->id, $this->control_args );
            
        }
        
        private function set_args() {
            
            
            if( $this->has_sanitize_callback() ) {
                $this->setting_args[ 'sanitize_callback' ] = $this->sanitize_callback;
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
            
            if( $this->has_label() ) {
                $this->control_args[ 'label' ] = $this->label;
            }
            
            if( $this->has_choices() ) {
                $this->control_args[ 'choices' ] = $this->choices;
            }
            
            if( $this->has_type() ) {
                $this->control_args[ 'type' ] = $this->type;
            }
            
            $this->control_args[ 'section' ] = $this->section;
            
        }
        
        private function set_sanitization() {
            
            $callback = null;

            switch( $this->type ) {
                
                case 'text' :
                    $callback = 'sanitize_text_field';
                    break;
                case 'url' :
                    $callback = 'esc_url_raw';
                    break;
                case 'number' :
                    $callback = 'intval';
                    break;
                case 'textarea' :
                    $callback = 'sanitize_textarea';
                    break;
                case 'date' :
                    $callback = 'sanitize_text_field';
                    break;
                case 'checkbox' :
                    $callback = 'sanitize_text_field';
                    break;
                case 'radio' :
                    $callback = 'sanitize_text_field';
                    break;
                case 'select' :
                    $callback = 'sanitize_text_field';
                    break;
                case 'dropdown-pages' :
                    $callback = 'sanitize_text_field';
                    break;
                case 'email' : 
                    $callback = 'sanitize_text_field';
                    break;
                case 'image' : 
                    $callback = 'sanitize_text_field';
                    break;
                
                
                default :
                    $callback = 'sanitize_text_field';
                    break;
                
                
                
            }
            
            $this->setting_args[ 'sanitize_callback' ] = $callback;
            
        }
        
    
    }
    
    
}