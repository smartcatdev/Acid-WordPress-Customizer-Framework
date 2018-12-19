<?php
add_action( 'customize_register', 'acid_register_sortable' );

function acid_register_sortable() {
    /**
     * Sortable Repeater Custom Control
     *
     * @author Anthony Hortin <http://maddisondesigns.com>
     * @license http://www.gnu.org/licenses/gpl-2.0.html
     * @link https://github.com/maddisondesigns
     */
    class AcidSortable extends WP_Customize_Control {

        /**
         * The type of control being rendered
         */
        public $type = 'sortable_repeater';

        /**
         * Button labels
         */
        public $button_labels = array ();

        /**
         * Constructor
         */
        public function __construct( $manager, $id, $args = array (), $options = array () ) {
            parent::__construct( $manager, $id, $args );
            // Merge the passed button labels with our default labels
            $this->button_labels = wp_parse_args( $this->button_labels, array (
                'add' => __( 'Add', 'acid' ),
                    )
            );
        }

        /**
         * Enqueue our scripts and styles
         */
        public function enqueue() {

            wp_enqueue_script( 'sortable_control_js', AcidConfig::assets_url() . 'js/sortable.js', array ( 'jquery', 'jquery-ui-core' ), rand(), true );
            add_action( 'customize_controls_print_styles', array ( $this, 'print_styles' ) );
        }

        /**
         * Render the control in the customizer
         */
        public function render_content() {
            ?>
            <div class="sortable_repeater_control">
            <?php if ( !empty( $this->label ) ) { ?>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <?php } ?>
                <?php if ( !empty( $this->description ) ) { ?>
                    <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <?php } ?>
                <input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-sortable-repeater" <?php $this->link(); ?> />
                <div class="sortable">
                    <div class="repeater">
                        <input type="text" value="" class="repeater-input" placeholder="https://" /><span class="dashicons dashicons-sort"></span><a class="customize-control-sortable-repeater-delete" href="#"><span class="dashicons dashicons-no-alt"></span></a>
                    </div>
                </div>
                <button class="button customize-control-sortable-repeater-add" type="button"><?php echo esc_html( $this->button_labels[ 'add' ] ); ?></button>
            </div>
            <?php
        }

        function print_styles() {
            ?>

            <style>
                .sortable {
                    list-style-type: none;
                    margin: 0;
                    padding: 0;
                }
                .sortable input[type="text"] {
                    margin: 5px 5px 5px 0;
                    width: 80%;
                }
                .sortable div {
                    cursor: move;
                }
                .customize-control-sortable-repeater-delete {
                    color: #d4d4d4;
                }
                .customize-control-sortable-repeater-delete:hover {
                    color: #f00;
                }
                .customize-control-sortable-repeater-delete .dashicons-no-alt {
                    text-decoration: none;
                    margin: 8px 0 0 0;
                    font-weight: 600;
                }
                .customize-control-sortable-repeater-delete:active,
                .customize-control-sortable-repeater-delete:focus {
                    outline: none;
                    -webkit-box-shadow: none;
                    box-shadow: none;
                }
                .repeater .dashicons-sort {
                    margin: 8px 5px 0 5px;
                    color: #d4d4d4;
                }
                .repeater .dashicons-sort:hover {
                    color: #a7a7a7;
                }    
            </style>

        <?php
        }

    }

}