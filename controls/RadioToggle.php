<?php

add_action( 'customize_register', function() {

    class AcidRadioToggle extends WP_Customize_Control {

        public $type = 'radio-toggle';

        public function render_content() {
            ?>

            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            </label>
            
            <div>

                <div class="switch-field">
                    
                    <?php if ( !empty( $this->description ) ) : ?>
                        <div class="switch-title description customize-control-description"><?php echo $this->description; ?></div>
                    <?php endif; ?>

                    <?php
                    $ctr = 0;
                    foreach( $this->choices as $key => $val ) : $ctr++; ?>
                        
                        <input name="<?php echo esc_attr( $this->id ); ?>" <?php $this->link() ?> type="radio" id="switch_<?php echo esc_attr( $key) ?>" value="<?php echo esc_attr( $key ); ?>" <?php checked( $this->value(), $key ); ?>/>
                        <label for="switch_<?php echo esc_attr( $key) ?>"><?php echo esc_attr( $val ); ?></label>
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

                .switch-field {
                    overflow: hidden;
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
                  display: inline-block;
                  width: 60px;
                  background-color: #e4e4e4;
                  color: rgba(0, 0, 0, 0.6);
                  font-size: 14px;
                  font-weight: normal;
                  text-align: center;
                  text-shadow: none;
                  padding: 6px 14px;
                  border: 1px solid rgba(0, 0, 0, 0.2);
                  -webkit-box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
                  box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
                  -webkit-transition: all 0.1s ease-in-out;
                  -moz-transition:    all 0.1s ease-in-out;
                  -ms-transition:     all 0.1s ease-in-out;
                  -o-transition:      all 0.1s ease-in-out;
                  transition:         all 0.1s ease-in-out;
                }

                .switch-field label:hover {
                        cursor: pointer;
                }

                .switch-field input:checked + label {
                  background-color: #A5DC86;
                  -webkit-box-shadow: none;
                  box-shadow: none;
                }

                .switch-field label:first-of-type {
                  border-radius: 4px 0 0 4px;
                }

                .switch-field label:last-of-type {
                  border-radius: 0 4px 4px 0;
                }
            </style>

        <?php
        }

    }

} );