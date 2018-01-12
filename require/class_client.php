<?php
/*

	Class Name:		Client 
	Description:	Creates all the properties of a new client. Also, it gets all the information from the questionnaire form.
					As of beta testing, this class includes method showData() to see if the form gets all the required information.

	Methods:
			getData();
			showData();

*/


	
	class Client extends DBManip{

		public $client_name;
		public $client_email;
		public $type_of_event;
		public $pre_event_session;
		public $event_date;

		//Photographers
		public $no_of_photographers;

		//Slideshow
		public $photo_slideshow;
		public $on_site_slideshow;

		//Albums
		public $album_size;
		public $album_pages;
		public $no_of_albums;

		//Prints Department
		public $loose_prints;

		//Frame
		public $framesize;
		public $no_of_frames;

		//Output
		public $output_medium;

		//Video
		public $package;
		public $addons = array();


		public function clean($string) {
		   
		   return preg_replace('/[^A-Z a-z\-]/', '', $string); // Removes special chars.
		}

		public function getData($formdata, $videopackage){

			//	Validate User Name
			$this->client_name = $this->clean(filter_var($formdata['clientName'], FILTER_SANITIZE_STRING));	
			
			//	Validate User Email
			if( is_email($formdata['clientEmail']) ){
				$this->client_email = $formdata['clientEmail'];	
			}
			
			//$this->client_email = $formdata['clientEmail'];

			$this->event_date = $formdata['event_date'];
			$this->type_of_event = $formdata['type_of_event'];
			$this->pre_event_session = $formdata['pre_event_session'];

			$this->no_of_photographers = $formdata["no_of_photographers"];
			$this->photo_slideshow = $formdata["photoslideshow"];
			$this->on_site_slideshow = $formdata["on_site_slideshow"];

			$this->album_size = $formdata["album_size"];
			$this->album_pages = $formdata["album_pages"];
			$this->no_of_albums = $formdata["num_of_albums"];

			$this->loose_prints = $formdata["loose_prints"];

			$this->framesize = $formdata["framesize"];
			$this->no_of_frames = $formdata["num_of_frames"];

			$this->output_medium = $formdata["output"];

			$this->package = $videopackage;

			$this->addons = $formdata["add_ons"];

		}

		public function showData(){

			global $wpdb;

			$result = $this->client_name . "<br/>" . $this->client_email . "<br/>" . $this->type_of_event . "<br/>" . $this->pre_event_session;

			$result .= "<br/>" . $this->no_of_photographers;
			$result .= "<br/>" . $this->photo_slideshow;
			$result .= "<br/>" . $this->on_site_slideshow;

			$result .= "<br/>" . $this->album_size;
			$result .= "<br/>" . $this->album_pages;
			$result .= "<br/>" . $this->no_of_albums;

			$result .= "<br/>" . $this->loose_prints;

			$result .= "<br/>" . $this->framesize;
			$result .= "<br/>" . $this->no_of_frames;

			$result .= "<br/>" . $this->package;
			$result .= "<br/>" . $this->output_medium;



			return $result;	
		}


	}//	Class Client END

	
	


	

?>