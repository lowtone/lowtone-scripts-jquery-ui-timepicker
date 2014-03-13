<?php
/*
 * Plugin Name: Script Library: jQuery Timepicker
 * Plugin URI: http://wordpress.lowtone.nl/scripts-jquery-ui-timepicker
 * Plugin Type: lib
 * Description: Include jQuery Timepicker plugin.
 * Version: 1.0
 * Author: Lowtone <info@lowtone.nl>
 * Author URI: http://lowtone.nl
 * License: http://wordpress.lowtone.nl/license
 */

namespace lowtone\scripts\jquery\ui\timepicker {

	use lowtone\content\packages\Package;

	// Includes
	
	if (!include_once WP_PLUGIN_DIR . "/lowtone-content/lowtone-content.php") 
		return trigger_error("Lowtone Content plugin is required", E_USER_ERROR) && false;

	$GLOBALS["lowtone_scripts_jquery_ui_timepicker"] = Package::init(array(
			Package::INIT_PACKAGES => array("lowtone\\scripts"),
			Package::INIT_SUCCESS => function() {

				wp_register_style("jquery-timepicker", LIB_URL . "/lowtone-scripts-jquery-ui-timepicker/assets/styles/timepicker.css", array(), "1.0.0");
				wp_register_style("jquery-timepicker-admin", LIB_URL . "/lowtone-scripts-jquery-ui-timepicker/assets/styles/admin.css", array(), "1.0.0");

				add_filter("script_loader_src", function($src, $handle) {
					if ("jquery-timepicker" != $handle)
						return $src;

					wp_enqueue_style("jquery-timepicker");

					if (is_admin())
						wp_enqueue_style("jquery-timepicker-admin");

					return $src;
				}, 10, 2);

				return array(
						"registered" => \lowtone\scripts\register(__DIR__ . "/assets/scripts", array("jquery-ui-slider", "jquery-ui-datepicker"), "1.2.2")
					);
			}
		));

	function registered() {
		global $lowtone_scripts_jquery_ui_timepicker;
		
		return isset($lowtone_scripts_jquery_ui_timepicker["registered"]) ? $lowtone_scripts_jquery_ui_timepicker["registered"] : false;
	}
	
}