<?php
	
	
	/*
	*
	*	Submit Button of Questionnaire Form ( http://www.denmontero.com/questionnaire )
	*	
	*/
	if( isset($_POST["btnSubmit"]) ){

		global $wpdb;


		/*	Create a Client Instance
		-----------------------------*/
		$new_client = new Client();



		/*	Get Data from Questionnaire Form
		--------------------------------------*/
		$videopackage = $_GET['p'];
		$new_client->getData($_POST, $videopackage);


		

		/*	Show Data for Debugging
		--------------------------------------*/
		//echo $new_client->showData();
		//echo "<br/>";



		/*	Send Mail to jc.florendo696@gmail.com
		------------------------------------------*/
		$send_confirmation = new DM_Mail();
		$send_confirmation->setData();
		$send_confirmation->createMail();


		
		/*	Table Names Array
		-------------------------*/
		$client_tables = array(
			"client_personal_details" => $wpdb->prefix . "dm_clients",
			"client_event_details" => $wpdb->prefix . "dm_client_details",
			"client_albums" => $wpdb->prefix . "dm_client_albums",
			"client_frames" => $wpdb->prefix . "dm_client_frames",
			"client_addons" => $wpdb->prefix . "dm_client_addons"
			);



		/*  Table Column Names Array 
		-----------------------------*/
		$client_table_fields = array(
			"id" => "id",
	 		"name" => "name",
			"email" => "email",
			"date_inquired" => "date_inquired",
			"client_id" => "client_id",
			"event_date" => "event_date",
			"type_of_event" => "type_of_event",
			"pre_event_session" => "pre_event_session",
			"no_of_photog" => "no_of_photog",
			"has_slideshow" => "has_slideshow",
			"has_onsite_slideshow" => "has_onsite_slideshow",
			"loose_prints" => "loose_prints",
			"output" => "output",
			"video_package"	=> "video_package",
			"size" => "size",
			"no_of_pages" => "no_of_pages",
			"no_of_albums" => "no_of_albums",
			"frame_size" => "frame_size",
			"no_of_frames" => "no_of_frames",
			"SDE" => "SDE",
			"aerial_videography" => "aerial_videography",
			"wedding_video_teaser" => "wedding_video_teaser",
			"raw_footages"	=>	"raw_footages",
			"mtv_style_editing"	=>	"mtv_style_editing"
			);
		


		/*	Pass Data for Validation and then Insertion
		------------------------------------------------*/
		$new_client->insertData($client_tables , $client_table_fields);
		$successurl = "http://denmontero.com/success";
		
		

		

	}



	/******************************
	*
	*	Backend Dashboard Scripts
	*
	*******************************/
	global $wpdb;

	//	Get all values in ID column to loop with
	$id_list = $wpdb->get_col("SELECT id FROM wp_dm_clients");

	//	The Loop to know which button is pressed.
	foreach ($id_list as $value) {



		/*	DELETE BUTTON
		----------------------*/
		if($_POST['delete' . $value]){

			$client_exists = new DBManip;


			/*
			*	Delete Selected Row
			-------------------------*/
			$client_exists->deleteData($value);



		}


		/*	This is where it detects which View Button is clicked. With the $value id 
		-----------------------------------------------------------*/
		if($_POST['view' . $value]){

			$test = new DBManip();
			
			/*	SELECT Data from ALL tables. Passing the $value(id) of the client as WHERE. To be used as the WHERE in the SELECT statement
			-------------------*/
			$details = $test->selectData($value);

			
			/*	Loop Through Each Column Rows
			-------------------*/
			foreach ($details as $dm_value) {
				/*
				 $dm_value->name 
				 $dm_value->email 
				 $dm_value->type_of_event 
				 $dm_value->pre_event_session 
				 $dm_value->no_of_photog 
				 $dm_value->event_date
				 $dm_value->has_slideshow 
				 $dm_value->has_onsite_slideshow 
				 $dm_value->loose_prints 
				 $dm_value->output 
				 $dm_value->frame_size 
				 $dm_value->no_of_frames 
				 $dm_value->size 
				 $dm_value->no_of_pages 
				 $dm_value->no_of_albums 
				 $dm_value->SDE 
				 $dm_value->aerial_videography 
				 $dm_value->wedding_video_teaser 
				 $dm_value->raw_footages 
				 $dm_value->mtv_style_editing 
				 $dm_value->video_package
				*/

				/*	I don't know how to pass values from controller to view in plain PHP OOP. Damn Wordpress.
				---------------------*/
				require_once('view_event_details.php');
				
			}
		}

	}







?>