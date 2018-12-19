<?php

add_action( 'customize_register', 'acid_register_radio_toggle' );

function acid_register_radio_toggle() {

    class AcidRadioToggle extends WP_Customize_Control {

        public $type = 'radio-toggle';

        public function render_content() {
            ?>

            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            </label>
            
            <div class="switch-field">

                <?php if ( !empty( $this->description ) ) : ?>
                <div class="switch-title description customize-control-description"><?php echo esc_html( $this->description ); ?></div>
                <?php endif; ?>
                    
                <?php
                $ctr = 0;
                foreach( $this->choices as $key => $val ) : $ctr++; ?>
                    <div class="choice-wrap">
                        <input name="<?php echo esc_attr( $this->id ); ?>" <?php $this->link() ?> type="radio" id="switch_<?php echo esc_attr( $key . '_' . $this->id ) ?>" value="<?php echo esc_attr( $key ); ?>" <?php checked( $this->value(), $key ); ?>/>
                        <label for="switch_<?php echo esc_attr( $key . '_' . $this->id ) ?>"><?php echo esc_attr( $val ); ?></label>
                    </div>
                    <?php if ( $ctr < count( $this->choices ) ) : ?>
                        <div class="clear"></div>
                    <?php endif; ?>
                <?php endforeach; ?>
                        
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

                .switch-field {
                    /* overflow: hidden;*/
                    padding: 0px 1px;
                }

                .switch-title {
                    margin-bottom: 6px;
                }

                .switch-field input {
                    position: absolute !important;
                    clip: rect(0, 0, 0, 0);
                    height: 1px;
                    width: 1px;
                    border: 0;
                    overflow: hidden;
                }

                .switch-field label {
                  float: left;
                }

                .switch-field label {
                    display: block;
                    width: 100%;
                    color: rgba(0, 0, 0, 0.5);
                    font-size: 14px;
                    font-weight: normal;
                    text-align: center;
                    text-shadow: none;
                    padding: 7.5px 0px;
                    border: 1px solid rgba(0, 0, 0, 0.25);
                    border-bottom: none;
                    -webkit-box-shadow: none;
                    box-shadow: none;
                    border-radius: 0 !important;
                    -webkit-transition: all 0.3s ease-in-out;
                    -moz-transition: all 0.3s ease-in-out;
                    -ms-transition: all 0.3s ease-in-out;
                    -o-transition: all 0.3s ease-in-out;
                    transition: all 0.3s ease-in-out;
                    position: relative;
                }

                .switch-field label:hover {
                        cursor: pointer;
                }

                .switch-field input:checked + label {
                    background-color: #fdfdfd;
                    border-left: 3px solid;
                    border-right: 3px solid;
                    width: calc(100% - 4px);
                    color: #2196F3;
                }
                
                .switch-field label:first-of-type {
                    border-radius: 4px 0 0 4px;
                }

                .switch-field label:last-of-type {
                    border-radius: 0 4px 4px 0;
                }
                
                li.customize-control-radio-toggle .switch-field .choice-wrap {
                    position: relative;
                    max-width: 100%;
                    margin-bottom: 5px;
                }
                
                li.customize-control-radio-toggle .switch-field .choice-wrap:first-of-type label {
                    border-radius: 4px 4px 0 0 !important;
                }
                
                li.customize-control-radio-toggle .switch-field .choice-wrap:last-of-type label {
                    border-bottom: thin solid #b9b9b9;
                    border-radius: 0 0 4px 4px !important;
                }

                .switch-field input + label:before, 
                .switch-field input + label:after { 
                    content: "";
                    position: absolute;
                    width: 100%;
                    height: 2px;
                    left: 0;
                    opacity: 0;
                    background-color: #2196F3;
                    visibility: hidden;
                    -webkit-transform: scaleX(1);
                    transform: scaleX(1);
                    -webkit-transition: all 0.3s ease-in-out;
                    -moz-transition:  all 0.3s ease-in-out;
                    -o-transition:  all 0.3s ease-in-out;
                    transition:  all 0.3s ease-in-out;
                }
                
                .switch-field input + label:before {
                    top: 0;
                }
                
                .switch-field input + label:after {
                    bottom: 0;
                }
                
                .switch-field input:checked + label:before, 
                .switch-field input:checked + label:after {
                    visibility: visible;
                    opacity: 1;
                    -webkit-transform: scaleX(1);
                            transform: scaleX(1);
                }
                
                .switch-field input:checked + label {
                    background-color: #fafafa;
                }
                
            </style>

        <?php
        }

    }

}