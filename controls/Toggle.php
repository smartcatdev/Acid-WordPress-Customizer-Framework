<?php

add_action( 'customize_register', 'acid_register_toggle' );

function acid_register_toggle() {

    class AcidToggle extends WP_Customize_Control {

        public $type = 'toggle';

        public function render_content() {
            ?>

            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            </label>
            
            <div class="toggle-flex">

                <div class="flex-inner-small">

                    <label class="switch">

                        <input id="cb<?php echo esc_attr( $this->instance_number ); ?>" type="checkbox" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); checked( $this->value() ); ?> />
                        <span class="slider round"></span>

                        <label for="<?php echo esc_attr( $this->instance_number ); ?>" class="tgl-btn"></label>

                    </label>

                </div>

                <div class="flex-inner-wide">
                
                    <?php if ( !empty( $this->description ) ) : ?>
                        <div class="description customize-control-description"><?php echo esc_html( $this->description ); ?></div>
                    <?php endif; ?>

                </div>
                
            </div>
                    
                <?php
            }

            /**
             * Enqueue scripts/styles.
             *
             * @since 3.4.0
             */
            public function enqueue() {
                
                add_action( 'customize_controls_print_styles', array ( $this, 'print_styles' ) );
                
            }

            public function print_styles() {
                ?>

            <style type="text/css" id="acid-toggle-css">

                .switch {
                    position: relative;
                    display: inline-block;
                    width: 40px;
                    height: 20px;
                    margin-bottom: 5px;
                }

                .switch input {display:none;}

                .slider {
                    position: absolute;
                    cursor: pointer;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background-color: #ccc;
                    -webkit-transition: .4s;
                    transition: .4s;
                }

                .slider:before {
                    position: absolute;
                    content: "";
                    height: 16px;
                    width: 16px;
                    left: 2px;
                    bottom: 2px;
                    background-color: white;
                    -webkit-transition: .4s;
                    transition: .4s;
                }

                input:checked + .slider {
                    background-color: #2196F3;
                }

                input:focus + .slider {
                    box-shadow: 0 0 1px #2196F3;
                }

                input:checked + .slider:before {
                    -webkit-transform: translateX(20px);
                    -ms-transform: translateX(20px);
                    transform: translateX(20px);
                }

                /* Rounded sliders */
                .slider.round {
                    border-radius: 34px;
                }

                .slider.round:before {
                    border-radius: 50%;
                }
                
                li.customize-control-toggle .toggle-flex {
                    display: -webkit-box; 
                    display: -moz-box;
                    display: -ms-flexbox;
                    display: -webkit-flex; 
                    display: flex;
                    align-items: center;
                }
                
                li.customize-control-toggle .toggle-flex .flex-inner-wide {
                    padding-left: 10px;
                }

            </style>

        <?php
        }

    }

}