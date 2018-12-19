<?php
if ( !class_exists( 'AcidWidget' ) ) {

    class AcidWidget extends WP_Widget {

        private $widget_fields;
        private $file;
        private $title_bool;
        private $css = array();
        private $styles;
        private $scripts;
        private $localize;

        const VERSION = 1;

        function __construct( $args, $fields, $styles = null, $scripts = null, $localize = null ) {

            $this->widget_fields = $fields;
            $this->scripts = $scripts;
            $this->styles = $styles;
            $this->localize = $localize;
            
            $this->title_bool = isset( $args['widget_title'] ) ? $args['widget_title'] : false;

            if ( file_exists( $args[ 'output_file' ] ) ) {
                $this->file = $args[ 'output_file' ];
            } else {
                _doing_it_wrong( '__construct()', sprintf( __( 'The file path you specified is incorrect in %', 'acid' ), get_called_class() ), self::VERSION );
                return;
            }

            parent::__construct(
                    $args[ 'id' ],
                    esc_html__( $args[ 'title' ], 'acid' ), 
                    array ( 
                        'description' => esc_html__( $args[ 'description' ], 'acid' )
                    )
            );

            add_action( 'admin_footer', array ( $this, 'media_fields' ) );

            // media upload
            add_action( 'customize_controls_print_footer_scripts', array ( $this, 'media_fields' ) );

            //color picker
            add_action( 'admin_enqueue_scripts', array ( $this, 'enqueue_scripts' ) );
            add_action( 'admin_footer-widgets.php', array ( $this, 'print_scripts' ), 9999 );
            
            //
            add_action( 'wp_footer', array( $this, 'dynamic_css' ) );
            
            
        }
        
        
        public function dynamic_css() {
            
            if( ! $this->css ) {
                return;
            }
            
            $final_css = '';
            foreach( $this->css as $style => $style_array ) {
                
                $final_css .= $style . '{';
                foreach( $style_array as $property => $value ) {
                    $final_css .= esc_attr( $property ) . ':' . esc_attr( $value ) . ';';
                }
                $final_css .= '}';
            }
            
            
            ?>
            
            <style type="text/css"><?php echo $final_css; ?></style>

            <?php
            
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

        public function widget( $args, $instance) {
            
            // Enqueue styles from child class
            if( $this->styles ) {
                foreach( $this->styles as $id=>$file ) {
                    wp_enqueue_style( $id, $file, null );
                }
            }
            
            // Enqueue scripts from child class
            if( $this->scripts ) {
                foreach( $this->scripts as $id=>$file ) {
                    wp_enqueue_script( $id, $file, array( 'jquery' ) );
                }
            }
            
            
            $defaults = [];

            foreach( $this->widget_fields as $key => $val ) {
                $defaults[$key] = $this->widget_fields[$key]['default'];
            }

            $values = wp_parse_args( $instance, $defaults );
            
            include $this->file;
        }

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
                
                if( $widget_field[ 'type' ] == 'textarea' ) {
                    $widget_value = !empty( $instance[ $widget_field[ 'id' ] ] ) ? $instance[ $widget_field[ 'id' ] ] : $widget_field[ 'default' ];
                }else{
                    $widget_value = !empty( $instance[ $widget_field[ 'id' ] ] ) ? $instance[ $widget_field[ 'id' ] ] : esc_html__( $widget_field[ 'default' ], 'acid' );
                }
                
                
                
                switch ( $widget_field[ 'type' ] ) {


                    case 'title' :
                        $output .= '<h2>' . esc_html( $widget_field[ 'label' ] ) . '</h2>';
                        break;
                    
                    case 'seperator' :
                        $output .= '<div class="clear"><hr/></div>';
                        break;
                    
                    case 'section' :
                        $output .= '<div class="acid-widget-control-header">';
                        $output .= '<h4 class="section-header">' . esc_html( $widget_field[ 'label' ] ) . '</h4>';
                        $output .= '</div>';
                        break;
                    
                    case 'media':
                        $output .= '<div class="acid-widget-control-media">';
                        $output .= '<p>';
                        $output .= '<label class="acid-control-title" for="' . esc_attr( $this->get_field_id( $widget_field[ 'id' ] ) ) . '">' . esc_html( $widget_field[ 'label' ], 'acid' ) . ':</label> ';
                        $output .= '<input class="widefat" id="' . esc_attr( $this->get_field_id( $widget_field[ 'id' ] ) ) . '" name="' . esc_attr( $this->get_field_name( $widget_field[ 'id' ] ) ) . '" type="' . esc_attr( $widget_field[ 'type' ] ) . '" value="' . esc_url( $widget_value ) . '">';
                        $output .= '<button id="' . $this->get_field_id( $widget_field[ 'id' ] ) . '" class="button select-media custommedia">Add Media</button>';
                        $output .= '</p>';
                        $output .= '</div>';
                        break;
                    
                    case 'checkbox':
                        $output .= '<div class="acid-widget-control-checkbox">';
                        $output .= '<p>';
                        $output .= '<input class="checkbox" type="checkbox" ' . checked( $widget_value, 'on', false ) . ' id="' . esc_attr( $this->get_field_id( $widget_field[ 'id' ] ) ) . '" name="' . esc_attr( $this->get_field_name( $widget_field[ 'id' ] ) ) . '" />';
                        $output .= '<label class="acid-control-title" for="' . esc_attr( $this->get_field_id( $widget_field[ 'id' ] ) ) . '">' . esc_html( $widget_field[ 'label' ], 'acid' ) . '</label>';
                        $output .= '</p>';
                        $output .= '</div>';
                        break;
                    
                    case 'toggle':
                        $output .= '<div class="acid-widget-control-toggle">';
                        $output .= '<label class="artisan-control-title">';
                        $output .= '<span>' . esc_html( $widget_field[ 'label' ], 'acid' ) . '</span>';
                        $output .= '</label>';
                        $output .= '<div class="toggle-flex">';
                        $output .= '<div class="flex-inner-small">';
                        $output .= '<label class="switch">';
                        $output .= '<input class="checkbox" type="checkbox" ' . checked( $widget_value, 'on', false ) . ' id="' . esc_attr( $this->get_field_id( $widget_field[ 'id' ] ) ) . '" name="' . esc_attr( $this->get_field_name( $widget_field[ 'id' ] ) ) . '" />';
                        $output .= '<span class="slider round"></span>';
                        $output .= '<label class="tgl-btn" for="' . esc_attr( $this->get_field_id( $widget_field[ 'id' ] ) ) . '"></label>';
                        $output .= '</label>';
                        $output .= '</div>';
                        $output .= '</div>';
                        $output .= '</div>';
                        break;
                    
                    case 'textarea':
                        $output .= '<div class="acid-widget-control-textarea">';
                        $output .= '<p>';
                        $output .= '<label class="acid-control-title" for="' . esc_attr( $this->get_field_id( $widget_field[ 'id' ] ) ) . '">' . esc_attr( $widget_field[ 'label' ], 'acid' ) . ':</label> ';
                        $output .= '<textarea class="widefat" id="' . esc_attr( $this->get_field_id( $widget_field[ 'id' ] ) ) . '" name="' . esc_attr( $this->get_field_name( $widget_field[ 'id' ] ) ) . '" rows="6" cols="6" value="' . esc_attr( $widget_value ) . '">' . $widget_value . '</textarea>';
                        $output .= '</p>';
                        $output .= '</div>';
                        break;
                    
                    case 'select':
                        $output .= '<div class="acid-widget-control-select">';
                        $output .= '<p>';
                        $output .= '<label class="acid-control-title" for="' . esc_attr( $this->get_field_id( $widget_field[ 'id' ] ) ) . '">' . esc_html( $widget_field[ 'label' ], 'acid' ) . ':</label> ';
                        $output .= '<select name="' . esc_attr( $this->get_field_name( $widget_field[ 'id' ] ) ) . '" id="' . esc_attr( $this->get_field_id( $widget_field[ 'id' ] ) ) . '" class="widefat">';
                        $output .= '<option value="">' . __( 'Select option', 'acid' ) . '</option>';
                        foreach( $widget_field['options'] as $key=>$val ) :
                            $output .= '<option value="'. esc_attr( $key ) . '" ' . selected( $widget_value, $key, false ) . '>' . esc_html( $val ) . '</option>';
                        endforeach;
                        $output .= '</select>';
                        $output .= '</p>';
                        $output .= '</div>';
                        break;
                    
                    case 'colorpicker':
                        $output .= '<div class="acid-widget-control-colorpicker">';
                        $output .= '<p>';
                        $output .= '<label class="acid-control-title" for="' . esc_attr( $this->get_field_id( $widget_field[ 'id' ] ) ) . '">' . esc_html( $widget_field[ 'label' ], 'acid' ) . ':</label> ';
                        $output .= '<input class="widefat color-picker" '
                                . 'id="' . esc_attr( $this->get_field_id( $widget_field[ 'id' ] ) ) . '" '
                                . 'name="' . esc_attr( $this->get_field_name( $widget_field[ 'id' ] ) ) . '" '
                                . 'type="' . esc_attr( $widget_field[ 'type' ] ) . '" value="' . esc_attr( $widget_value ) . '">';
                        $output .= '</p>';
                        $output .= '</div>';
                        break;
                    
                    default:
                        $output .= '<div class="acid-widget-control-' . esc_attr( $widget_field[ 'type' ] ) . '">';
                        $output .= '<p>';
                        $output .= '<label class="acid-control-title" for="' . esc_attr( $this->get_field_id( $widget_field[ 'id' ] ) ) . '">' . esc_html( $widget_field[ 'label' ], 'acid' ) . ':</label> ';
                        $output .= '<input class="widefat" id="' . esc_attr( $this->get_field_id( $widget_field[ 'id' ] ) ) . '" name="' . esc_attr( $this->get_field_name( $widget_field[ 'id' ] ) ) . '" type="' . esc_attr( $widget_field[ 'type' ] ) . '" value="' . esc_attr( $widget_value ) . '">';
                        $output .= '</p>';
                        $output .= '</div>';
                        break;
                }
            }
            echo $output;
        }

        public function form( $instance ) {

            if( $this->title_bool ) {
                $title = !empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : esc_html__( '', 'acid' );
                ?>
                <p>
                    <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'acid' ); ?></label>
                    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
                </p>
                <?php
            }
            
            $this->field_generator( $instance );
        }

        public function update( $new_instance, $old_instance ) {
            $instance = array ();
            $instance[ 'title' ] = (!empty( $new_instance[ 'title' ] ) ) ? strip_tags( $new_instance[ 'title' ] ) : '';
            foreach ( $this->widget_fields as $widget_field ) {
                switch ( $widget_field[ 'type' ] ) {
                    case 'checkbox':
                        $instance[ $widget_field[ 'id' ] ] = (!empty( $new_instance[ $widget_field[ 'id' ] ] ) && $new_instance[ $widget_field[ 'id' ] ] == 'on' ) ? 'on' : 'off';
                        break;
                    case 'toggle':
                        $instance[ $widget_field[ 'id' ] ] = (!empty( $new_instance[ $widget_field[ 'id' ] ] ) && $new_instance[ $widget_field[ 'id' ] ] == 'on' ) ? 'on' : 'off';
                        break;
                    case 'textarea':
                        $instance[ $widget_field[ 'id' ] ] = (!empty( $new_instance[ $widget_field[ 'id' ] ] ) ) ? htmlentities( $new_instance[ $widget_field[ 'id' ] ] ) : '';
                        break;
                    default:
                        $instance[ $widget_field[ 'id' ] ] = (!empty( $new_instance[ $widget_field[ 'id' ] ] ) ) ? strip_tags( $new_instance[ $widget_field[ 'id' ] ] ) : '';
                }
            }
            return $instance;
        }

    }

}
