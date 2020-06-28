<?php 


	require_once 'apps/db.php';
	require_once 'apps/function.php';

	//session start
	session_start();

	// Get url
	$id = $_GET['id'];

	// Logout System
	if ( isset( $_GET['id'] ) AND $_GET['id'] == $id ) {
		
		// Session destroy
		session_destroy();

		// cookie setup
		setcookie('relog', '', time() - (60*60*24*365*10));

		
	}


	// query delete data
	$sql = "DELETE FROM users WHERE id='$id'";
	$connection -> query($sql);

	// Redirect user profile
	header("location:login.php");
