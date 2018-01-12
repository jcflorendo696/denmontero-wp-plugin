<div class="wrap">

	<h2>Den Montero Events & Shoots</h2>

	<form name="myform" method="post" action="">
	<table class="wp-list-table widefat clients_table" id="dm-client-table">
		<tr>				
			<th><h3><input type='checkbox'/></h3></th>
			<th><h3>Event</h3></th>
			<th><h3>Event Date</h3></th>
			<th><h3>Client Name</h3></th>
			<th><h3>Date Inquired</h3></th>
			<th><h3>Actions</h3></th>
		</tr>
		<?php

		global $wpdb;



		/*	Pagination
		--------------*/

		/*	Get Current Page 
		--------------------*/	

		if( $_GET["pahina"] == ""){
			$currentpage = 1;
		}else{
			$currentpage = $_GET["pahina"];
		}
		



		if( $currentpage == "" || $currentpage == 1 ){
			$limiter = 0;
		}else{
			$limiter = ( $currentpage * 5 ) - 5; 	
		}

		/*	Get Number of Rows ( COUNT )
		-------------------------------*/
		$rows = $wpdb->get_results(
			"
				SELECT COUNT(id) AS rowcount
				FROM wp_dm_clients
			"
			);




		foreach ($rows as $row) {

			//	Get and Store Total Rows
			$rowcount = $row->rowcount;
			$total_items = $row->rowcount;

		}

		//	Divide the total number of rows to the number of rows to be shown per page.
		//	If decimal, go for ceil to round off
		$rowcount = ceil( $rowcount / 5 );

		echo "<div class='italicize'>Total Items: <strong>" . $total_items . "</strong></div>";

		echo "<div class='tablenav-pages top-navigation'>
				<span>" . $rowcount . " items</span>
				<span class='pagination-links'>";
		for ($pages = 1; $pages <= $rowcount; $pages++){ 
			echo "<a href='" . $_SERVER['PHP_SELF'] . "?page=events-and-shoots&pahina=" . $pages . "' class='pagebuttons'>". $pages . "</a>";
		}

		echo "</span></div>";




		/*	Select preview information for Clients
		------------------------------------------*/
		$jc_list = $wpdb->get_results(
					"
					SELECT wp_dm_clients.id, wp_dm_client_details.type_of_event,wp_dm_clients.name, wp_dm_clients.email, wp_dm_client_details.event_date,
					CONVERT_TZ(wp_dm_clients.date_inquired, '-5:00', '+08:00') as required_datetime 
					FROM wp_dm_clients
					INNER JOIN wp_dm_client_details
					ON wp_dm_clients.id=wp_dm_client_details.client_id
					ORDER BY wp_dm_clients.date_inquired DESC
					LIMIT $limiter,5
					"
					
				);




		/*	Create the rows with buttons
		---------------------------------*/
		foreach ( $jc_list as $list ) {

			$time = strtotime($list->required_datetime);
			$formatted = date("F j, Y, g:i a",$time);
			echo "<tr class=''>
					<th><input type='checkbox' name='check" . $list->id . "'/></th>
					<td>" . $list->type_of_event . "</td>
					<td style='font-weight: bold; color: #ff1010;'>" . $list->event_date . "</td>
					<td>" . $list->name . "</td>
					<td>" . $formatted . "</td>
					<td> 
						<input type='submit' class='button-secondary' value='View Event Details' name='view" . $list->id . "'/>
						<input type='submit' class='button-primary deleteBTN' value='Delete Event' name='delete" . $list->id . "'/>
					</td>
				  </tr>
					";

		}


		?>
	</table>
	</form>
	
	<div class="tablenav bottom alignment italicize">
		<?php

		echo "Page No: <strong>" . $currentpage  . "</strong> of " . $rowcount ;

		?>
	</div>
	




	<?php

	/*	Load Classes
	------------------------------*/
	require_once('class_database.php');


	/*	Load Controller
	------------------------------*/
	require_once('controller.php');

	?>



</div>

