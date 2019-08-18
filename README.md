# jQuery AJAX Chat

[https://github.com/abidincelik/](https://github.com/abidincelik/)

[![Donatecoins](http://donatecoins.org/btc/1GEP8kqApKzwUQ5Mzi7b6g4UToWADFKpNR.svg)](http://donatecoins.org/btc/1GEP8kqApKzwUQ5Mzi7b6g4UToWADFKpNR)

This documentation assumes that you are already familiar with HTML, CSS, PHP and MySQL basics!

## How to try the demo

Copy the contents of **_the script with demo_** folder to your FTP or localhost. I'll use a local webserver example, so let's upload the files for example to [http://localhost/chat](http://localhost/chat).

Create a database in MySQL (e.g.: _demochat_) and import the included **\_mysql\jquerychat.sql** mysql dump file into your database. OR alternatively run these commands in your database:

Now open **config.inc.php** and set the first 6 parameters:

_$sql_username = 'your_mysql_username';_

_$sql_password = 'your_mysql_password';_

_$database = 'chatdemo';_

_$sql_table_chat = 'chat'; // all communication store here_

_$sql_table_users = 'users'; // user informations_

_$sql_table_typing = ’typing'; // „typing” information store - all users to all users (script automatically update, u can create this table without any data)_

Finally call [http://localhost/chat](http://localhost/chat) (or the URL where you uploaded the files). You'll see 4 demo page with sample usernames. You have to open each username in a different browser (because of PHP sessions) and you can start chatting with yourself by clicking on a username!

## How to set up the chat on your site

Don't worry, it's not difficult to set up, just follow these steps and you're done in a few minutes.

First of all let's insert the CSS files in the head section of your HTML document. These must be present on all of your pages where you want to use the chat!

_<head>_

_..._

_<link href="css/**reset.css**" rel="stylesheet" type="text/css" />_

_<link href="css/**chat.css**" rel="stylesheet" type="text/css" />_

_..._

_</head>_

Now insert **jQuery library,** **Chat application** and **own_id.inc.php** also in the head section of your HTML document. These must be present on all of your pages where you want to use the chat!

_<head>_

_..._

_<link href="css/**reset.css**" rel="stylesheet" type="text/css" />_

_<link href="css/**chat.css**" rel="stylesheet" type="text/css" />_

_<script type="text/javascript" src="js/**jquery.min.js**"></script>_

_<script type="text/javascript" src="js/**jquery.ajax_chat.js**"></script>_

_<script type="text/javascript" src="**own_id.inc.php**"></script>_

_..._

_</head>_

Now add the following code to the first line in all the pages where you'll use the chat:

_<?php_

_session_start();_

_// Load MySQL DB settings_

_include_once('config.inc.php');_

_// Set current user - You should set these values from users database after login_

_$_SESSION['username'] = 'Currently logged in users's username from database';_

_$_SESSION['user_id'] = 'Currently logged in user's id';_

_?>_

That's it! To print online users, you need to do it like this:

_<?php_

_$users = mysql_query("SELECT id,username FROM ".$sql_table_users." WHERE chat_status='online' AND id!='".$_SESSION['user_id']."'");_

_if(mysql_num_rows($users) > 0){_

_while($user = mysql_fetch_assoc($users)){_

_print '<a href="#" alt="'.$user['id'].'|'.$user['username'].'" class="chat_user">'.$user['username'].'</a><br />';_

_}_

_}_

_?>_

It's important to use **<a>** tag like that, because **alt** attribute contains the partner's user ID and username and **chat_user** class tells the script to open a chat window.

## Database tables, files and their functions

Here's a list of the database tables, files and their functions to know where to look for things if you want to change something.

**Users MySQL table**

**ID**: unique user ID number to identify them

**username**: user's username

**chat_status**: user's status. By default it's _offline_, when user logged in it's _online_

**offlineshift**: Need shift offline message sent time (if user reload page, or navigate other page in site, partners not have offline message. Offline message send only if current time is over offlineshift time)

**Chat MySQL table**

**ID**: unique ID for messages

**from_id**: the ID of the user who sent the message

**to_id**: the ID of the user who should receive the message

**message**: the content of message

**sent**: when the message has been sent (UNIX timestamp format)

**recd**: _0_ if user haven't received the message yet, _1_ if user received it. This is how script knows if there are any unreceived messages from a previous chat session

**system_message**: it's used to display system messages. In this case the message appears with another color.

**Typing  MySQL table**

**typing_from:** user ID who type

**typing_to**: Partner ID to have „typing” message

**typing_ornot**: „typing_from user”  type or not ( 0 or 1)

**Files**

**index.php, demo.php, demo2.php, demo3.php**: demo files

**config.inc.php**: MySQL and other settings. This is where you can add smileys.

**is_typing.php**: this PHP file is called via AJAX to check if our chatpartner is typing to us right now

**load_message.php**: this PHP file is called via AJAX to load messages

**load_popup_message.php**: this PHP file is called via AJAX to check if current user has any unread messages

**own_id.inc.php**: this script pass current user's ID to Javascript

**send_message.php**: this PHP file is called via AJAX to send messages

**is_typing****.php** this php file update user typing status (called via AJAX)

**set_status.php**: this PHP file is called via AJAX to set online (on page load) or offline (on page leave) status. In v1.3 manage oflineshift time. Partners never have offline message if user only reload page or navigate other page in site.

**chat.css**: this CSS stylesheet contains the chat window stylings

**reset.css**: a general CSS to set all element's padding to 0

**jquery.min.js**: jQuery library for easy Javascript

**jquery.ajax_chat.js**: the chat core
