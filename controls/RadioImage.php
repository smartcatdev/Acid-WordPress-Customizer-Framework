<?php
/**
 * The radio image customize control extends the WP_Customize_Control class.  This class allows 
 * developers to create a list of image radio inputs.
 *
 * Note, the `$choices` array is slightly different than normal and should be in the form of 
 * `array(
 * 	$value => array( 'url' => $image_url, 'label' => $text_label ),
 * 	$value => array( 'url' => $image_url, 'label' => $text_label ),
 * )`
 *
 * @author     Justin Tadlock <justin@justintadlock.com>
 * @copyright  Copyright (c) 2008 - 2015, Justin Tadlock
 * @link       http://themehybrid.com/hybrid-core
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

add_action( 'customize_register', 'acid_register_radio_image' );

function acid_register_radio_image() {

    /**
     * Radio image customize control.
     *
     * @since  3.0.0
     * @access public
     */
    class AcidRadioImage extends WP_Customize_Control {

        /**
         * The type of customize control being rendered.
         *
         * @since 3.0.0
         * @var   string
         */
        public $type = 'radio-image';

        /**
         * Displays the control content.
         *
         * @since  3.0.0
         * @access public
         * @return void
         */
        public function render_content() {

            /* If no choices are provided, bail. */
            if ( empty( $this->choices ) )
                return;
            ?>

            <?php if ( !empty( $this->label ) ) : ?>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <?php endif; ?>

            <?php if ( !empty( $this->description ) ) : ?>
                <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
            <?php endif; ?>

            <div id="<?php echo esc_attr( "input_{$this->id}" ); ?>">

                <?php foreach ( $this->choices as $value => $args ) : ?>

                    <input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( "_customize-radio-{$this->id}" ); ?>" id="<?php echo esc_attr( "{$this->id}-{$value}" ); ?>" <?php $this->link(); ?> <?php checked( $this->value(), $value ); ?> /> 

                    <label for="<?php echo esc_attr( "{$this->id}-{$value}" ); ?>">
                        <span class="screen-reader-text"><?php echo esc_html( $args[ 'label' ] ); ?></span>
                        <img src="<?php echo esc_url( sprintf( $args[ 'url' ], get_template_directory_uri(), get_stylesheet_directory_uri() ) ); ?>" alt="<?php echo esc_attr( $args[ 'label' ] ); ?>" />
                    </label>

                <?php endforeach; ?>

            </div><!-- .image -->

            <script type="text/javascript">
                jQuery(document).ready(function () {
                    jQuery('#<?php echo esc_attr( "input_{$this->id}" ); ?>').buttonset();
                });
            </script>
            <?php
        }

        /**
         * Loads the jQuery UI Button script and hooks our custom styles in.
         *
         * @since  3.0.0
         * @access public
         * @return void
         */
        public function enqueue() {
            
            wp_enqueue_script( 'jquery-ui-button' );

            add_action( 'customize_controls_print_styles', array ( $this, 'print_styles' ) );
        }

        /**
         * Outputs custom styles to give the selected image a visible border.
         *
         * @since  3.0.0
         * @access public
         * @return void
         */
        public function print_styles() {
            ?>

            <style type="text/css" id="hybrid-customize-radio-image-css">
            .customize-control-radio-image .image.ui-buttonset input[type=radio] {
                    height: auto; 
            }
            .customize-control-radio-image .image.ui-buttonset label {
                    display: inline-block;
                    margin-right: 5px;
                    margin-bottom: 5px; 
            }
            .customize-control-radio-image .image.ui-buttonset label.ui-state-active {
                    background: none;
            }
            .customize-control-radio-image .customize-control-radio-buttonset label {
                    padding: 5px 10px;
                    background: #f7f7f7;
                    border-left: 1px solid #dedede;
                    line-height: 35px; 
            }
            .customize-control-radio-image label img {
                    border: 1px solid #bbb;
                    opacity: 0.5;
            }
            #customize-controls .customize-control-radio-image label img {
                    max-width: 30%;
                    height: auto;
            }
            .customize-control-radio-image label.ui-state-active img {
                    background: #dedede; 
                    border-color: #000; 
                    opacity: 1;
            }
            .customize-control-radio-image label.ui-state-hover img {
                    opacity: 0.9;
                    border-color: #999; 
            }
            .customize-control-radio-buttonset label.ui-corner-left {
                    border-radius: 3px 0 0 3px;
                    border-left: 0; 
            }
            .customize-control-radio-buttonset label.ui-corner-right {
                    border-radius: 0 3px 3px 0; 
            }

            </style>
            <?php
        }

    }
    
}