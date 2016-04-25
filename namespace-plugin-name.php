Plugin Name

wp-content/plugins/namespace-plugin-name/

namespace-plugin-name.php

- meta information in comments

<?php
//Assign global variables
$plugin_url = WP_PLUGIN_URL . '/namespace-plugin-name';
$options = array();

//add a link to the plugin in the admin menu under settings > Plugin Name
function namespace_plugin_name_menu () {
	//use the add_options_page function
	//add_options_page($page_title, $menu_title, $capability, $menu-slug, $function)

	add_options_page(
		'Plugin Name (page title)',
		'Plugin Name (menu title)',
		'manage_options',
		'namespace-plugin-name',
		'namespace_plugin_name_options_page'
	);
}
//execute function during the admin_menu hook
add_action( 'admin_menu', 'namespace_plugin_name_menu');

function namespace_plugin_name_options_page() {
	//check if the user can make settings changes
	if(!current_user_can('manage_options')){
		wp_die('You do not have permissions to access this page!');
	}
	//make the plugin url available inside the required file listed below
	global $plugin_url;
	global $options;

	//check if our form was submitted
	if( isset($_POST['namespace_form_submitted'])) {
		$hidden_field = esc_html( $_POST['namespace_form_submitted']);
		if ($hidden_field == 'Y') {
			$namespace_setting1 = esc_html($_POST['namespace_setting1']);
			//echo $namespace_setting1;

			$namespace_json_stuff = namespace_plugin_name_get_json($somevariable);

			//add inputed value to the WP options table
			$options['namespace_setting1'] = $namespace_setting1;
			$options['last_updated'] = time();
			$options['namespace_json_stuff'] = $namespace_json_stuff;

			update_option('namespace_plugin_name', $options);
		}
	}

	//get the options out of the WP options table so we can use them
	$options = get_option('namespace_pugin_name');
	if( $options != '' ) {
		$namespace_setting1 = $options['namespace_setting1'];
		$namespace_json_stuff = $options['namespace_json_stuff'];
	}

	//echo '<p>Welcome to our plugin page!</p>';
	//can't use echo to get json stuff, need to use var_dump because it's an array
	//var_dump $namespace_json_stuff;

	require ( 'inc/options-page-wrapper.php')
}

//Get a widget set up, start from http://codex.wordpress.org/Function_Reference/register_widget#example
class Namespace_Plugin_Name_Widget extends WP_Widget {

	function namespace_plugin_name_widget() {
		// Instantiate the parent object
		parent::__construct( false, 'My New Widget Title' );
	}

	function widget( $args, $instance ) {
		// Widget output (front end)

		extract($args);
		//examples
		$title = apply_filters('widget_title', $instance['title']);
		$show_plot = $instance['show_plot'];

		
		$options = get_option('namespace_plugin_name');
		$namespace_json_stuff = $options['namespace_json_stuff'];

		require('inc/front-end.php');
	}

	function update( $new_instance, $old_instance ) {
		// Save widget options

		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['show_plot'] = strip_tags($new_instance['show_plot']);

		return $instance;
	}

	function form( $instance ) {
		// Output admin widget options form

		$title = esc_attr($instance['title']);
		$show_plot = esc_attr($instance['show_plot']);

		$options = get_option('namespace_plugin_name');
		$namespace_json_stuff = $options['namespace_json_stuff'];

		require('inc/widget-fields.php');
	}
}

function namespace_plugin_name_register_widgets() {
	register_widget( 'Namespace_Plugin_Name_Widget' );
}

add_action( 'widgets_init', 'namespace_plugin_name_register_widgets' );


//if a json is needed
function namespace_plugin_name_get_json( $somevariable ) {
	//$somevariable could be a username or other value that is need to get the correct json feed
	$json_feed_url = 'url';
	$args - array('timeout' => 120);

	$json_feed- wp_remote_get($json_feed_url, $args);


	//return the body of the json feed only and conver to something more usable - an object
	$namespace_json_stuff = json_decode( $json_feed['body']);
	return $namespace_json_stuff;
}

function namespace_plugin_name_backend_styles() {
	//add some custom css for the admin settings page
	wp_enqueue_style('namespace_plugin_name_backend_css', plugins_url('namespace-plugin-name/namespace-plugin-name.css'));

}
//add the css above to the admin_head hook
add_action('admin_head', 'namespace_plugin_name_backend_styles');

function namespace_plugin_name_frontend_scripts_styles() {
	//add some custom css for the admin settings page
	wp_enqueue_style('namespace_plugin_name_frontend_css', plugins_url('namespace-plugin-name/namespace-plugin-name.css'));
	wp_enqueue_script('namespace_plugin_name_frontend_js', plugins_url('namespace-plugin-name/namespace-plugin-name.js'), array('jquery'), '', true);

}
//add the css above to the admin_head hook
add_action('wp_enqueue_scripts', 'namespace_plugin_name_frontend_scripts_styles');

?>
