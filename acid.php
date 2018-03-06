<?php
/**
 * 
 * 
 * @version 0.0.2
 * @author Bilal Hassan
 * @copyright (c) 2018, Bilal Hassan
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * 
 * 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class AcidConfig {
    
    const THEME_NAME = 'Acid';
    const THEME_SLUG = 'acid';
    static $url = null;
    
    
    public static function set_url( $url ) {
        self::$url = $url;
    }
    
    public static function get_url() {
        return self::$url . 'Acid/';
    }
    
    public static function assets_url() {
        return self::get_url() . 'assets/';
    }
    
}


require_once dirname( __FILE__ ) . '/controls/RadioImage.php';
require_once dirname( __FILE__ ) . '/controls/RadioToggle.php';
require_once dirname( __FILE__ ) . '/controls/Range.php';
require_once dirname( __FILE__ ) . '/controls/Toggle.php';
require_once dirname( __FILE__ ) . '/controls/Sortable.php';
require_once dirname( __FILE__ ) . '/controls/ColorPicker.php';

require_once dirname( __FILE__ ) . '/includes/AcidComponent.php';
require_once dirname( __FILE__ ) . '/includes/AcidPanel.php';
require_once dirname( __FILE__ ) . '/includes/AcidSection.php';
require_once dirname( __FILE__ ) . '/includes/AcidOption.php';
require_once dirname( __FILE__ ) . '/includes/AcidCustomizer.php';
require_once dirname( __FILE__ ) . '/includes/functions-sanitization.php';
require_once dirname( __FILE__ ) . '/includes/functions-option.php';

function acid_instance( $url ) {
    
    AcidConfig::set_url( $url ); 
    return new AcidCustomizer( AcidConfig::THEME_NAME, AcidConfig::THEME_SLUG );
    
}
