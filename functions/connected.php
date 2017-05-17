<?php
	function isconnected()
	{
		if ($pun_user['is_guest'])
			{return false;}
		else
			{return true;}
		
		/*if(isset($_SESSION['login']) and isset($_SESSION['password']))
		{
			if($rIdentifiants = mysql_query('SELECT * FROM `lvrp_users` WHERE Name="'.htmlspecialchars($_SESSION['login']).'"') and $dIdentifiants = mysql_fetch_array($rIdentifiants) and $dIdentifiants['Pass'] == $_SESSION['password'] and $dIdentifiants['id'] == $_SESSION['MySQLid'])
				{return true;}
			else
				{return false;}
		}
		else
		{
			if(isset($_COOKIE['login']) and isset($_COOKIE['password']))
			{
				if($rIdentifiants = mysql_query('SELECT * FROM `lvrp_users` WHERE Name="'.htmlspecialchars($_COOKIE['login']).'"') and $dIdentifiants = mysql_fetch_array($rIdentifiants) and $dIdentifiants['Pass'] == $_COOKIE['password'] and $dIdentifiants['id'] == $_COOKIE['id'])
				{
					$_SESSION['login'] = $_COOKIE['login'];
					$_SESSION['password'] = $_COOKIE['password'];
					$_SESSION['MySQLid'] = $_COOKIE['id'];
					return true;
				}
				else
					{return false;}
			}
		}*/
	}
	
	function isconnectedIG()
	{
		if(isconnected())
		{
			$result = $db->query('SELECT * FROM lvrp_users WHERE '.$pun_user['username']) or error('Unable to fetch user info', __FILE__, __LINE__, $db->error());
			$dStats = $db->fetch_assoc($result);
			if($dStats['Connected'] >= 1)
				{return true;}
		}
	}
?>