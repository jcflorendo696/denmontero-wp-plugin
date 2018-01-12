<?php

				echo "
					<h3>Event Details</h3>
					<table class='width_50 widefat'>
						<tr>	
							<td class='bold'>Event:</td>
							<td>" . $dm_value->type_of_event . "</td>
							<td class='bold'>Client:</td>
							<td>" . $dm_value->name . "</td>
						</tr>	

						<tr>
							<td class='bold'>Event Date:</td>
							<td style='color: #ff1010;'>" . $dm_value->event_date . "</td>
							<td class='bold'>Email:</td>
							<td>" . $dm_value->email . "</td>
						</tr>

						<tr>
							<td class='bold'>Pre-Event Session:</td>
							<td>" . $dm_value->pre_event_session . "</td>
						</tr>
					</table>";

				echo "

					<table class='width_50 widefat'>

						<tr class='alternate'>
							<th colspan='1'><h4>PHOTOGRAPHERS</h4></th>
						</tr>


						<tr>
							<td class='bold'>Photographers:</td>
							<td>" . $dm_value->no_of_photog . "</td>
							<td></td>
							<td></td>
						</tr>

						<tr class='alternate'>
							<th colspan='1'><h4>SLIDESHOWS</h4></th>
						</tr>


						<tr>
							<td class='bold'>Slideshow:</td>
							<td>" . $dm_value->has_slideshow . "</td>
							<td class='bold'>Onsite - Photo Slideshow</td>
							<td>" . $dm_value->has_onsite_slideshow . "</td>
						</tr>

						<tr class='alternate'>
							<th colspan='1'><h4>ALBUMS</h4></th>
						</tr>
						<tr>
							<td class='bold'>Album Size:</td>
							<td>" . $dm_value->size . "</td>
							<td class='bold'>No. of Pages:</td>
							<td>" . $dm_value->no_of_pages . "</td>
						</tr>

						<tr>
							<td class='bold'>No. of Albums:</td>
							<td>" . $dm_value->no_of_albums . "</td>
						</tr>

						<tr class='alternate'>
							<th colspan='1'><h4>PRINTS</h4></th>
						</tr>

						<tr>
							<td class='bold'>Loose Prints:</td>
							<td>" . $dm_value->loose_prints . "</td>
						</tr>

						<tr class='alternate'>
							<th colspan='1' ><h4>FRAMES</h4></th>
						</tr>

						<tr>
							<td class='bold'>Frame Size:</td>
							<td>" . $dm_value->frame_size . "</td>
							<td class='bold'>No. of Frames:</td>
							<td>" . $dm_value->no_of_frames . "</td>
						</tr>

						<tr class='alternate'>
							<th colspan='1'><h4>VIDEO PACKAGE</h4></th>
						</tr>

						<tr>
							<td>" . $dm_value->video_package . "</td>
						</tr>

						<tr class='alternate'>
							<th colspan='1'><h4>ADD-ONS</h4></th>
						</tr>

						<tr>
							<td>" . $dm_value->SDE . "</td>
							<td>" . $dm_value->aerial_videography . "</td>
							<td>" . $dm_value->wedding_video_teaser . "</td>
							<td>" . $dm_value->raw_footages . "</td>
							<td>" . $dm_value->mtv_style_editing . "</td>
						</tr>
						
							
					</table>

				";


				?>