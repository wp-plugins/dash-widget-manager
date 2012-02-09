<?php 
$goodWidgets = get_option($wpdb->prefix.'dash_widget_manager_good_widgets');
if (!is_array($goodWidgets)) { $goodWidgets = array(); }
$coreUpdateMessage = get_option($wpdb->prefix.'dash_widget_manager_core_update_message');
$pluginUpdateMessage = get_option($wpdb->prefix.'dash_widget_manager_plugin_update_message');
?>
<div id="theme-options-wrap">
    <div class="icon32" id="icon-options-general"> <br /> </div>

    <h2>Dash Widget Manager</h2>
    <p>Edit the preferences for Dash Widget Manager.</p>

    <div id="poststuff" class="metabox-holder">
      <div id="post-body">
        <div id="post-body-content">
	      <form method=post id="dwm_options" action="" enctype="multipart/form-data">
	        <div id="<?php echo $wpdb->prefix.'dash_widget_manager_good_widgets'; ?>div" class="stuffbox" style="width: 98%">
			  <h3><label for="<?php echo $wpdb->prefix.'dash_widget_manager_good_widgets[]'; ?>">Display Widgets</label></h3>
			  <div class="inside">
				Check the box next to the widgets that will be shown to non-admin users.  Any widgets that are not checked will be hidden from non-admin users.<br><br>
				<?php foreach($dashWidgets as $widget) { ?>
					<input type="checkbox" name="<?php echo $wpdb->prefix.'dash_widget_manager_good_widgets[]'; ?>" value="<?php print $widget[0]; ?>" <?php print (in_array($widget[0], $goodWidgets)) ? 'checked="checked"' : ''; ?>><?php print $widget[1]; ?><br>
				<?php } ?>
			  </div>
			</div>
			<div id="<?php echo $wpdb->prefix.'dash_widget_manager_core_update_message'; ?>div" class="stuffbox" style="width: 98%">
			  <h3><label for="<?php echo $wpdb->prefix.'dash_widget_manager_core_update_message'; ?>">Core Update Message</label></h3>
			  <div class="inside">
				This option turns the core update message off and on.<br><br>
				<input type="radio" name="<?php echo $wpdb->prefix.'dash_widget_manager_core_update_message'; ?>" value="1" <?php print ($coreUpdateMessage == 1) ? 'checked="checked"' : ''; ?>>On<br>
				<input type="radio" name="<?php echo $wpdb->prefix.'dash_widget_manager_core_update_message'; ?>" value="0" <?php print ($coreUpdateMessage == 0) ? 'checked="checked"' : ''; ?>>Off
			  </div>
			</div>
			<div id="<?php echo $wpdb->prefix.'dash_widget_manager_plugin_update_message'; ?>div" class="stuffbox" style="width: 98%">
			  <h3><label for="<?php echo $wpdb->prefix.'dash_widget_manager_plugin_update_message'; ?>">Plugin Update Messages</label></h3>
			  <div class="inside">
				This option turns the plugin update messages off and on.<br><br>
				<input type="radio" name="<?php echo $wpdb->prefix.'dash_widget_manager_plugin_update_message'; ?>" value="1" <?php print ($pluginUpdateMessage == 1) ? 'checked="checked"' : ''; ?>>On<br>
				<input type="radio" name="<?php echo $wpdb->prefix.'dash_widget_manager_plugin_update_message'; ?>" value="0" <?php print ($pluginUpdateMessage == 0) ? 'checked="checked"' : ''; ?>>Off
			  </div>
			</div>
			<input type=hidden name="page" value="Dash_Widget_Manager">
	        <input type=submit name=submit value="Update" tabindex="8">
	      </form>
      </div>
    </div>
  </div>
</div>
