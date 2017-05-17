
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
		<link rel="stylesheet" media="screen" type="text/css" title="" href="css/site.css" />
		<link rel="icon" href="images/icon.ico" type="image/x-icon">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>La Vie RolePlay | Site</title>
	</head>
	<body>
	<div id="header">
				<div class="title"><?php echo $Server['Name']; ?></div>
				<div class="navigation">
					<ul>
						<li <?php echo ((PUN_ACTIVE_PAGE == 'index') ? ' class="active"' : '');?>"><a href="index.php">Accueil</a></li>
						<li><a href="forum.php">Forum</a>
						<ul>
							<li><a href="userlist.php">Membres</a></li>
							<li><a href="search.php">Recherche</a></li>
							<?php
							if(!$pun_user['is_guest'])
								{echo '<li><a href="profile.php?id='.$pun_user['id'].'">Profil</a></li>';}
							if ($pun_user['is_admmod'] && ($pun_user['g_id'] == PUN_ADMIN || $pun_user['g_id'] == '5'))
								{echo '<li><a href="admin_index.php">Admin</a></li>';}
							?>
						</ul>
						</li>
						<?php
							if(!$pun_user['is_guest'])
							{
								echo '<li  '.((PUN_ACTIVE_PAGE == 'boutique') ? ' class="active"' : '').' ><a href="#">Boutique</a>
								<ul>
									<li><a href="index.php?do=boutique&amp;type=token">Tokens</a></li>
									<li><a href="index.php?do=boutique&amp;type=buy">Achats</a></li>
								</ul>
								</li>
								';
							}
						?>
						<li <?php echo ((PUN_ACTIVE_PAGE == 'help') ? ' class="active"' : ''); ?>><a href="#">Aide</a>
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
					if (!$pun_user['is_guest'])
					{
						
						echo '<div class="session">
							Bienvenue, '.$pun_user['username'].'
							<div class="session_panel">
								<a href="index.php?do=profil&amp;type=1">Mon compte</a> - <a href="login.php?action=out&amp;id='.$pun_user['id'].'&amp;csrf_token='.pun_hash($pun_user['id'].pun_hash(get_remote_address())).'">Deconnexion</a>
							</div>
						</div>
						';
					}
					else
					{
						echo '
								<form name="form1" method="post" action="login.php?action=in">
									<div class="buton">
										<a href="register.php">Inscription</a><br/>
										<input class="buton_g" type="submit" name="login" id="send" value="Connexion" /><br/>
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
			<section class="site">