<?php 
	session_start();
	include_once '../core/core.function.php';
	include_once '../core/contestants.class.php';

	echo add_contestant();
	function add_contestant(){
		$contestant_obj = new contestants();

		$id = $_GET['c'];
		
		
		if ($contestant_obj->update_contestant_status(0,$id)) {
			header('location: disqualified-contestants');
		}
		else{
			return displayError('Unable to update');
		}
	}
?>