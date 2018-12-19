<?php

add_action( 'customize_register', 'acid_register_color_select' );

function acid_register_color_select() {

    class AcidColorSelect extends WP_Customize_Control {

        public $type = 'color-select';

        public function render_content() { ?>

            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            </label>
            
            <div>

                <div class="colorpicker-field">
                    
                    <?php if ( !empty( $this->description ) ) : ?>
                        <div class="description customize-control-description"><?php echo esc_html( $this->description ); ?></div>
                    <?php endif; ?>

                    <?php
                    $ctr = 0;
                    foreach( $this->choices as $key => $val ) : $ctr++; ?>
                        
                        <div class="choice-wrap">
                            <input name="<?php echo esc_attr( $this->id ); ?>" <?php $this->link() ?> type="radio" id="switch_<?php echo esc_attr( $key . '_' . $this->id ) ?>" value="<?php echo esc_attr( $key ); ?>" <?php checked( $this->value(), $key ); ?>/>
                            <label for="switch_<?php echo esc_attr( $key . '_' . $this->id ); ?>" style="background-color: <?php echo esc_attr( $key ); ?>;">
                                <span class="color-name"><?php echo esc_attr( $val ); ?></span>
                                <span class="selected dashicons dashicons-yes" style="color: <?php echo esc_attr( $key ); ?>;"></span>
                            </label>
                        </div>
                        
                        <?php if ( $ctr < count( $this->choices ) ) : ?>
                            <div class="clear"></div>
                        <?php endif; ?>
                        
                    <?php endforeach; ?>
                      
                </div>
                
            </div>
                    
                <?php
            }

            public function enqueue() {
                
                add_action( 'customize_controls_print_styles', array ( $this, 'print_styles' ) );
                
            }

            public function print_styles() {
                ?>

            <style type="text/css" id="acid-toggle-css">

                .colorpicker-field {
                    padding: 0px 1px;
                }

                .switch-title {
                    margin-bottom: 6px;
                }

                .colorpicker-field input {
                    position: absolute !important;
                    clip: rect(0, 0, 0, 0);
                    height: 1px;
                    width: 1px;
                    border: 0;
                    overflow: hidden;
                }

                .colorpicker-field label {
                  float: left;
                }

                .colorpicker-field label {
                    display: block;
                    width: 100%;
                    color: rgba(0, 0, 0, 0.5);
                    font-size: 14px;
                    font-weight: normal;
                    text-align: center;
                    text-shadow: none;
                    padding: 0;
                    height: 24px;
                    border: none;
                    -webkit-box-shadow: none;
                    box-shadow: none;
                    -webkit-transition: all 0.3s ease-in-out;
                    -moz-transition: all 0.3s ease-in-out;
                    -ms-transition: all 0.3s ease-in-out;
                    -o-transition: all 0.3s ease-in-out;
                    transition: all 0.3s ease-in-out;
                    position: relative;
                    border-radius: 4px !important;
                }

                .colorpicker-field label:hover {
                        cursor: pointer;
                }

                .colorpicker-field input:checked + label {
                    background-color: #fdfdfd;
                    color: #666;
                    opacity: 1;
                    height: 35px !important;
                }
                
                .colorpicker-field label:first-of-type {
                    border-radius: 4px 0 0 4px;
                }

                .colorpicker-field label:last-of-type {
                    border-radius: 0 4px 4px 0;
                }
               
                .colorpicker-field input:checked + label {
                    background-color: #fafafa;
                }
                
                .colorpicker-field label .color-name {
                    position: absolute;
                    color: #a8a8a8;
                    left: 0;
                    top: 0;
                    height: 24px;
                    line-height: 24px;
                    background: #ffffff;
                    padding: 0 10px;
                    font-size: 12px;
                    font-weight: 500;
                    -webkit-transition: all 0.3s ease-in-out;
                    -moz-transition: all 0.3s ease-in-out;
                    -o-transition: all 0.3s ease-in-out;
                    transition: all 0.3s ease-in-out;
                    border-radius: 4px 0 0 4px;
                }
                
                .colorpicker-field input:checked + label .color-name {
                    padding-left: 20px;
                    padding-right: 20px;
                    color: #3c3c3c;
                    font-size: 14px;
                    height: 35px;
                    line-height: 35px;
                }
                
                .colorpicker-field .choice-wrap {
                    margin-bottom: 5px;
                    height: auto;
                    overflow: hidden;
                }
                
                .colorpicker-field input + label .selected {
                    position: absolute;
                    right: -20px;
                    opacity: 0;
                    top: 7px;
                    line-height: 20px;
                    height: 20px;
                    width: 20px;
                    background-color: lawngreen;
                    border-radius: 50%;
                    -webkit-transition: all 0.3s ease-in-out;
                    -moz-transition: all 0.3s ease-in-out;
                    -o-transition: all 0.3s ease-in-out;
                    transition: all 0.3s ease-in-out;
                }
                
                .colorpicker-field input:checked + label .selected {
                    right: 5px;
                    opacity: 1;
                }
                
                .colorpicker-field input + label .selected:before {
                    position: absolute;
                    left: -6%;
                    top: 4%;
                }
                
            </style>

        <?php
        }

    }
    
}
