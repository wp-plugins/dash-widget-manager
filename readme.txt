=== Plugin Name ===
Contributors: foomagoo
Donate link: 
Tags: dashboard widget manager, manage dashboard widgets, dashboard widgets, hide dashboard widgets, hide update messages, hide core update, widgets by role
Requires at least: 3.1
Tested up to: 3.3.1
Stable tag: 0.3

This plugin allows you to do the following:
1. Hide dashboard widgets from non admin users.
2. Hide core and plugin update messages.

== Description ==

This plugin allows you to do the following:
1. Hide dashboard widgets from non admin users.
2. Hide core and plugin update messages.

== Installation ==

1. Extract the downloaded Zip file.
2. Upload the 'dash-widget-manager' directory to the `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in WordPress
4. You can either use the menu item under settings in the WordPress admin called Dash Widget Manager to manage the settings.

== Frequently Asked Questions ==

Q. Does this plugin interrupt the wordpress update checks?

A. No.  It only hides the messages that appear letting you know an update is available.  For the core message the alert function is overridden and it is never printed to the page.  For the plugin updates CSS is used to merely hide them.
== Screenshots ==

1. Plugin admin page example.

== Changelog ==

= 0.3 =
Fixed cant send header error on dashboard 
Moved some global path variables into the DashWidgetManager class.

= 0.2 =
removed white space after plugin header and conditional that may cause activaion issues.

= 0.1 =
Initial version.

== Upgrade Notice ==

= 0.3 =
Fixed cant send header error on dashboard 
Moved some global path variables into the DashWidgetManager class.

= 0.2 =
removed white space after plugin header and conditional that may cause activaion issues.
