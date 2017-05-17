<?php
	function help_Def()
	{
		echo '<article>
			<div class="title">Definitions</div>
			<div class="new">
				<center>
					<h3>Le RolePlay</h3>
					Signifie RolPlay : Jeu de rôle.<br/>
					Le RolePlay est le fait de jouer et faire évoluter un personnage comme dans la réalité.
					<h3>IC</h3>
					Signifie In Caractere : Dans votre personnage.<br/>
					Toutes les actions se font par lui. (Chat Normal)
					<h3>OOC</h3>
					Signifie Out Of Caractere : En dehors de votre personnage.<br/>
					C\'est à dire vous derière votre écran. (Cannaux OOC (/b - /o ..))
					<h3>IG</h3>
					Signifie In Game : Dans le jeu.
					<h3>IRL</h3>
					Signifie In Real Life : Dans la vie réel.
					<h3>Le Carkill</h3>
					Tuer une personnes en l\'écrasant et restant dessus depuis son véhicule. <font color="red">(INTERDIT)</font>
					<h3>Le PowerGame</h3>
					Le PowerGame a deux définitions :<br/>
					1. Faire une action impossible dans la réalité. <font color="red">(INTERDIT)</font><br/>
					2. Forcer le RP.<font color="red">(INTERDIT)</font>
					<h3>Le Metagame</h3>
					Utiliser des informations OOC en IC. <font color="red">(INTERDIT)</font>
					<h3>Revenge Kill</h3>
					C\'est le fait de se venger de sa mort en tuant la personne qui vous a tué au par avant. <font color="red">(INTERDIT)</font>
					<h3>Bunny Hopping</h3>
					Sautez pour aller plus vite. <font color="red">(INTERDIT)</font>
					<h3>Chiken Run</h3>
					Courir en slaloment pour éviter les balles <font color="red">(INTERDIT)</font>
					<h3>Le Rush</h3>
					Foncer dans le tas. <font color="red">(INTERDIT)</font>
					<h3>Le Mixe</h3>
					Melanger les canaux OOC (/b /o) et IC (Chat normal) <font color="red">(INTERDIT)</font>
					<h3>Le CarJack</h3>
					Ejecter quelqu\'un de son véhicule sans /me <font color="red">(INTERDIT)</font>
					<h3>Le DeathMatch</h3>
					Tuer une ou plusieurs personnes sans raison <font color="red">(INTERDIT)</font>
					<br/><br/>
				</center>
			</div>
			<br/>
			</article>';
	}
	function help_Rules()
	{
		echo '<article>
			<div class="title">Reglement Serveur</div>
			<div class="new">
				<center>
					<h3>Les comptes</h3>
					Vous avez le droit à un compte. Le double compte est interdit et passible d\'un ban.<br/>
					Il vous est interdit de partager/vendre votre compte. En cas de piratage de celui çi nous n\'en sommes en aucuns cas responsable. <br/>
					<h3>Le stunt</h3>
					Le stunt est strinctement interdit dans Los Santos. Mais vous avez la possiblité d\'en faire lors des events ou dans les stadiums.
					En cas de non respect de cette règles des sanctions s\'y appliqueront. Nous vous invitons à lire la définition du stunt.
					<h3>Conduite Rôleplay</h3>
					Il vous ait obligatoire de rouler de façon RôlePlay. Peu importe où vous êtes, votre conduite doit le rester.
					Des limitations de vitesse ont été mis en ville de sorte a vous obliger à le faire.
					<h3>Deconnexion en scène</h3>
					La deconnexion en scène est interdit et sèverement punnie. Assurez-vous que la/les personne(s) soi(en)t d\'accords pour
					remettre la scène à un autre moment.
					<h3>Les insultes</h3>
					Les insultes InGame sont totalement tolérées, serte, les insulte OOC sont interdites et passives d\'une lourde sanction.
					<h3>Les Drive By</h3>
					Le Drive est autorisé qu\'en passager et seulement passager.Toute personne prise en flât grand délit sera punnie.<br/>
					Armes autorisées : MP5 - Colt 45 - Silencieux - Uzi - Tec 9
				</center>
			</div>
			<br/>
			</article>';
	}
	function help_Staff()
	{
		$rJoueur = mysql_query("SELECT * FROM `lvrp_users` ORDER BY `id`");	
		echo '<article>
			<div class="title">Staff</div>
			<div class="new"><br/>';
		$membres = '<center>';	
		while($dJoueur = mysql_fetch_array($rJoueur))
		{
			if($dJoueur['AdminLevel']>=1)
			{
					if($dJoueur['AdminLevel'] == '1')
						$dJoueur['AdminLevel']= 'Modérateur Test';
					elseif ($dJoueur['AdminLevel'] == '2')
						$dJoueur['AdminLevel']= 'Modérateur';
					elseif ($dJoueur['AdminLevel'] == '3')
						$dJoueur['AdminLevel']= 'Admin';
					elseif ($dJoueur['AdminLevel'] == '4')
						$dJoueur['AdminLevel']= 'Admin Général';
					elseif ($dJoueur['AdminLevel'] == '5')
						$dJoueur['AdminLevel']= 'Gestionnaire';
					elseif ($dJoueur['AdminLevel'] == '6')
						$dJoueur['AdminLevel'] = 'Co-Fondateur';
					elseif ($dJoueur['AdminLevel'] == '7')
						$dJoueur['AdminLevel']= 'Fondateur';
						
					if($dJoueur['Connected']==1) $dJoueur['Connected'] ='Connecté';
					else  $dJoueur['Connected']='Déconnecté';
						
				$membres .= '<tr>
				<td>'.$dJoueur['Name'].'</td>
				<td>'.$dJoueur['AdminLevel'].'<br /></td>
				<td>'.$dJoueur['Connected'].'<br /></td>
				</tr></center>';
			}
		}
		echo '<center>
		<table id="container" BORDER=1 CELLPADDING=12 CELLSPACING=0>
			<tr><b>
				<td><u>Joueur</u></td>
				<td><u>Rang Admin</u></td>
				<td><u>Statue IG</u></td>
			</b></tr>
		
			'.$membres.'
		</table><br></center></center>';
		echo'
			</div>
			<br/>
			</article>';
	}
?>