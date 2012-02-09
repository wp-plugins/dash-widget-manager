<?php
/*
Plugin Name: Dash Widget Manager
Plugin URI: http://www.wpmason.com/our-plugins/dash-widget-manager/
Description: A plugin for hiding the widgets on the admin dashboard.  It also gives you the ability to hide core and plugin update messages from non admin users.
Version: 0.2
Author: Jeff Sterup
Author URI: http://www.wpmason.com
*/
$DWMAbsPath = WP_PLUGIN_DIR . "/" . plugin_basename(dirname(__FILE__));
$DWMUrlPath = plugins_url("", __FILE__);
require_once($DWMAbsPath . "/lib/DashWidgetManager.class.php");

$DashWidgetManager = new DashWidgetManager();
add_action('wp_dashboard_setup', array($DashWidgetManager, 'manage_dash_setup'), 100);
add_filter('wp_dashboard_widgets', array($DashWidgetManager, 'manage_widgets'), 100, 1);
add_action('admin_menu', array($DashWidgetManager, 'admin_menu'));

if (get_option($wpdb->prefix.'dash_widget_manager_core_update_message') == 0) {
	add_filter( 'pre_site_transient_update_core', array($DashWidgetManager, 'hide_core_update'));
}
if (get_option($wpdb->prefix.'dash_widget_manager_plugin_update_message') == 0) {
	add_filter( 'admin_head', array($DashWidgetManager, 'hide_plugin_update'));
}
?>