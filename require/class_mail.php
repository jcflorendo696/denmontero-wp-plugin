<?php
/*
	Class Name:		Mail
	Description:	Module that will handle the sending of emails to Den Montero after visitor has filled up the questionnaire.
	
*/


	class DM_Mail extends DBManip{

		private $to = array();
		private $subject;
		private $message;
		private $headers = array();
		private $attachments;

		public function setData(){

			
			$this->to = array(
					"jc.florendo696@gmail.com"
					//"denmontero.photography@gmail.com"
				);

			$this->subject 	= "New Photography Inquiry";

			/*	Email Header
			------------------*/
			
			$this->headers 	=array(
					"From: DM Questionnaire",
					"Content-Type: text/html; charset=UTF-8"
				);

			/*	Email Body
			------------------*/
			$this->message  = "<html><body>";
			$this->message .= "<p>Dear Den,</p>";
			$this->message .= "Congratulations!
								A new prospective client has filled up your questionnaire! To view more details about her event, follow these steps:
								<br/><br/>
								1. Login your Wordpress Administrator account in your website backend.<br/>
								2. Go to 'Events & Shoots' Menu <br/>
								3. It will show the latest fill ups of the form. <br/><br/>
								";
			$this->message .= "For any questions, please contact your nearest web developer. <br/><br/>";
			$this->message .= "---";
			$this->message .= "<br/>";
			$this->message .= "<p>This message is sent from the Den Montero Questionnaire ( http://denmontero.com/questionnaire ). <br/>Please do not reply as this is automated.</p>";
			$this->message .= "</body></html>";



		}


		public function createMail(){

			/*	Send Mail
			-------------------*/
			wp_mail(
					$this->to,
					$this->subject,
					$this->message,
					$this->headers
				);

			//echo "<br/>Inquiry Sent!<br/>";

			

		}

	}


?>