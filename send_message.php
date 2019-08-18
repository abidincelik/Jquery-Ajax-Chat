<?php
error_reporting(0);

//MySQL DB settings
include_once('config.inc.php');


//check if selected user is online
$check_status = mysql_query("SELECT * FROM ".$sql_table_users." WHERE id='".$_POST['to_id']."' AND chat_status='online'");
if(mysql_num_rows($check_status) > 0){

	//insert message into chat table
	$query = sprintf("INSERT INTO ".$sql_table_chat." (from_id,to_id,message,sent) VALUES('".$_POST['from_id']."','".$_POST['to_id']."','%s','".time()."')",mysql_real_escape_string(strip_tags($_POST['message'])));

	if(mysql_query($query)){
		print '1';
	}else{
		print mysql_error();
	}

}	

?>