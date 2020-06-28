<?php  

	/**
	 *  Data recovare management
	 */

	function old($name) {
		// Data receive
		if ( isset($_POST[$name]) ) {

			echo $_POST[$name];

		}
	}


	/**
	 * Function management
	 */
	function fileUpload($files, $location = '', $format =  ['jpg','png','gif','jpeg']){

		$photo_name = $files['name'];
		$photo_tmp_name = $files['tmp_name'];

		// Get file name extension
		$file_array = explode('.', $photo_name);
		$extn = strtolower(end($file_array));

		// Unique file name
		$ufile = md5(time().rand()).'.'.$extn;

		// validation
		if ( in_array($extn, $format) ) {
			// Upload file
			move_uploaded_file($photo_tmp_name, $location. $ufile);
			$status = 'yes';
		}else{
			$status = 'No';

		}

		return [
			
			'file_name' => $ufile,
			'status' => $status
			
		];

	}

	/**
	 *  unique data management
	 */
	function unique($conn, $table, $col, $data){

		$sql = "SELECT $col FROM $table WHERE $col='$data'";
		$data = $conn -> query($sql);
		$row = $data -> num_rows;

		if ( $row > 0 ) {
			return false;
		} else {
			return true;
		}
		

	}

	/**
	 *  success message function
	 */

	function setMSG($sms){

		setcookie('sms', $sms, time()+10 );

	}

	function getMSG(){

		if ( isset($_COOKIE['sms']) ) {
			
			echo "<p class='alert alert-success'>" . $_COOKIE['sms'] . "<button class='close' data-dismiss='alert'>&times;</button></p>";

		}

	}


	

