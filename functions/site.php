<?php

	function site_RefreshTo($redirectTime = 0,$redirectSource = null)
	{
		echo '<meta http-equiv="Refresh" content="'.$redirectTime.';URL='.$redirectSource.'" />';
	}
	function site_ShowNotConnect()
	{
		include('functions/server.php');
		echo '<article><div class="title">Information</div><div class="new">';
		echo '<div style="text-align: center; padding: 0 10px"><big><b>'.$Server['Name'].'</b></big><br /><br />';
		echo 'Vous devez être connecté pour accèder à cette page ...<br/> Vous n\'avez pas de compte ? <a href="index.php?do=register&amp;step=1">Inscrivez-vous</a>.</div><br/>';
		echo '</div></article>';
		site_RefreshTo(4,'index.php?do=accueil');
	}
	function site_show($title,$container,$redirect = false,$redirectTime = 0,$redirectSource = null)
	{
		include('functions/server.php');
		/*if(isconnected())
		{
			$rStats = mysql_query("SELECT * FROM `lvrp_users` WHERE `Name`='".$_SESSION['login']."'");
			$dStats = mysql_fetch_array($rStats);
		}*/
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<?php echo '<title>'.$Server['Name'].' | '.$title.'</title>'; ?>
		<link rel="stylesheet" media="screen" type="text/css" title="" href="css/site2.css" />
		<?php
			if($redirect)
				{echo '<meta http-equiv="Refresh" content="'.$redirectTime.';URL='.$redirectSource.'" />';}
				
		?>
	</head>
	<body>
		<div id="header">
			<div class="title"><?php echo $Server['Name']; ?></div>
			<div class="navigation">
				<ul>
					<li class="active"><a href="index.php?do=accueil">Accueil</a></li>
					<li><a href="/forum/">Forum</a></li>
					<li><a href="#">Serveur</a>
					<ul>
						<?php echo '
						<li><a href="samp://'.$Server['Address'].':'.$Server['Port'].'">SA:MP</a></li>
						<li><a href="ts3server://'.$Server['TS'].':'.$Server['TS_Port'].'">TeamSpeak</a></li>';
						?>
					</ul>
					</li>
					<?php
						if(isconnected())
						{
							echo '<li><a href="#">Boutique</a>
							<ul>
								<li><a href="index.php?do=boutique&amp;type=token">Tokens</a></li>
								<li><a href="index.php?do=boutique&amp;type=buy">Achats</a></li>
							</ul>
							</li>
							';
						}
					?>
					<li><a href="#">Aide</a>
					<ul>
						<li><a href="index.php?do=help&amp;type=rules">Règles</a></li>
						<li><a href="index.php?do=help&amp;type=def">Définitions</a></li>
						<li><a href="index.php?do=help&amp;type=staff">Staff</a></li>
					</ul>
					</li>
				</ul>
			</div>
			<div class="user">
			<?php
				if(isconnected())
				{
					
					echo '<div class="session">
						Bienvenue, '.$pun_user['username'].'
						<div class="session_panel">
							<a href="index.php?do=profil&amp;type=1">Mon compte</a> - <a href="forum/login.php?action=out&amp;id='.$pun_user['username'].'&amp;csrf_token='.pun_hash($pun_user['id'].pun_hash(get_remote_address())).'">Deconnexion</a>
						</div>
					</div>
					';
				}
				else
				{
					echo '
							<form name="form1" method="post" action="forum/login.php?action=in">
								<div class="buton">
									<a href="index.php?do=register&amp;step=1">Inscription</a><br/>
									<input class="buton_g" type="submit" name="login" id="send" value="Connexion" />
								</div>
								<input type="hidden" name="form_sent" value="1" />
								<input type="hidden" name="redirect_url" value="'.$_SERVER['REQUEST_URI'].'" />
								<div class="pass">
									Mot de passe : <br/><input type="password" name="req_password" size="15" maxlength="32" /><br/>
								</div>
								<div class="name">
									Prénom_Nom : <br/><input type="text" name="req_username" size="15" maxlength="30" /><br/>
								</div>
							</form>';
				}
			?>
			</div>
		</div>
		<?php
		if($title=='accueil')
		{
			if(isset($_GET['error']))
			{
				if($_GET['error']=='1')
					{echo '<div class="error">Champ(s) non remplis</div>';}
				elseif($_GET['error']=='2')
					{echo '<div class="error">Nom d\'utilisateur incorrecte</div>';}
				elseif($_GET['error']=='3')
					{echo '<div class="error">Mot de passe invalide</div>';}
			}
		}
		if($title=='boutique')
		{
			if(isset($_GET['error']))
			{
				if($_GET['error']=='1')
					{echo '<div class="error">Code incorecte</div>';}
			}
		}
		elseif($title=='forum')
			{
				forum_Show();
				echo '
		</section>
		<footer>
			<div class="l"><b>&copy; Copyright, La Vie RolePlay 2013</b></div>';
			if(isAdmin())
				{echo '<div class="r"><a href="index.php?do=admin&amp;cd=index">Administration</a></div>';}
				echo'</footer>
				';
				return;
			}
		?>
		
		<section class="site">
			<?php 
			if($title=='accueil')
			{
				slider();
				echo '<article>';
					new_Show();
				echo '</article>';
			}
			elseif($title=='register')
			{
				switch($_GET['step'])
				{
					case '1': register_Step1(); break;
					case '2': register_Step2(); break;
					case '3': register_Step3(); break;
				}
			}
			elseif($title=='boutique')
			{
				switch($_GET['type'])
				{
					case 'token': boutique_Tokens(); break;
					case 'buy': boutique_Buy(); break;
				}
			}
			elseif($title=='admin')
			{
				switch($_GET['cd'])
				{
					case 'index': admin_Index(); break;
					case 'log_a': log_Admin(); break;
					case 'log_k': log_Kick(); break;
					case 'log_p': log_Pay(); break;
					case 'log_c': log_Connect(); break;
					case 'log_b': log_Ban(); break;
					case 'news_index': news_Index(); break;
					case 'news_create': news_Create(); break;
					case 'news_create_2': news_CreateSave(); break;
					case 'news_sup': news_Delete($_GET['id']); break;
					case 'news_edit': news_Edit($_GET['id']); break;
					case 'news_edit_2': news_EditSave($_GET['id']); break;
				}
			}
			elseif($title=='profil')
			{
				switch($_GET['type'])
				{
					case '1': profil_Stats(); break;
					case '3': profil_Fac(); break;
					case '4': profil_Biens(); break;
					case '5': profil_Casier(); break;
					case '6': profil_Inv(); break;
				}
			}
			elseif($title=='help')
			{
				switch($_GET['type'])
				{
					case 'def': help_Def(); break;
					case 'rules': help_Rules(); break;
					case 'staff': help_Staff(); break;
				}
			}
			?>
			<aside>
			<?php
				if(isconnected())
				{
					echo '<div class="title">Rappel</div>
				<div class="in">
					<br/><b>
					N\'oubliez pas de voter sur le root-top, cela permetera au serveur d\'attirer de nouveaux joueurs et de vous faire gagner des tokens. <br/>[Toutes les 2 heures]</b>
					<form name="form1" method="post" action="index.php?do=vote">
						<input type="submit" name="submit" id="send" value="Je vote" />
					</form>
				</div>';
				}
			?>
				<div class="title">Suivez-Nous</div>
				<div class="in">
					<br/>
					<?php echo '<a href="http://'.$Server['FaceBook'].'"><img src="../images/fb.jpg"/></a> 
					<a href="http://'.$Server['Twitter'].'"><img src="../images/tt.jpg"/></a> ';?>
				</div>
				<br/>				
				<div class="title">Serveur</div>
				<div class="in">
				<br/>
				<?php
						include('functions/sampquery.class.php');
						$sampquery = new SampQuery($Server['Address'], $Server['Port']);
						if($sampquery->isOnline()) 
						{
							$sinfos = $sampquery->getInfo();
							echo '<b>'.$sinfos['hostname'].'</b>';
							echo '<br/><br/>';
							echo '<b>Joueur(s) : </b>' .$sinfos['players']. '/' .$sinfos['maxplayers'].'<br/>';
							echo '<b>Version : </b>'.$sinfos['gamemode'].'<br/>';
							echo '<b>Map : </b>'.$sinfos['mapname'].'<br/><br/>';
							echo '<b><a href="samp://'.$Server['Address'].':'.$Server['Port'].'"> > Se connecter au serveur</a></b><br/>';
						}
						else
							{echo '<b>Le serveur est Hors Ligne.<br/></b>';}
				?>
				</div>
				<br/>
				<div class="title">Publicite</div>
				<div class="in">
				<br/>
				</div>	
				<br/>
			</aside>
			<div class="clear"></div>
		</section>
		<footer>
			<div class="l"><b>&copy; Copyright, La Vie RolePlay 2013</b></div>
			<?php 
			if(isAdmin())
				{echo '<div class="r"><a href="index.php?do=admin&amp;cd=index">Administration</a></div>';}
			?>
		</footer>
	</body>
<?php
	}
?>