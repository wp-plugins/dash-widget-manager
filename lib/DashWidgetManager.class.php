<?php
class DashWidgetManager {
	function __construct() {
	}

	function manage_dash_setup() {
		global $wp_meta_boxes, $wpdb;
		if (current_user_can('administrator') && is_array($wp_meta_boxes['dashboard'])) {
			update_option($wpdb->prefix.'dash_widget_manager_registered_widgets', $wp_meta_boxes['dashboard']);
		}
		
		if (!current_user_can('manage_options')) {
			$goodWidgets = get_option($wpdb->prefix.'dash_widget_manager_good_widgets');
			if (!is_array($goodWidgets)) {
				$goodWidgets = array();
			}
			
			foreach ($wp_meta_boxes['dashboard']['normal']['core'] as $widget) {
				if (!in_array($widget['id'], $goodWidgets)) {
					unset($wp_meta_boxes['dashboard']['normal']['core'][$widget['id']]);
				}
			}

			foreach ($wp_meta_boxes['dashboard']['side']['core'] as $widget) {
				if (!in_array($widget['id'], $goodWidgets)) {
					unset($wp_meta_boxes['dashboard']['side']['core'][$widget['id']]);
				}
			}
		}
	}

	function manage_widgets($widgets) {
		global $wpdb;
		if (!current_user_can('manage_options')) {
			$goodWidgets = get_option($wpdb->prefix.'dash_widget_manager_good_widgets');
			if (!is_array($goodWidgets)) {
				$goodWidgets = array();
			}
			for($i=0; $i < sizeof($widgets); $i++) {
				if (!in_array($widgets[$i], $goodWidgets)) {
					unset($widgets[$i]);
				}
			}
		}
		return $widgets;
	}

	function admin_menu() {
		if (current_user_can('manage_options')) {
			add_options_page('Dash Widget Manager', 'Dash Widget Manager', 'manage_options', 'Dash_Widget_Manager', array($this, 'options_page'));
		}
	}


	function options_page() {
		global $wpdb, $DWMAbsPath;
		if (current_user_can('manage_options')) {
			require_once(ABSPATH . "/wp-admin/includes/dashboard.php");
			$dashWidgets = array();
			$registered_meta_boxes = get_option($wpdb->prefix.'dash_widget_manager_registered_widgets');
			if (!is_array($registered_meta_boxes)) {
				$registered_meta_boxes = array();
			}
			foreach ($registered_meta_boxes['normal']['core'] as $key=>$data) {
				$widgetTitle = preg_replace("/Configure/", "", strip_tags($data['title']));
				$dashWidgets[] = array($key, $widgetTitle);
			}
			foreach ($registered_meta_boxes['side']['core'] as $key=>$data) {
				$widgetTitle = preg_replace("/Configure/", "", strip_tags($data['title']));
				$dashWidgets[] = array($key, $widgetTitle);
			}
			
			if (isset($_POST['submit']) && $_POST['submit'] == "Update") {
				$goodData = 1;
				if (isset($_POST[$wpdb->prefix.'dash_widget_manager_good_widgets'])) {
					$updatedWidgetList = $_POST[$wpdb->prefix.'dash_widget_manager_good_widgets'];
					foreach ($_POST[$wpdb->prefix.'dash_widget_manager_good_widgets'] as $widget) {
						if (!preg_match("/^([A-Za-z0-9_\-])+$/", $widget)) {
							$goodData = 0;
						}
					}
				} else {
					$updatedWidgetList = array("");
				}
				if ($goodData == 1) {
					update_option($wpdb->prefix.'dash_widget_manager_good_widgets', $updatedWidgetList);
				}
			}
			if (isset($_POST[$wpdb->prefix.'dash_widget_manager_core_update_message'])) {
				if (preg_match("/^(1|0)$/", $_POST[$wpdb->prefix.'dash_widget_manager_core_update_message'])) {
					update_option($wpdb->prefix.'dash_widget_manager_core_update_message', $_POST[$wpdb->prefix.'dash_widget_manager_core_update_message']);
				}
			}
			if (isset($_POST[$wpdb->prefix.'dash_widget_manager_plugin_update_message'])) {
				if (preg_match("/^(1|0)$/", $_POST[$wpdb->prefix.'dash_widget_manager_plugin_update_message'])) {
					update_option($wpdb->prefix.'dash_widget_manager_plugin_update_message', $_POST[$wpdb->prefix.'dash_widget_manager_plugin_update_message']);
				}
			}
			

			include($DWMAbsPath.'/tpl/options.php');
		} else {
			echo "You dont have permissions to access this page.";
		}
		
	}


	function hide_plugin_update() {
		?>
		<style type="text/css">
			.plugin-update {
				display: none;
			}
		</style>
		<?php
	}

	function hide_core_update($message) {
		return null;
	}

}
?>