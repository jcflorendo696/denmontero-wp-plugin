<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


/**
 * Plugin Name: Den Montero Questionnaire Form
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: A questionnaire for clients to answer.
 * Version: 1.0
 * Author: Jc S. Florendo
 * Author URI: www.jcflorendo.com
 */


//Show the menu in admin dashboard
add_action('admin_menu','BackendAdminPanel');

//Enqueue scripts in the frontend
add_action('wp_enqueue_scripts','EnqueueFrontEndScripts');

//Enqueue scripts in the backend
add_action('admin_enqueue_scripts','EnqueueAdminScripts');

//Create a shortcode for the form
add_shortcode('_ShowQuestionnaire','ShowQuestionnaire');

//Creating tables within Wordpress
register_activation_hook( __FILE__ , 'createClientTable');
register_activation_hook( __FILE__ , 'createClientDetailsTable');
register_activation_hook( __FILE__ , 'createClientAlbumsTable');
register_activation_hook( __FILE__ , 'createClientFramesTable');
register_activation_hook( __FILE__ , 'createClientAddonsTable');

function BackendAdminPanel(){
	add_menu_page('Den Montero Events & Shoots - Dashboard','Events & Shoots','manage_options', 'events-and-shoots' ,'BackendUI');
}


function BackendUI(){
	require ("require/denmontero-form-backend.php");
}


function EnqueueFrontEndScripts(){

	// JS
	wp_enqueue_script('jquery-ui-datepicker',  'http://code.jquery.com/ui/1.11.4/jquery-ui.js' , array('jquery') );
	wp_enqueue_script('denmontero-plugin', plugins_url('js/denmontero-plugin.js', __FILE__ ) , array('jquery') );

	//	CSS
	wp_enqueue_style('spinner-style', plugins_url('css/spinner.css' , __FILE__));
	wp_enqueue_style('datepicker-style', 'http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css');
	wp_enqueue_style('denmontero-styles', plugins_url('css/denmontero-plugin.css', __FILE__) );
}

function EnqueueAdminScripts(){
	//wp_enqueue_script('denmontero-plugin', plugins_url('js/denmontero-plugin.js', __FILE__ ) , array('jquery') );
	wp_enqueue_style('denmontero-styles-dashboard', plugins_url('css/denmontero-plugin.css', __FILE__) );
}


function ShowQuestionnaire(){
	require ('require/denmontero-form-frontend.php');
}


function createClientTable(){
	
	global $wpdb;
	global $main_table;

	$main_table = $wpdb->prefix . "dm_clients";
	$query = "CREATE TABLE $main_table (
		id INT(9) NOT NULL AUTO_INCREMENT,
		name VARCHAR(55) NOT NULL,
		email VARCHAR(55) NOT NULL,
		date_inquired TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		UNIQUE KEY id (id),
		PRIMARY KEY (id)
		
		) ENGINE = INNODB;";
	
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($query);

}


function createClientDetailsTable(){

	global $wpdb;
	global $main_table;

	$table_name = $wpdb->prefix . "dm_client_details";
	$query = "CREATE TABLE $table_name (
		id int(10) NOT NULL AUTO_INCREMENT,
		client_id int(10),
		event_date VARCHAR(225) NOT NULL,
		type_of_event VARCHAR(225) NOT NULL,
		pre_event_session VARCHAR(225) NOT NULL,
		no_of_photog int(10) NOT NULL,
		has_slideshow VARCHAR(225) NOT NULL,
		has_onsite_slideshow VARCHAR(225) NOT NULL,
		loose_prints VARCHAR(225) NOT NULL,
		video_package VARCHAR(225) NOT NULL,
		output VARCHAR(225) NOT NULL,
		PRIMARY KEY (id),
		FOREIGN KEY (client_id) REFERENCES $main_table(id) ON DELETE CASCADE
		) ENGINE = INNODB;";

		require_once ( ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($query);
}


function createClientAlbumsTable(){

	global $wpdb;
	global $main_table;

	$table_name = $wpdb->prefix . "dm_client_albums";

	$query = "CREATE TABLE $table_name (
		id int(10) NOT NULL AUTO_INCREMENT,
		client_id int(10),
		size varchar(225) NOT NULL,
		no_of_pages int(10) NOT NULL,
		no_of_albums int(10) NOT NULL,
		PRIMARY KEY (id),
		FOREIGN KEY (client_id) REFERENCES $main_table(id) ON DELETE CASCADE

		) ENGINE = INNODB;";

	require_once( ABSPATH . "wp-admin/includes/upgrade.php");
	dbDelta($query);

}


function createClientFramesTable(){

	global $wpdb;
	global $main_table;

	$table_name = $wpdb->prefix . "dm_client_frames";

	$query = "CREATE TABLE $table_name (
		id int(10) NOT NULL AUTO_INCREMENT,
		client_id int(10) NOT NULL,
		frame_size varchar(255) NOT NULL,
		no_of_frames int(10) NOT NULL,
		PRIMARY KEY (id),
		FOREIGN KEY (client_id) REFERENCES $main_table(id) ON DELETE CASCADE

		) ENGINE = INNODB;";

	require_once( ABSPATH . "wp-admin/includes/upgrade.php");
	dbDelta($query);
}


function createClientAddonsTable(){

	global $wpdb;
	global $main_table;

	$table_name = $wpdb->prefix . "dm_client_addons";

	$query = "CREATE TABLE $table_name (
		id int(10) NOT NULL AUTO_INCREMENT,
		client_id int(10) NOT NULL,
		SDE varchar(255),
		aerial_videography varchar(255),
		wedding_video_teaser varchar(255) NOT NULL,
		raw_footages varchar(255) NOT NULL,
		mtv_style_editing varchar(255) NOT NULL,
		PRIMARY KEY (id),
		FOREIGN KEY (client_id) REFERENCES $main_table(id) ON DELETE CASCADE

		) ENGINE = INNODB;";

	require_once( ABSPATH . "wp-admin/includes/upgrade.php");
	dbDelta($query);
}


?>