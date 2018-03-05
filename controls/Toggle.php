<?php
add_action( 'customize_register', function() {

    class AcidToggle extends WP_Customize_Control {

        public $type = 'toggle';

        /**
         * Render the control's content.
         *
         * @author soderlind
         * @version 1.2.0
         */
        public function render_content() {
            ?>
            <label>
                <div style="display:flex;flex-direction: row;justify-content: flex-start;">
                    <span class="customize-control-title" style="flex: 2 0 0; vertical-align: middle;"><?php echo esc_html( $this->label ); ?></span>
                    <input id="cb<?php echo $this->instance_number ?>" type="checkbox" class="tgl tgl-light" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link();
            checked( $this->value() ); ?> />
                    <label for="cb<?php echo $this->instance_number ?>" class="tgl-btn"></label>
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

                wp_enqueue_script( 'customizer-toggle-control', AcidConfig::assets_url() . 'js/toggle.js', array ( 'jquery' ), rand(), true );
                add_action( 'customize_controls_print_styles', array ( $this, 'print_styles' ) );

                $css = '
			.disabled-control-title {
				color: #a0a5aa;
			}
			input[type=checkbox].tgl-light:checked + .tgl-btn {
				background: #0085ba;
			}
			input[type=checkbox].tgl-light + .tgl-btn {
			  background: #c3c3c3;
			}
			input[type=checkbox].tgl-light + .tgl-btn:after {
			  background: #c3c3c3;
			}
			input[type=checkbox].tgl-ios:checked + .tgl-btn {
			  background: #0085ba;
			}
			input[type=checkbox].tgl-flat:checked + .tgl-btn {
			  border: 4px solid #0085ba;
			}
			input[type=checkbox].tgl-flat:checked + .tgl-btn:after {
			  background: #0085ba;
			}
		';
                wp_add_inline_style( 'toggle-buttons', $css );
            }

            public function print_styles() {
                ?>

            <style type="text/css" id="acid-toggle-css">

                input[type=checkbox].tgl {
                    display: none;
                }
                input[type=checkbox].tgl, input[type=checkbox].tgl:after, input[type=checkbox].tgl:before, input[type=checkbox].tgl *, input[type=checkbox].tgl *:after, input[type=checkbox].tgl *:before, input[type=checkbox].tgl + .tgl-btn {
                    box-sizing: border-box;
                }
                input[type=checkbox].tgl::-moz-selection, input[type=checkbox].tgl:after::-moz-selection, input[type=checkbox].tgl:before::-moz-selection, input[type=checkbox].tgl *::-moz-selection, input[type=checkbox].tgl *:after::-moz-selection, input[type=checkbox].tgl *:before::-moz-selection, input[type=checkbox].tgl + .tgl-btn::-moz-selection {
                    background: none;
                }
                input[type=checkbox].tgl::selection, input[type=checkbox].tgl:after::selection, input[type=checkbox].tgl:before::selection, input[type=checkbox].tgl *::selection, input[type=checkbox].tgl *:after::selection, input[type=checkbox].tgl *:before::selection, input[type=checkbox].tgl + .tgl-btn::selection {
                    background: none;
                }
                input[type=checkbox].tgl + .tgl-btn {
                    outline: 0;
                    display: block;
                    width: 4em;
                    height: 2em;
                    position: relative;
                    cursor: pointer;
                    -webkit-user-select: none;
                    -moz-user-select: none;
                    -ms-user-select: none;
                    user-select: none;
                }
                input[type=checkbox].tgl + .tgl-btn:after, input[type=checkbox].tgl + .tgl-btn:before {
                    position: relative;
                    display: block;
                    content: "";
                    width: 50%;
                    height: 100%;
                }
                input[type=checkbox].tgl + .tgl-btn:after {
                    left: 0;
                }
                input[type=checkbox].tgl + .tgl-btn:before {
                    display: none;
                }
                input[type=checkbox].tgl:checked + .tgl-btn:after {
                    left: 50%;
                }

                input[type=checkbox].tgl-light + .tgl-btn {
                    background: #c3c3c3;
                    border-radius: 2em;
                    padding: 2px;
                    -webkit-transition: all .4s ease;
                    transition: all .4s ease;
                }
                input[type=checkbox].tgl-light + .tgl-btn:after {
                    border-radius: 50%;
                    background: #fff;
                    -webkit-transition: all .2s ease;
                    transition: all .2s ease;
                }
                input[type=checkbox].tgl-light:checked + .tgl-btn {
                    background: #0085ba;
                }

                input[type=checkbox].tgl-ios + .tgl-btn {
                    background: #fbfbfb;
                    border-radius: 2em;
                    padding: 2px;
                    -webkit-transition: all .4s ease;
                    transition: all .4s ease;
                    border: 1px solid #e8eae9;
                }
                input[type=checkbox].tgl-ios + .tgl-btn:after {
                    border-radius: 2em;
                    background: #fbfbfb;
                    -webkit-transition: left 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), padding 0.3s ease, margin 0.3s ease;
                    transition: left 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), padding 0.3s ease, margin 0.3s ease;
                    box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.1), 0 4px 0 rgba(0, 0, 0, 0.08);
                }
                input[type=checkbox].tgl-ios + .tgl-btn:hover:after {
                    will-change: padding;
                }
                input[type=checkbox].tgl-ios + .tgl-btn:active {
                    box-shadow: inset 0 0 0 2em #e8eae9;
                }
                input[type=checkbox].tgl-ios + .tgl-btn:active:after {
                    padding-right: .8em;
                }
                input[type=checkbox].tgl-ios:checked + .tgl-btn {
                    background: #86d993;
                }
                input[type=checkbox].tgl-ios:checked + .tgl-btn:active {
                    box-shadow: none;
                }
                input[type=checkbox].tgl-ios:checked + .tgl-btn:active:after {
                    margin-left: -.8em;
                }

                input[type=checkbox].tgl-flat + .tgl-btn {
                    padding: 2px;
                    -webkit-transition: all .2s ease;
                    transition: all .2s ease;
                    background: #fff;
                    border: 4px solid #f2f2f2;
                    border-radius: 2em;
                }
                input[type=checkbox].tgl-flat + .tgl-btn:after {
                    -webkit-transition: all .2s ease;
                    transition: all .2s ease;
                    background: #f2f2f2;
                    content: "";
                    border-radius: 1em;
                }
                input[type=checkbox].tgl-flat:checked + .tgl-btn {
                    border: 4px solid #7FC6A6;
                }
                input[type=checkbox].tgl-flat:checked + .tgl-btn:after {
                    left: 50%;
                    background: #7FC6A6;
                }

            </style>

        <?php
        }

    }

} );
