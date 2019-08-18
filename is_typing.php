<?php
error_reporting(0);

//MySQL DB settings
include_once('config.inc.php');

$res = mysql_query("SELECT typing_ornot FROM ".$sql_table_typing." WHERE typing_from='".$_POST['partner_id']."' AND typing_to='".$_POST['own_id']."' AND typing_ornot='1'");
if(mysql_num_rows($res) > 0){
	print '1';
}else{
	print '0';
}


?>