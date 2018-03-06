<?php

add_action( 'customize_register', function() {

    class AcidColorPicker extends WP_Customize_Control {

        public $type = 'color-picker';

        public function render_content() {
            
            var_dump( $this->choices );
            
            ?>

            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            </label>
            
            <div>

                <div class="colorpicker-field">
                    
                    <?php if ( !empty( $this->description ) ) : ?>
                        <div class="description customize-control-description"><?php echo $this->description; ?></div>
                    <?php endif; ?>

                    <?php
                    $ctr = 0;
                    foreach( $this->choices as $key => $val ) : $ctr++; ?>
                        
                        <input name="<?php echo esc_attr( $this->id ); ?>" <?php $this->link() ?> type="radio" id="switch_<?php echo esc_attr( $key) ?>" value="<?php echo esc_attr( $key ); ?>" <?php checked( $this->value(), $key ); ?>/>
                        <label for="switch_<?php echo esc_attr( $key) ?>" style="background-color: <?php echo esc_attr( $key ) ?>"><?php echo esc_attr( $val ); ?></label>
                        
                    <?php endforeach; ?>
                      
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

                .colorpicker-field {
                    overflow: hidden;
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
                    opacity: 0.5;
                    display: inline-block;
                    width: 90%;
                    background-color: #e4e4e4;
                    color: rgba(0, 0, 0, 0.6);
                    font-size: 14px;
                    font-weight: normal;
                    text-align: center;
                    text-shadow: none;
                    padding: 6px 14px;
                    -webkit-box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
                    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
                    -webkit-transition: all 0.1s ease-in-out;
                    -moz-transition:    all 0.1s ease-in-out;
                    -ms-transition:     all 0.1s ease-in-out;
                    -o-transition:      all 0.1s ease-in-out;
                    transition:         all 0.1s ease-in-out;
                    border: 2px solid transparent;
                }

                .colorpicker-field label:hover {
                        cursor: pointer;
                }

                .colorpicker-field input:checked + label {
                  opacity: 1;
                  border: 2px solid #2196F3;
                  -webkit-box-shadow: none;
                  box-shadow: none;
                }

                .colorpicker-field label:first-of-type {
                  border-radius: 4px 0 0 4px;
                }

                .colorpicker-field label:last-of-type {
                  border-radius: 0 4px 4px 0;
                }
            </style>

        <?php
        }

    }

} );