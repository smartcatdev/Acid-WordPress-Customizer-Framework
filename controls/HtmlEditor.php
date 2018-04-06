<?php
add_action( 'customize_register', function() {

    class AcidHtmlEditor extends WP_Customize_Control {

        public $type = 'html-editor';

        public function render_content() {
            ?>

            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <?php
                  $settings = array(
                    'media_buttons' => false,
                    'quicktags' => false
                    );
                  $this->filter_editor_setting_link();
                  wp_editor( $this->value(), $this->id, $settings );
                ?>
            </label>
                    
            <?php
            
            do_action('admin_footer');
            do_action('admin_print_footer_scripts');
            
            }

            public function enqueue() {
                
                wp_enqueue_script( 'html_editor_control_js', AcidConfig::assets_url() . 'js/html-editor.js', array ( 'jquery', 'jquery-ui-core' ), rand(), true );
                add_action( 'customize_controls_print_styles', array ( $this, 'print_styles' ) );
                
            }

            private function filter_editor_setting_link() {
                add_filter( 'the_editor', function( $output ) { return preg_replace( '/<textarea/', '<textarea ' . $this->get_link(), $output, 1 ); } );
            }
            
            public function print_styles() { ?>

            <style type="text/css" id="acid-toggle-css">

            </style>

        <?php
        }

    }

} );