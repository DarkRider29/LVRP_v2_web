<?php
	function site_RefreshTo($redirectTime = 0,$redirectSource = null)
	{
		echo '<meta http-equiv="Refresh" content="'.$redirectTime.';URL='.$redirectSource.'" />';
	}
	function site_ShowNotConnect()
	{
		include('functions/server.php');
		echo '<div class="saut_de_page"></div>';
		echo '<div style="text-align: center; padding: 0 10px"><big><b>'.$Server['Name'].'</b></big><br /><br />';
		echo 'Vous devez être connecté pour accèder à cette page ...<br/> Vous n\'avez pas de compte ? <a href="accueil.php?do=register_s1">Inscrivez-vous</a>.</div><br/>';
		echo '<div class="saut_de_page"></div>';
		site_RefreshTo(4,'index.php?do=accueil');
	}
	function site_show($title,$container,$redirect = false,$redirectTime = 0,$redirectSource = null)
	{
		include('functions/server.php');
		
		if(isconnected())
		{
			$rStats = mysql_query("SELECT * FROM `lvrp_users` WHERE `Name`='".$_SESSION['login']."'");
			$dStats = mysql_fetch_array($rStats);
		}
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<?php echo '<title>RolePlay Axe | '.$title.'</title>'; ?>
		<link rel="stylesheet" media="screen" type="text/css" title="" href="css/css.css" />
		<?php
			if($redirect)
				{echo '<meta http-equiv="Refresh" content="'.$redirectTime.';URL='.$redirectSource.'" />';}
				
		?>
	</head>
	<body>
		<header>
			<div id="top" class="site">
				<a href="index.php?do=accueil" class="logo">logo du site</a>
				<nav>
					<ul>
						<li><a href="index.php?do=accueil">Accueil</a></li>
						<li><a href="/forum/index.php">Forum</a></li>
						<li><a href="index.php?do=rules">Règles</a></li>
						<li><a href="index.php?do=boutique">Boutique</a></li>
						<li><a href="http://sa-mp.com/">SAMP</a></li>
						<li><a href="http://">Votez</a></li>
					</ul>
					
					<div id="reseaux">
						<a href="http://<?php echo $Server['Twitter']; ?>" class="twitter">twitter</a>
						<a href="http://<?php echo $Server['FaceBook']; ?>" class="facebook">facebook</a>
						<a href="http://<?php echo $Server['Youtube']; ?>" class="youtube">Youtube</a>
					</div>
				</nav>
			</div>
		</header>
		
		<div class="clear"></div>
		
		<section class="site">
		<article>
			<?php
				if($title=='accueil')
				{
					echo '<div class="saut_de_page"></div>';
					slider();
					echo '<br/><br/><div class="saut_de_page"></div>';
				}
				elseif($title=='rules')
				{
					echo '<div class="saut_de_page"></div>';
					echo '<div class="saut_de_page"></div>';
				}
				elseif($title=='profil_stats')
					{profil_Stats();}
				elseif($title=='profil_fac')
					{profil_Fac();}
				elseif($title=='profil_biens')
					{profil_Biens();}
				elseif($title=='profil_casier')
					{profil_Casier();}
				elseif($title=='profil_inv')
					{profil_Inv();}
				elseif($title=='boutique')
					{boutique_Show();}
				elseif($title=='boutique_token')
					{boutique_Token();}
				elseif($title=='register_s1')
					{register_Step1();}
				elseif($title=='register_s2')
					{register_Step2();}
				elseif($container!='-')
					{echo $container;}
				else
				{
					echo '<div class="saut_de_page"></div>';
					echo '<div style="text-align: center; padding: 0 10px"><big><b>'.$Server['Name'].'</b></big><br /><br />';
					echo 'La page demandée est supprimée ou inexistante ...<br/> Merci de contacter un administrateur.</div><br/>';
					echo '<div class="saut_de_page"></div>';
					site_RefreshTo(4,'index.php?do=accueil');
				}
			?>
		</article>

		<aside>

			<div class="bloc"> 
			<?php 
				if(isconnected())
					{
						echo '<div class="bloc_top"><b>Profil</b></div>
							  <center><font color="white"> ';
							  
						echo 'Bienvenue, <a href="index.php?do=profil_stats"><b>'.$_SESSION['login'].'</a></b><br/><br/>
						<b>Dernière connexion IG : </b><br/>'.htmlspecialchars($dStats['LastLog']).'<br/><br/> 
						<a href="index.php?do=profil_stats">> Compte</a><br/>';
						if($dStats['AdminLevel'] >= 5)
							{echo '<a href="index.php?do=admin">> Administration</a><br/>';}
						echo '<a href="index.php?do=logoff">> Deconnexion</a><br/>';
					}
					else
					{
						echo '<div class="bloc_top"><b>Connexion</b></div>
							  <center><font color="white"> ';
						echo '
							<form name="form1" method="post" action="index.php?do=login">
								Prénom_Nom<br/><input type="text" name="login" size="20" maxlength="30" /> <br/>
								Mot de passe :<br/><input type="password" name="password" size="20" maxlength="32" /><br/>
								<input type="submit" name="submit" id="send" value="Connexion" />
							</form>
							<a href="index.php?do=register_s1">> Creer un compte</a><br/>';
					}
					echo '<br/>					
						  </font></center>';
				?>
			</div>
			<div class="bloc"> 
				<div class="bloc_top"><b>Serveur</b></div>
				<center><font color="white">
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
							{echo 'Le serveur est Hors Ligne.';}
					?>
					<br/>
				</font></center>
			</div>

		</aside>
	</section>
	<div class="clear"></div>
	   
		<footer>
		
			<div id="copyright">
				<div class="site">
				<p class="left">© Copyright <?php echo $Server['Name']; ?> 2013</a></p>
				<p class="right">Design par Dark_Rider</a></p>
				</div>
			</div>
		</footer>
	</body>
<?php
	}
?>