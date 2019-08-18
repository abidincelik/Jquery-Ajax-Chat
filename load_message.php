<?php
error_reporting(0);

//MySQL DB settings
include_once('config.inc.php');


	$sent_time = time() - $hide_old_messages_tstamp;

	//check if partner is offline, print it on the end
	$check_offline = mysql_query("SELECT chat_status FROM ".$sql_table_users." WHERE id='".$_POST['partner_id']."' AND chat_status='offline' AND UNIX_TIMESTAMP(NOW()) > offlineshift;");
	if(mysql_num_rows($check_offline) > 0){
		$print_offline = '<p><span class="error">User is offline!</span></p>';
	}


	//set is typing record
	if(isset($_POST['is_typing'])){	
		$query = mysql_query("SELECT * FROM ".$sql_table_typing." WHERE typing_from = '".$_POST['own_id']."' AND typing_to = '".$_POST['partner_id']."'");
		$result = mysql_fetch_assoc($query);
		$num = mysql_num_rows($query);
		if($num) {
		//update
			mysql_query("UPDATE ".$sql_table_typing." SET typing_ornot = '".$_POST['is_typing']."' WHERE typing_from='".$_POST['own_id']."' AND typing_to = '".$_POST['partner_id']."'");
		} else {
		//insert
			mysql_query("INSERT INTO ".$sql_table_typing." (`typing_from`, `typing_to`, `typing_ornot`) VALUES ('".$_POST['own_id']."', '".$_POST['partner_id']."', '".$_POST['is_typing']."')");
		}
	}


	//check if current user has unreceived messages which are older than limit, if yes, display it with date
	$check_unreceived = mysql_query("SELECT * FROM ".$sql_table_chat." WHERE from_id='".$_POST['partner_id']."' AND to_id='".$_POST['own_id']."' AND sent < '".$sent_time."' AND recd='0' ORDER BY id");
	if(mysql_num_rows($check_unreceived) > 0){
		while($check_ur_row = mysql_fetch_assoc($check_unreceived)){
		//there is/are an unreceived message(s)
			//mark message(s) received and update their received times
			mysql_query("UPDATE ".$sql_table_chat." SET recd='1',sent='".time()."' WHERE id='".$check_ur_row['id']."' AND recd='0'");
		}
	
		//insert info message as system into current chat
		mysql_query("INSERT INTO ".$sql_table_chat." (from_id,to_id,message,sent,system_message) VALUES('".$_POST['partner_id']."','".$_POST['own_id']."','These are unreceived messages from the previous chat session!','".time()."','yes')");
	}

	//load messages
	$res = mysql_query("SELECT * FROM ".$sql_table_chat." WHERE (from_id='".$_POST['own_id']."' AND to_id='".$_POST['partner_id']."' AND sent > '".$sent_time."') OR (from_id='".$_POST['partner_id']."' AND to_id='".$_POST['own_id']."' AND sent > '".$sent_time."') ORDER BY sent");
	if(mysql_num_rows($res) > 0){
		while($row = mysql_fetch_assoc($res)){
			//load message, get username of id
			krsort($smileys);
			if(!empty($smileys)){
				foreach($smileys as $k => $v){
					$row['message'] = str_replace($k,'<img src="'.$v.'" />',$row['message']);
				}
			}
			
			//place links if allowed
			if($display_links == 'yes'){
				preg_match('/(http:\/\/[^\s]+)/', $row['message'], $text);
				$hypertext = '<a href="' . $text[0] . '" target="_blank">' . $text[0] . '</a>';
				$row['message'] = preg_replace('/(http:\/\/[^\s]+)/', $hypertext, $row['message']);
			}
			
			
			//print messages
			if($row['system_message'] != 'no'){				
				//message from system				
					print '<p class="system">'.$row['message'].'</p>';									
			}elseif($row['from_id'] != $_POST['own_id']){
				$res2 = mysql_query("SELECT username FROM ".$sql_table_users." WHERE id='".$row['from_id']."'");
				$row2 = mysql_fetch_assoc($res2);
				print '<p><b>'.$row2['username'].':</b> '.$row['message'].'</p>';
			}else{
				print '<p class="me"><b>Me:</b> '.$row['message'].'</p>';
			}
			
			
			//if to_id = current user, mark message as received
			if($row['to_id'] == $_POST['own_id']){
				mysql_query("UPDATE ".$sql_table_chat." SET recd='1' WHERE id='".$row['id']."' AND recd='0'");
			}		
			
			$last_msg = $row['sent'];
		}	
		
		//print last message time if older than 2 mins
		$math = time() - $last_msg;
		if($math > 120){
			print '<p class="system">Last message sent at '.date('H:i').'</p>';
		}
		
		print $print_offline;
		
	}else{

		print ' ';		

		
		print $print_offline;
	}
	

?>