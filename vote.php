<?php
	define('PUN_ROOT', dirname(__FILE__).'/');
	require PUN_ROOT.'include/common.php';
	
	//require PUN_ROOT.'header_site.php';
	
	
	echo vote_Top(1);
	
	/*if(isset($_GET['do']))
	{
		if($_GET['do']=='1')
		{
			if($_SESSION['CanVote']=='1')
			{
				$_SESSION['CanVote']='0';
				echo '<meta http-equiv="refresh" content="0; URL=http://www.root-top.com/topsite/gta/in.php?ID=2382">';
				$player = $db->fetch_assoc($db->query("SELECT * FROM `lvrp_users` WHERE Name='".$_SESSION['Login']."'"));
				$jeton = $player['Tokens']+0.5;
				$db->query("UPDATE lvrp_users SET Tokens=$jeton WHERE Name='".$_SESSION['Login']."'");
			}
			else echo 'lol';
		}
		elseif($_GET['do']=='2')
		{
			if($_SESSION['CanVote']=='1')
			{
				$_SESSION['CanVote']='0';
				echo '<meta http-equiv="refresh" content="0; URL=http://gtatop.eu/vote.php?id=67">';
				$player = $db->fetch_assoc($db->query("SELECT * FROM `lvrp_users` WHERE Name='".$_SESSION['Login']."'"));
				$jeton = $player['Tokens']+0.5;
				$db->query("UPDATE lvrp_users SET Tokens=$jeton WHERE Name='".$_SESSION['Login']."'");
			}
		}
	}*/
?>