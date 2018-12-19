<?php
if ( !class_exists( 'AcidWidget' ) ) {

    class AcidWidget extends WP_Widget {

        private $widget_fields;
        private $file;

        const VERSION = 1;

        function __construct( $args, $fields ) {

            $this->widget_fields = $fields;

            if ( file_exists( $args[ 'output_file' ] ) ) {
                $this->file = $args[ 'output_file' ];
            } else {
                _doing_it_wrong( '__construct()', __( 'The file path you specified is incorrect in ' . get_called_class(), 'acid' ), self::VERSION );
                return;
            }

            parent::__construct(
                    $args[ 'id' ], esc_html__( $args[ 'title' ], 'acid' ), array ( 'description' => esc_html__( $args[ 'description' ], 'acid' ), )
            );

            add_action( 'admin_footer', array ( $this, 'media_fields' ) );

            // media upload
            add_action( 'customize_controls_print_footer_scripts', array ( $this, 'media_fields' ) );

            //color picker
            add_action( 'admin_enqueue_scripts', array ( $this, 'enqueue_scripts' ) );
            add_action( 'admin_footer-widgets.php', array ( $this, 'print_scripts' ), 9999 );
        }

        public function enqueue_scripts( $hook_suffix ) {

            wp_enqueue_script( 'wp-color-picker' );
            wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_script( 'underscore' );
        }

        public function print_scripts() {
            ?>
            <script>
                (function ($) {
                    function initColorPicker(widget) {
                        widget.find('.color-picker').wpColorPicker({
                            change: _.throttle(function () { // For Customizer
                                $(this).trigger('change');
                            }, 3000)
                        });
                    }

                    function onFormUpdate(event, widget) {
                        initColorPicker(widget);
                    }

                    $(document).on('widget-added widget-updated', onFormUpdate);

                    $(document).ready(function () {
                        $('#widgets-right .widget:has(.color-picker)').each(function () {
                            initColorPicker($(this));
                        });
                    });
                }(jQuery));
            </script>
            <?php
        }

        public function widget( $args, $instance ) {
            include $this->output;
        }

        /**
         * Media Field Backend
         */
        public function media_fields() {
            ?><script>
                jQuery(document).ready(function ($) {
                    if (typeof wp.media !== 'undefined') {
                        var _custom_media = true,
                                _orig_send_attachment = wp.media.editor.send.attachment;
                        $(document).on('click', '.custommedia', function (e) {
                            var send_attachment_bkp = wp.media.editor.send.attachment;
                            var button = $(this);
                            var id = button.attr('id');
                            _custom_media = true;
                            wp.media.editor.send.attachment = function (props, attachment) {
                                if (_custom_media) {
                                    $('input#' + id).val(attachment.url);
                                    $('input#' + id).trigger('change');
                                } else {
                                    return _orig_send_attachment.apply(this, [props, attachment]);
                                }
                                ;
                            }
                            wp.media.editor.open(button);
                            return false;
                        });
                        $('.add_media').on('click', function () {
                            _custom_media = false;
                        });
                    }
                });
            </script><?php
        }

        /**
         * Back-end widget fields
         * 
         */
        public function field_generator( $instance ) {
            $output = '';
            foreach ( $this->widget_fields as $widget_field ) {
                $widget_value = !empty( $instance[ $widget_field[ 'id' ] ] ) ? $instance[ $widget_field[ 'id' ] ] : esc_html__( $widget_field[ 'default' ], 'acid' );

                switch ( $widget_field[ 'type' ] ) {


                    case 'media':
                        $output .= '<p>';
                        $output .= '<label for="' . esc_attr( $this->get_field_id( $widget_field[ 'id' ] ) ) . '">' . esc_attr( $widget_field[ 'label' ], 'acid' ) . ':</label> ';
                        $output .= '<input class="widefat" id="' . esc_attr( $this->get_field_id( $widget_field[ 'id' ] ) ) . '" name="' . esc_attr( $this->get_field_name( $widget_field[ 'id' ] ) ) . '" type="' . $widget_field[ 'type' ] . '" value="' . esc_url( $widget_value ) . '">';
                        $output .= '<button id="' . $this->get_field_id( $widget_field[ 'id' ] ) . '" class="button select-media custommedia">Add Media</button>';
                        $output .= '</p>';
                        break;
                    case 'checkbox':
                        $output .= '<p>';
                        $output .= '<input class="checkbox" type="checkbox" ' . checked( $widget_value, true, false ) . ' id="' . esc_attr( $this->get_field_id( $widget_field[ 'id' ] ) ) . '" name="' . esc_attr( $this->get_field_id( $widget_field[ 'id' ] ) ) . '" value="1">';
                        $output .= '<label for="' . esc_attr( $this->get_field_id( $widget_field[ 'id' ] ) ) . '">' . esc_attr( $widget_field[ 'label' ], 'acid' ) . '</label>';
                        $output .= '</p>';
                        break;
                    case 'toggle':
                        $output .= '<div class="toggle-flex">';
                        $output .= '<div class="flex-inner-small">';
                        $output .= '<label class="switch">';
                        $output .= '<input class="checkbox" type="checkbox" ' . checked( $widget_value, true, false ) . ' id="' . esc_attr( $this->get_field_id( $widget_field[ 'id' ] ) ) . '" name="' . esc_attr( $this->get_field_id( $widget_field[ 'id' ] ) ) . '" value="1">';
                        $output .= '<span class="slider round"></span>';
                        $output .= '<label class="tgl-btn" for="' . esc_attr( $this->get_field_id( $widget_field[ 'id' ] ) ) . '">' . esc_attr( $widget_field[ 'label' ], 'acid' ) . '</label>';
                        $output .= '</label>';
                        $output .= '</div>';
                        $output .= '</div>';
                        break;
                    case 'textarea':
                        $output .= '<p>';
                        $output .= '<label for="' . esc_attr( $this->get_field_id( $widget_field[ 'id' ] ) ) . '">' . esc_attr( $widget_field[ 'label' ], 'acid' ) . ':</label> ';
                        $output .= '<textarea class="widefat" id="' . esc_attr( $this->get_field_id( $widget_field[ 'id' ] ) ) . '" name="' . esc_attr( $this->get_field_name( $widget_field[ 'id' ] ) ) . '" rows="6" cols="6" value="' . esc_attr( $widget_value ) . '">' . $widget_value . '</textarea>';
                        $output .= '</p>';
                        break;
                    case 'colorpicker':
                        $output .= '<p>';
                        $output .= '<label for="' . esc_attr( $this->get_field_id( $widget_field[ 'id' ] ) ) . '">' . esc_attr( $widget_field[ 'label' ], 'acid' ) . ':</label> ';
                        $output .= '<input class="widefat color-picker" id="' . esc_attr( $this->get_field_id( $widget_field[ 'id' ] ) ) . '" name="' . esc_attr( $this->get_field_name( $widget_field[ 'id' ] ) ) . '" type="' . $widget_field[ 'type' ] . '" value="' . esc_attr( $widget_value ) . '">';
                        $output .= '</p>';
                        break;
                    default:
                        $output .= '<p>';
                        $output .= '<label for="' . esc_attr( $this->get_field_id( $widget_field[ 'id' ] ) ) . '">' . esc_attr( $widget_field[ 'label' ], 'acid' ) . ':</label> ';
                        $output .= '<input class="widefat" id="' . esc_attr( $this->get_field_id( $widget_field[ 'id' ] ) ) . '" name="' . esc_attr( $this->get_field_name( $widget_field[ 'id' ] ) ) . '" type="' . $widget_field[ 'type' ] . '" value="' . esc_attr( $widget_value ) . '">';
                        $output .= '</p>';
                        break;
                }
            }
            echo $output;
        }

        /**
         * this will handle form output
         */
        public function form( $instance ) {

            // Delete from here if you do not want a Widget Title

            $title = !empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : esc_html__( '', 'acid' );
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'acid' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
            </p>
            <?php
            // End delete for title removal

            $this->field_generator( $instance );
        }

        /**
         * this will handle form update
         */
        public function update( $new_instance, $old_instance ) {
            $instance = array ();
            $instance[ 'title' ] = (!empty( $new_instance[ 'title' ] ) ) ? strip_tags( $new_instance[ 'title' ] ) : '';
            foreach ( $this->widget_fields as $widget_field ) {
                switch ( $widget_field[ 'type' ] ) {
                    case 'checkbox':
                        $instance[ $widget_field[ 'id' ] ] = $_POST[ $this->get_field_id( $widget_field[ 'id' ] ) ];
                        break;
                    default:
                        $instance[ $widget_field[ 'id' ] ] = (!empty( $new_instance[ $widget_field[ 'id' ] ] ) ) ? strip_tags( $new_instance[ $widget_field[ 'id' ] ] ) : '';
                }
            }
            return $instance;
        }

    }

}
