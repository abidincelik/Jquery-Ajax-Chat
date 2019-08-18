<?php

$sql_username = '';
$sql_password = '';
$database = 'jquerychatv13';
$sql_table_chat = 'chat';
$sql_table_users = 'users';
$sql_table_typing ='typing';

$hide_old_messages_tstamp = '7200';	//hide messages which are older than ... seconds
	
$display_links = 'yes';	//format strings to links which starts with http://...
	
	
//smileys
$smileys = array(
	':fuck'			=> 'images/smiley - fuck.png',
	':alien'		=> 'images/smiley - alien.png',
	':gr'			=> 'images/smiley - angry.png',
	':bandit'		=> 'images/smiley - bandit.png',
	':beard'		=> 'images/smiley - beard.png',
	':oops'			=> 'images/smiley - bigeyes.png',
	':bored'		=> 'images/smiley - bored.png',
	':cf'			=> 'images/smiley - calm.png',
	':cat'			=> 'images/smiley - cat.png',
	':cy'			=> 'images/smiley - cheeky.png',
	':))'			=> 'images/smiley - cheerful.png',
	':chinese'		=> 'images/smiley - chinese.png',
	':)'			=> 'images/smiley - classic.png',
	':co'			=> 'images/smiley - confused.png',
	':cool'			=> 'images/smiley - cool.png',
	':ce'			=> 'images/smiley - cross-eyed.png',
	':cry'			=> 'images/smiley - cry.png',
	':see'			=> 'images/smiley - cyclops.png',
	':dead'			=> 'images/smiley - dead.png',
	':dead1'		=> 'images/smiley - dead1.png',
	':sx'			=> 'images/smiley - depressed.png',
	':('			=> 'images/smiley - devious.png',
	':devious'		=> 'images/smiley - disappointed.png',
	':)))'			=> 'images/smiley - ditsy.png',
	':dog'			=> 'images/smiley - dog.png',
	''				=> 'images/smiley - embarrassed.png',
	':/'			=> 'images/smiley - ermm.png',
	':evil'			=> 'images/smiley - evil.png',
	':evolved'		=> 'images/smiley - evolved.png',
	':fog'			=> 'images/smiley - fog.png',
	':gasmask'		=> 'images/smiley - gasmask.png',
	':glasses'		=> 'images/smiley - glasses.png',
	':grin'			=> 'images/smiley - grin.png',
	''				=> 'images/smiley - happy.png',
	':hehe'			=> 'images/smiley - hehe.png',
	''				=> 'images/smiley - hmmm.png',
	''				=> 'images/smiley - hurt.png',
	''				=> 'images/smiley - jaguar.png',
	':ko'			=> 'images/smiley - knocked out.png',
	':D'			=> 'images/smiley - laugh.png',
	':p'			=> 'images/smiley - lick.png',
	''				=> 'images/smiley - mad.png',
	''				=> 'images/smiley - nervous.png',
	''				=> 'images/smiley - ninja.png',
	''				=> 'images/smiley - normal.png',
	':ogre'			=> 'images/smiley - ogre.png',
	''				=> 'images/smiley - old man.png',
	':para'			=> 'images/smiley - paranoid.png',
	''				=> 'images/smiley - pirate.png',
	''				=> 'images/smiley - ponder.png',
	':s'			=> 'images/smiley - puzzled.png',
	''				=> 'images/smiley - rambo.png',
	':oa'			=> 'images/smiley - ri.png',
	''				=> 'images/smiley - robot.png',
	':(('			=> 'images/smiley - sad.png',
	':oo'			=> 'images/smiley - scared.png',
	''				=> 'images/smiley - silly.png',
	':z'			=> 'images/smiley - sleeping.png',
	''				=> 'images/smiley - smiley.png',
	':smoke'		=> 'images/smiley - smoker.png',
	':x'			=> 'images/smiley - speechless.png',
	''				=> 'images/smiley - square-eyed.png',
	':o'			=> 'images/smiley - surprised.png',
	':garfield'		=> 'images/smiley - tired.png',
	''				=> 'images/smiley - vampire.png',
	';)'			=> 'images/smiley - wink.png',
	':ooo'			=> 'images/smiley- shocked.png',
	':angel'		=> 'images/smiley - angel.png',
	':beer'			=> 'images/smiley - beer.png',
	':cofe'			=> 'images/smiley - cofe.png',
	':f'			=> 'images/smiley - f.png',
	':kiss'			=> 'images/smiley - kiss.png',
	':love'			=> 'images/smiley - love.png',
	':phone'		=> 'images/smiley - phone.png',
	':rose1'		=> 'images/smiley - rose1.png',
	':rose2'		=> 'images/smiley - rose2.png',
	':rose3'		=> 'images/smiley - rose3.png',
	':water'		=> 'images/smiley - water.png',
	':wtf'			=> 'images/smiley - wtf.png'
);
	
	
	
//connect to MySQL	
$mysql['connection_id'] = mysql_connect('localhost',$sql_username, $sql_password);
mysql_select_db($database);

mysql_query("set names utf8");

?>