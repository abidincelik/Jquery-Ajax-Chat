<?php
error_reporting(0);

//MySQL DB settings
include_once('config.inc.php');

$sent_time = time() - $hide_old_messages_tstamp;


//check if there is an unreceived message for current user
$res = mysql_query("SELECT * FROM ".$sql_table_chat." WHERE to_id='".$_POST['own_id']."' AND recd='0' GROUP BY from_id LIMIT 0,1");
if(mysql_num_rows($res) > 0){
	$row = mysql_fetch_assoc($res);
		
	//return user id and username
	$res2 = mysql_query("SELECT username FROM ".$sql_table_users." WHERE id='".$row['from_id']."'");
	$row2 = mysql_fetch_assoc($res2);		
	
	print $row['from_id'].';;;'.$row2['username'];

}else{
	print '0';
}
?>