jQuery(document).ready(function( $ ){


	/**
	*	Pre Event Session Checkbox
	*/
	$('#chkPreEventSession').change(function(){

		if(this.checked){
			$("#pre-event").prop('disabled', false);
			$("#pre-event").fadeIn('fast');
		}else{
			$("#pre-event").prop('disabled', true);
			$("#pre-event").fadeOut('fast');
		}

	});

	/**
	*	Hide Pre Event Session DropDown Initially
	*/
	$("#pre-event").hide();

	/**
	*	Set Default Packages to show initially
	*/
	if ( $("#typeOfEvent").val() == "Debut / Wedding"){
			$("#1cam_setup").hide();
			$("#2cam_setup").hide();
			$("#package_bronze").show();
			$("#package_silver").show();
	}

	/**
	*	Dynamic Packages depends on Type Of Event chosen
	*/
	$("#typeOfEvent").change(function(){
		var typeOfEvent = $("#typeOfEvent").val();

		if( typeOfEvent == "Debut / Wedding"){
			$("#1cam_setup").hide();
			$("#2cam_setup").hide();
			$("#package_bronze").show();
			$("#package_silver").show();
			$("#package_gold").show();
			$("#package_platinum").show();

		}else if( typeOfEvent == "Birthday / Event"){
			$("#1cam_setup").show();
			$("#2cam_setup").show();
			$("#package_bronze").hide();
			$("#package_silver").hide();
			$("#package_gold").hide();
			$("#package_platinum").hide();
		}
	});

	/**
	*	Frame Size Number Limit to numbers only no letters
	*/
	$("#FrameSizeNumber, #NumberOfAlbums").keyup(function(){

		$( this ).val(this.value.match(/[0-9]*/));

		if( $("#NumberOfAlbums").val() > 10 ){
			$("#NumberOfAlbums").val("10");
		}

		if( $("#FrameSizeNumber").val() > 10){
			$("#FrameSizeNumber").val("10");	
		}

	});




	/**
	*	Package Click
	*/
	$(".package-wrap").click(function(){
		
		
		//	Store video package in var
		var	videopackage = $(this).attr("data-package")
		
		//Update page URL with the package chosen by the visitor
		window.history.pushState("videopackage", "Title", "/questionnaire/?p=" + videopackage);

		//	Update UI as necessary to inform user of change in package
		$("#1cam_container, #2cam_container, #bronze_container, #silver_container, #gold_container, #platinum_container").css("background-color","#FEF0B9");
		$(this).css("background-color","#A6F2CB");
		


	});



	/**
	*	Attach Datepicker to Textfield
	*/
	$("#jc_event_datepicker").datepicker({
		minDate: 0,
		dateFormat: "mm/dd/yy",
		showAnim: "drop",
		changeMonth: true,
		changeYear: true
	});


	/**
	*	Hide number of frames field when size is NONE
	*/
	$("#FrameSizeNumber").hide();

	$("#framesize").change(function(){
		var framesize = $("#framesize").val();

		if( framesize == "None" ){
			$("#FrameSizeNumber").prop("disabled", true);
			$("#FrameSizeNumber").hide();
		}

		if( framesize == "8 x 10" || framesize == "11 x 14" || framesize == "12 x 16"){
			$("#FrameSizeNumber").prop("disabled", false);
			$("#FrameSizeNumber").fadeIn();
		}

	})

	/**
	*	Hide Number of pages and number of albums when SIZE = NONE
	*/
	$(".albumpages").hide();
	$(".NumberOfAlbums").hide();

	$("#albumsize").change(function(){
		var albumsize = $("#albumsize").val();
		
		if ( albumsize == "None" ){
			$(".albumpages").prop("disabled", true);
			$(".NumberOfAlbums").prop("disabled", true);
			$(".albumpages").hide();
			$(".NumberOfAlbums").hide();			
		}

		if ( albumsize == "5 x 8" || albumsize == "6 x 6" || albumsize == "8 x 8" || albumsize == "8 x 10" || albumsize == "10 x 10"){
			$(".albumpages").prop("disabled", false);
			$(".NumberOfAlbums").prop("disabled", false);
			$(".albumpages").fadeIn();
			$(".NumberOfAlbums").fadeIn();
		}


	})





	$("#btnSubmit").click(function(){
		//event.preventDefault();
	});





	/*-----------------------------------------
	*	Den Montero Backend Dashboard JS
	--------------------------------------*/
	function deleteRow(){
		var ask = confirm("Are you sure you want to delete this row?");

		if ( ask == true ){
			alert('row delete');
		}else{
			alert('you pressed cancel');
		}
	}

	
	$(".deleteBTN").click(function(){
		deleteRow();
	});
	


});


