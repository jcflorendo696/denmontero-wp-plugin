<?php
/*
	
	Class Name:		DBManip
	Description:	Handles all the functions that relates with the databases created with the plugin
	Methods:
		insertData();
*/

	class DBManip{

		public $c_details = array();

		public function insertData( $tables, $table_fields ){



			/*	Declare to interact with WordpressDB
			------------------------------------------*/
			global $wpdb;

			
			$c_details = array(
					$table_fields["name"]	=>	$this->client_name,
					$table_fields["email"]	=>	$this->client_email,
				);
			


			
			
				

			try {

				//	Query to Client Personal Details
				$wpdb->insert( 
					$tables["client_personal_details"],
					$c_details
					);		


				//	Get Foreign Key
				$foreignKey_query = $wpdb->get_results("SELECT id FROM wp_dm_clients WHERE email = '$this->client_email'", OBJECT);
				
				
				foreach ($foreignKey_query as $getForeignKey) {
					$foreignkey = $getForeignKey->id . "<br/>";

				}
				
				
				//	Client Event Details
				$c_orders = array(
					$table_fields["event_date"]				=>	$this->event_date,
					$table_fields["type_of_event"]			=>	$this->type_of_event,
					$table_fields["pre_event_session"]		=>	$this->pre_event_session,
					$table_fields["no_of_photog"]			=>	$this->no_of_photographers,
					$table_fields["has_slideshow"]			=>	$this->photo_slideshow,
					$table_fields["has_onsite_slideshow"]	=>	$this->on_site_slideshow,
					$table_fields["loose_prints"]			=>	$this->loose_prints,
					$table_fields["output"]					=>	$this->output_medium,
					$table_fields["client_id"]				=>	$foreignkey,
					$table_fields["video_package"]			=>	$this->package,
				);


				//	Query to Client Event Details
				$wpdb->insert(
					$tables["client_event_details"],
					$c_orders
					);
				

				//	Client Album Details
				$c_albums = array(
					$table_fields["size"]			=>	$this->album_size,
					$table_fields["no_of_albums"]	=>	$this->no_of_albums,
					$table_fields["no_of_pages"]	=>	$this->album_pages,
					$table_fields["client_id"]		=>	$foreignkey,
				);


				//	Query to Albums
				$wpdb->insert(
					$tables["client_albums"],
					$c_albums
					);

				
				//	Client PhotoFrames Details
				$c_frames	=	array(
					$table_fields["frame_size"]		=>	$this->framesize,
					$table_fields["no_of_frames"]	=>	$this->no_of_frames,
					$table_fields["client_id"]		=>	$foreignkey
				);
				
				//	Query to Frames
				$wpdb->insert(
					$tables["client_frames"],
					$c_frames
					);

				
				
				// Transfer to a new array to become readable
				$add_ons = array(
						"onsite_sde"		=>	$this->addons[0],
						"aerial_vid"		=>	$this->addons[1],
						"save_the_date"		=>	$this->addons[2],
						"raw_footages"		=>	$this->addons[3],
						"mtv_style_editing"	=>	$this->addons[4]

					);

				//	Client Addons Details
				
				$c_addons 	=	array(
					$table_fields["SDE"]					=>	$add_ons["onsite_sde"],
					$table_fields["aerial_videography"]		=>	$add_ons["aerial_vid"],
					$table_fields["wedding_video_teaser"]	=>	$add_ons["save_the_date"],
					$table_fields["raw_footages"]			=>	$add_ons["raw_footages"],
					$table_fields["mtv_style_editing"]		=>	$add_ons["mtv_style_editing"],
					$table_fields["client_id"]				=>	$foreignkey
				);
				


				//	Query to Addons
				$wpdb->insert(
					$tables["client_addons"],
					$c_addons
					);
				
				

			} catch (Exception $e) {
				echo "Caught exception " . $e->getMessage();
			}
			


		}


		public function selectData($id){

			global $wpdb;

			$details = $wpdb->get_results(
					"
					SELECT wp_dm_clients.name, 
							wp_dm_clients.email, 
							wp_dm_client_details.event_date,
							wp_dm_client_details.type_of_event, 
							wp_dm_client_details.pre_event_session,
							wp_dm_client_details.no_of_photog,
							wp_dm_client_details.has_slideshow,
							wp_dm_client_details.has_onsite_slideshow,
							wp_dm_client_details.loose_prints,
							wp_dm_client_details.video_package,
							wp_dm_client_details.output,
							wp_dm_client_frames.frame_size,
							wp_dm_client_frames.no_of_frames,
							wp_dm_client_albums.size,
							wp_dm_client_albums.no_of_pages,
							wp_dm_client_albums.no_of_albums,
							wp_dm_client_addons.SDE,
							wp_dm_client_addons.aerial_videography,
							wp_dm_client_addons.wedding_video_teaser,
							wp_dm_client_addons.raw_footages,
							wp_dm_client_addons.mtv_style_editing
					FROM wp_dm_clients
						INNER JOIN wp_dm_client_details
							ON wp_dm_clients.id = wp_dm_client_details.client_id
						INNER JOIN wp_dm_client_frames
							ON wp_dm_clients.id = wp_dm_client_frames.client_id
						INNER JOIN wp_dm_client_albums
							ON wp_dm_clients.id = wp_dm_client_albums.client_id
						INNER JOIN wp_dm_client_addons
							ON wp_dm_clients.id = wp_dm_client_addons.client_id
					WHERE wp_dm_clients.id = '$id'
					LIMIT 1
					"
				);

			
			return $details;

		}



		public function deleteData($clientid){

			global $wpdb;

			$deleterow = $wpdb->delete(
					"wp_dm_clients",
					array( "id" => $clientid)
				);
			
		}


	}//class DBManip END

?>