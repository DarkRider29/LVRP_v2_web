<?php
	function isAdmin()
	{
		if(isconnected())
		{
			$rStats = mysql_query("SELECT * FROM `lvrp_users` WHERE `Name`='".$_SESSION['login']."'");
			$dStats = mysql_fetch_array($rStats);
			if($dStats['AdminLevel'] >= 4)
				{return true;}
		}
	}
	function admin_Index()
	{
		if(isconnected() && isAdmin())
		{
			echo '<article><div class="title">Adminitration</div><div class="new">';
			echo '<br/><h3>
			. <a href="index.php?do=admin&amp;cd=news_index">Gestion des News</a><br/>
			. <a href="index.php?do=admin&amp;cd=log_a">Logs Admin</a><br/>
			. <a href="index.php?do=admin&amp;cd=log_p">Logs Payes</a><br/>
			. <a href="index.php?do=admin&amp;cd=log_k">Logs Kick</a><br/>
			. <a href="index.php?do=admin&amp;cd=log_b">Lock Ban</a><br/>
			. <a href="index.php?do=admin&amp;cd=log_c">Logs Connexions</a><br/>
			</h3><br/>';
			echo '</div></article>';
		}
		else
			{header("Location: index.php");}
	}
	function log_Admin()
	{
		if(isconnected() && isAdmin())
		{
			echo '<article><div class="title">Logs Admins</div><div class="new">';
			$rLog = mysql_query("SELECT * FROM `lvrp_log_admins`");				
	
			while($dLog = mysql_fetch_array($rLog))
				{echo '['.date('d/m/Y',$dLog['Date']).' à '.date('H:i:s',$dLog['Date']).'] '.$dLog['Value'].'<br/>';}
			echo '</div></article>';
		}
		else
			{header("Location: index.php");}
	}
	function log_Kick()
	{
		if(isconnected() && isAdmin())
		{
			echo '<article><div class="title">Logs Kick</div><div class="new">';
			$rLog = mysql_query("SELECT * FROM `lvrp_log_kick`");				
	
			while($dLog = mysql_fetch_array($rLog))
				{echo '['.date('d/m/Y',$dLog['Date']).' à '.date('H:i:s',$dLog['Date']).'] '.$dLog['Name'].', kické par '.$dLog['KickedBy'].', raison : '.$dLog['Reason'].' (IP : '.$dLog['Ip'].')<br/>';}
			echo '</div></article>';
		}
		else
			{header("Location: index.php");}
	}
	function log_Pay()
	{
		if(isconnected() && isAdmin())
		{
			echo '<article><div class="title">Logs Payes</div><div class="new">';
			$rLog = mysql_query("SELECT * FROM `lvrp_log_pay`");				
	
			while($dLog = mysql_fetch_array($rLog))
			{
				$rPlayer = mysql_query("SELECT Name FROM `lvrp_users` WHERE id='".$dLog['SQLid']."' LIMIT 1");
				$dPlayer = mysql_fetch_array($rPlayer);
				echo '['.date('d/m/Y',$dLog['Date']).' à '.date('H:i:s',$dLog['Date']).'] '.$dPlayer['Name'].', Somme : $'.$dLog['Somme'].', Raison : '.$dLog['Reason'].' (IP : '.$dLog['Ip'].')<br/>';
			}
			echo '</div></article>';
		}
		else
			{header("Location: index.php");}
	}
	function log_Connect()
	{
		if(isconnected() && isAdmin())
		{
			echo '<article><div class="title">Logs Connexions</div><div class="new">';
			$rLog = mysql_query("SELECT * FROM `lvrp_log_connect`");				
	
			while($dLog = mysql_fetch_array($rLog))
			{
				$rPlayer = mysql_query("SELECT Name FROM `lvrp_users` WHERE id='".$dLog['SQLid']."' LIMIT 1");
				$dPlayer = mysql_fetch_array($rPlayer);
				echo '['.date('d/m/Y',$dLog['Date']).' à '.date('H:i:s',$dLog['Date']).'] '.$dPlayer['Name'].' (IP : '.$dLog['Ip'].')<br/>';
			}
			echo '</div></article>';
		}
		else
			{header("Location: index.php");}
	}
	function log_Ban()
	{
		if(isconnected() && isAdmin())
		{
			echo '<article><div class="title">Logs Bans</div><div class="new">';
			$rLog = mysql_query("SELECT * FROM `lvrp_users_bans`");				
	
			while($dLog = mysql_fetch_array($rLog))
			{
				$rPlayer = mysql_query("SELECT Name FROM `lvrp_users` WHERE id='".$dLog['SQLid']."' LIMIT 1");
				$dPlayer = mysql_fetch_array($rPlayer);
				echo '['.date('d/m/Y',$dLog['Date']).' à '.date('H:i:s',$dLog['Date']).'] '.$dPlayer['Name'].' banni par '.$dLog['BannedBy'].', raison : '.$dLog['Reason'].' (IP : '.$dLog['Ip'].')<br/>';
			}
			echo '</div></article>';
		}
		else
			{header("Location: index.php");}
	}
	function news_Index()
	{
		if(isconnected() && isAdmin())
		{
			echo '<article><div class="title">Gestion News</div><div class="new"><br/>';
			$rNews = mysql_query("SELECT * FROM `lvrp_site_news` ORDER BY `id`");				
			$news = '<center>';
			while($dNews = mysql_fetch_array($rNews))
			{
				$news .= '<tr>
					<td>'.$dNews['Title'].'</td>';
				if(strlen($dNews['Contenu']) > 32)
					{$subnew = substr($dNews['Contenu'], 0 , 32);}
				else
					{$subnew = $dNews['Contenu'];}
				$news .= '<td>'.$subnew.' [...]<br /></td>
					<td>'.$dNews['Autor'].'</td>
					<td>'.date('d/m/Y',$dNews['Date']).'</td>
					<td><a href="index.php?do=admin&amp;cd=news_edit&amp;id='.$dNews['id'].'">Editer</a></td>
					<td><a href="index.php?do=admin&amp;cd=news_sup&amp;id='.$dNews['id'].'">Supr.</a></td>
				</tr></center>';
				
			}
			echo '
				<center>
				<table id="container" BORDER=1 CELLPADDING=0 CELLSPACING=0>
					<tr><b>
						<td>Titre :</td>
						<td>Contenue :</td>
						<td>Auteur :</td>
						<td>Date :</td>
						<td></td>
						<td></td>
					</b></tr>
				
					'.$news.'
				</table><div class="date"><a href="index.php?do=admin&amp;cd=news_create">Créer une nouvelle news ...</a></div><br></center></center>';
			echo '</div></article>';
		}
		else
			{header("Location: index.php");}
	}
	function news_Delete($id)
	{
		if(isconnected() && isAdmin())
		{
			mysql_query("DELETE FROM `lvrp_site_news` WHERE `id` = '".$id."'");
			header("Location: index.php?do=admin&cd=news_index");
		}
		else
			{header("Location: index.php");}
	}
	function news_Edit($id)
	{
		if(isconnected() && isAdmin())
		{
			$rNews = mysql_query("SELECT * FROM `lvrp_site_news` WHERE `id` = '".$id."'");
			$dNews = mysql_fetch_array($rNews);
			echo '<article><div class="title">News Edition</div><div class="new"><br/>';
			echo '
			<form name="form1" method="post" action="index.php?do=admin&cd=news_edit_2&id='.$id.'">
			<center>
				Title : <br/><input type="text" name="title" value="'.$dNews['Title'].'" size="32" maxlength="64" /><br/>
				Contenue : <br/><textarea id="contenu" name="contenu" rows="12" cols="60">'.$dNews['Contenu'].'</textarea> <br/>
				* L\'utilisation de balise HTML est activé.  
				<div class="buton">
					<input class="buton_g" type="submit" name="submit" id="send" value="Enregistrer" />
				</div>
				<br/>
			</center>
			</form>';
			echo '</div></article>';
		}
		else
			{header("Location: index.php");}
	}
	function news_EditSave($id)
	{
		if(isconnected() && isAdmin())
		{
			mysql_query("UPDATE `lvrp_site_news` SET Title='".$_POST['title']."', Contenu='".$_POST['contenu']."' WHERE `id` = '".$id."'");
			header("Location: index.php?do=admin&cd=news_index");
		}
		else
			{header("Location: index.php");}
	}
	function news_Create()
	{
		if(isconnected() && isAdmin())
		{
			echo '<article><div class="title">News Edition</div><div class="new"><br/>';
			echo '
			<form name="form1" method="post" action="index.php?do=admin&cd=news_create_2">
			<center>
				Title : <br/><input type="text" name="title" size="32" maxlength="64" /><br/>
				Contenue : <br/><textarea id="contenu" name="contenu" rows="12" cols="60"></textarea> <br/>
				* L\'utilisation de balise HTML est activé.  
				<div class="buton">
					<input class="buton_g" type="submit" name="submit" id="send" value="Enregistrer" />
				</div>
				<br/>
			</center>
			</form>';
			echo '</div></article>';
		}
		else
			{header("Location: index.php");}
	}
	function news_CreateSave()
	{
		if(isconnected() && isAdmin())
		{
			mysql_query("INSERT INTO `lvrp_site_news` SET Title='".mysql_real_escape_string($_POST['title'])."', Contenu='".mysql_real_escape_string($_POST['contenu'])."', Date=UNIX_TIMESTAMP(), Autor='".mysql_real_escape_string($_SESSION['login'])."' ");
			header("Location: index.php?do=admin&cd=news_index");
		}
		else
			{header("Location: index.php");}
	}
?>