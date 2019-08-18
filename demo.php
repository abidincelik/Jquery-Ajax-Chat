<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

//MySQL DB settings
include_once('config.inc.php');

//current user
$_SESSION['username'] = 'John';
$_SESSION['user_id'] = '1';

$rndnumber = mt_rand(1000, 9999);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title><?php print $_SESSION['username']; ?></title>	
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<meta charset="utf-8">
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="Cache-Control" content="no-cache">
	
	<link href="css/reset.css" rel="stylesheet" type="text/css" />		
	<link href="css/chat.css" rel="stylesheet" type="text/css" />		
	
	<script type="text/javascript" src="js/jquery-2.1.1.min.js?<?php echo $rndnumber; ?>"></script>	
	<script type="text/javascript" src="js/jquery.ajax_chat.js?<?php echo $rndnumber; ?>"></script>
	<script type="text/javascript" src="own_id.inc.php"></script>

	
</head>
<body>
	<!-- DISPLAY MESSAGE IF JAVA IS TURNED OFF -->
	<noscript>		
		<div id="notification">You need to turn on javascript in your browser to use this chat!</div>
	</noscript>

<div id="wrapper">
	<h1>jQuery AJAX Chat - Like on Facebook or Gmail</h1>
	
	<p>
		Click on a name below to begin a conversation!<br /><br />
		
		<b>For the record:</b> You're <b><?php print $_SESSION['username']; ?></b> in this demo! <br /><br />
		
		Open <a href="demo2.php">demo2.php</a> <i>(Elizabeth)</i> or <a href="demo3.php">demo3.php</a> <i>(Joseph)</i> or <a href="demo4.php">demo4.php</a> <i>(Martin)</i> in a different browser to type yourself back!
		
		<br /><br />
		
		<?php
		//load users from database
		$query = "SELECT id,username FROM ".$sql_table_users." WHERE id!='".$_SESSION['user_id']."'";
		$users = mysql_query($query);
		if(mysql_num_rows($users) > 0){
			while($user = mysql_fetch_assoc($users)){
				//ALT tag contains user ID and user name 
				print '&bull; <a href="#" alt="'.$user['id'].'|'.$user['username'].'" class="chat_user">'.$user['username'].'</a><br />';
			}
		}
		?>
	</p>
</div>
<div id="player_div"></div>
<!-- reopen old opened chatboxes with the last state-->
<?php if (isset($_SESSION['chatbox_status'])) {
	print '<script type="text/javascript">';
	print '$(function() {';
	foreach ($_SESSION['chatbox_status'] as $openedchatbox) {
		print 'PopupChat('.$openedchatbox['partner_id'].',"'.$openedchatbox['partner_username'].'",'.$openedchatbox['chatbox_status'].');';
	}
	print "});";
	print '</script>';
	}
?>
</body>
</html>