<?php
/**
 * 
 * @version 0.0.1
 * @author Bilal Hassan
 * @copyright (c) 2017, Bilal Hassan
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


interface AcidConfig {
    const THEME_NAME = 'Acid';
    const THEME_SLUG = 'acid';
}


require_once dirname( __FILE__ ) . '/includes/AcidComponent.php';
require_once dirname( __FILE__ ) . '/includes/AcidPanel.php';
require_once dirname( __FILE__ ) . '/includes/AcidSection.php';
require_once dirname( __FILE__ ) . '/includes/AcidOption.php';
require_once dirname( __FILE__ ) . '/includes/AcidCustomizer.php';

function acid_instance() {
    return new AcidCustomizer( AcidConfig::THEME_NAME, AcidConfig::THEME_SLUG );
}
