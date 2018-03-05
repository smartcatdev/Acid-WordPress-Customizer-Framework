<?php


add_action( 'customize_register', function() {

    class AcidRange extends WP_Customize_Control {

        public $type = 'range-value';


        /**
         * Render the control's content.
         *
         * @author soderlind
         * @version 1.2.0
         */
        public function render_content() {
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <div class="range-slider"  style="width:100%; display:flex;flex-direction: row;justify-content: flex-start;">
                    <span  style="width:100%; flex: 1 0 0; vertical-align: middle;"><input class="range-slider__range" type="range" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->input_attrs();
            $this->link(); ?>>
                        <span class="range-slider__value">0</span></span>
                </div>
                <?php if ( !empty( $this->description ) ) : ?>
                    <span class="description customize-control-description"><?php echo $this->description; ?></span>
                <?php endif; ?>
            </label>
            <?php
        }
        
        /**
         * Enqueue scripts/styles.
         *
         * @since 3.4.0
         */
        public function enqueue() {
            
            wp_enqueue_script( 'customizer-range-value-control', AcidConfig::assets_url() . 'js/range.js', array ( 'jquery' ), rand(), true );
            add_action( 'customize_controls_print_styles', array ( $this, 'print_styles' ) );
            
        }
        
        
        public function print_styles() { ?>
            
            <style type="text/css" id="acid-range-css">
                
            .range-slider {
                width: 100%;
            }

            .range-slider__range {
                -webkit-appearance: none;
                width: calc(100% - (95px));
                height: 10px;
                border-radius: 5px;
                background: #d7dcdf;
                outline: none;
                padding: 0;
                margin: 0;
            }

            .range-slider__range::-webkit-slider-thumb {
                -webkit-appearance: none;
                appearance: none;
                width: 20px;
                height: 20px;
                border-radius: 50%;
                background: #0085ba;
                cursor: pointer;
                -webkit-transition: background .15s ease-in-out;
                transition: background .15s ease-in-out;
            }

            .range-slider__range::-webkit-slider-thumb:hover {
                background: #0085ba;
            }

            .range-slider__range:active::-webkit-slider-thumb {
                background: #0085ba;
            }

            .range-slider__range::-moz-range-thumb {
                width: 20px;
                height: 20px;
                border: 0;
                border-radius: 50%;
                background: #0085ba;
                cursor: pointer;
                -webkit-transition: background .15s ease-in-out;
                transition: background .15s ease-in-out;
            }

            .range-slider__range::-moz-range-thumb:hover {
                background: #0085ba;
            }

            .range-slider__range:active::-moz-range-thumb {
                background: #0085ba;
            }

            .range-slider__value {
                display: inline-block;
                position: relative;
                width: 60px;
                color: #fff;
                line-height: 20px;
                text-align: center;
                border-radius: 3px;
                background: #0085ba;
                padding: 5px 10px;
                margin-left: 8px;
            }

            /*.range-slider__value:after {
                position: absolute;
                top: 8px;
                left: -7px;
                width: 0;
                height: 0;
                border-top: 7px solid transparent;
                border-right: 7px solid #0085ba;
                border-bottom: 7px solid transparent;
                content: '';
            }*/

            ::-moz-range-track {
                background: #d7dcdf;
                border: 0;
            }

            input::-moz-focus-inner, input::-moz-focus-outer {
                border: 0;
            }
            
            </style>
            
        <?php }

    }

} );
