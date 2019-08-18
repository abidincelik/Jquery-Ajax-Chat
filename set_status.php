<?php
error_reporting(0);
session_start();
//MySQL DB settings
include_once('config.inc.php');

if(isset($_POST['status'])){
	if($_POST['status'] == 'online'){
		$chat_status = 'online';
		$offlineshift = 0; 
	}else{
		$chat_status = 'offline';
		$offlineshift = time() + 10; // partners waiting 10 second to have offline message
	}								 // if user reload page , automatically go offline state
									 // after page reload go online again
	mysql_query("UPDATE ".$sql_table_users." SET chat_status='".$chat_status."', offlineshift='".$offlineshift."' WHERE id='".$_POST['own_id']."'");
} else
if (isset($_POST['chatbox_status'])) {
	$_SESSION['chatbox_status'] = $_POST['chatbox_status'];
} else unset($_SESSION['chatbox_status']);

?>