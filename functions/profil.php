<?php
	function profil_Biens()
	{
		if(isconnected())
		{
			$rStats = mysql_query("SELECT * FROM `lvrp_users` WHERE `Name`='".$_SESSION['login']."'");
			$dStats = mysql_fetch_array($rStats);
			
			echo '<article><div class="title">Profil</div><div class="new">';
			
			echo '<div style="text-align: center"><br /><big><b>' . $dStats['Name'] . '</b></big><br /><br />',"\n"
                . '<a href="index.php?do=profil&amp;type=1"> Profil </a> | ',"\n"
				. '<a href="index.php?do=profil&amp;type=3"> Faction/Job </a> | ',"\n"
                . '<b> Biens </b> | ',"\n"
                . '<a href="index.php?do=profil&amp;type=5"> Casier </a> | ',"\n"
                . '<a href="index.php?do=profil&amp;type=6""> Inventaire</a></b></div><br />',"\n";
				
			echo '<table style="margin:auto; background:#ffffff; border:1px solid #1E1E1E; width:75%;" cellpadding="0" cellspacing="1">',"\n"
                . '<tr style="background: #1E1E1E"><td colspan="2" align="center" style="padding:2px"><font color="white"><b> Véhicule(s)</b></font></td></tr>',"\n"
                . '<tr style="background: #00FFFA"><td align="left" valign="middle" style="width:100%; background:#ffffff">',"\n"
                . '<ul style="list-style-type:square;margin-left:25px">',"\n";
				
				if($dStats['Car1'] == -1 && $dStats['Car2'] == -1 & $dStats['Car3'] == -1 & $dStats['Car4'] == -1 & $dStats['Car5'] == -1 & $dStats['Car6'] == -1)
					{echo '<li>Vous n\'avez pas de voiture</li>';}
					
				if($dStats['Car1'] != -1) 
				{
					$rCar1 = mysql_query("SELECT * FROM `lvrp_server_cars` WHERE `id`=".$dStats['Car1']."");
					$dCar1 = mysql_fetch_array($rCar1);
					echo '<li><b>Véhicule slot 1 :</b> ID :'.$dStats['Car1'].' - Model : '.get_CarName($dCar1['Model']).'</li>';
				}
				if($dStats['Car2'] != -1) 
				{
					$rCar2 = mysql_query("SELECT * FROM `lvrp_server_cars` WHERE `id`=".$dStats['Car2']."");
					$dCar2 = mysql_fetch_array($rCar2);
					echo '<li><b>Véhicule slot 2 :</b> ID :'.$dStats['Car2'].' - Model : '.get_CarName($dCar2['Model']).'</li>';
				}
				if($dStats['Car3'] != -1) 
				{
					$rCar3 = mysql_query("SELECT * FROM `lvrp_server_cars` WHERE `id`=".$dStats['Car3']."");
					$dCar3 = mysql_fetch_array($rCar3);
					echo '<li><b>Véhicule slot 3 :</b> ID :'.$dStats['Car3'].' - Model : '.get_CarName($dCar3['Model']).'</li>';
				}
				if($dStats['Car4'] != -1 && $dStats['CarUnLock4']) 
				{
					$rCar4 = mysql_query("SELECT * FROM `lvrp_server_cars` WHERE `id`=".$dStats['Car4']."");
					$dCar4 = mysql_fetch_array($rCar4);
					echo '<li><b>Véhicule slot 4 :</b> ID :'.$dStats['Car4'].' - Model : '.get_CarName($dCar4['Model']).'</li>';
				}
				if($dStats['Car5'] != -1 && $dStats['CarUnLock5']) 
				{
					$rCar5 = mysql_query("SELECT * FROM `lvrp_server_cars` WHERE `id`=".$dStats['Car5']."");
					$dCar5 = mysql_fetch_array($rCar5);
					echo '<li><b>Véhicule slot 5 :</b> ID :'.$dStats['Car5'].' - Model : '.get_CarName($dCar5['Model']).'</li>';
				}
				if($dStats['Car6'] != -1 && $dStats['CarUnLock6']) 
				{
					$rCar6 = mysql_query("SELECT * FROM `lvrp_server_cars` WHERE `id`=".$dStats['Car6']."");
					$dCar6 = mysql_fetch_array($rCar6);
					echo '<li><b>Véhicule slot 6 :</b> ID :'.$dStats['Car6'].' - Model : '.get_CarName($dCar6['Model']).'</li>';
				}
            echo '</ul>',"\n"
                . '</td></table><br />',"\n";
			
			echo '<table style="margin:auto; background:#ffffff; border:1px solid #1E1E1E; width:75%;" cellpadding="0" cellspacing="1">',"\n"
                . '<tr style="background: #1E1E1E"><td colspan="2" align="center" style="padding:2px"><font color="white"><b>Biz</b></font></td></tr>',"\n"
                . '<tr style="background: #00FFFA"><td align="left" valign="middle" style="width:100%; background:#ffffff">',"\n"
                . '<ul style="list-style-type:square;margin-left:25px">',"\n";
				if($dStats['Bizz1'] == -1 && $dStats['Bizz2'] == -1 & $dStats['Bizz3'] == -1)
					echo ('<li><i>Vous n\'avez pas de biz</i></li>');
				if($dStats['Bizz1'] != -1) 
				{
					if($dStats['Bizz1'] >= 1000)
					{
						$biz1=$dStats['Bizz1']-999;
						$rbizz1 = mysql_query("SELECT * FROM `lvrp_server_uniquebizz` WHERE `id`=".$biz1."");
						$dbizz1 = mysql_fetch_array($rbizz1);
						echo ('<li><b>Bizz slot 1 :</b> ID : '.$dStats['Bizz1'].' - Nom : '.$dbizz1['Message'].'</li>');
					}
					else
					{
						$biz1=$dStats['Bizz1']+1;
						$rbizz1 = mysql_query("SELECT * FROM `lvrp_server_bizz` WHERE `id`=".$biz1."");
						$dbizz1 = mysql_fetch_array($rbizz1);
						echo ('<li><b>Bizz slot 1 :</b> ID : '.$dStats['Bizz1'].' - Nom : '.$dbizz1['Message'].'</li>');
					}
				}
				if($dStats['Bizz2'] != -1) 
				{
					if($dStats['Bizz2'] >= 1000)
					{
						$biz2=$dStats['Bizz2']-999;
						$rbizz2 = mysql_query("SELECT * FROM `lvrp_server_uniquebizz` WHERE `id`=".$biz2."");
						$dbizz2 = mysql_fetch_array($rbizz2);
						echo ('<li><b>Bizz slot 2 :</b> ID : '.$dStats['Bizz2'].' - Nom : '.$dbizz2['Message'].'</li>');
					}
					else
					{
						$biz2=$dStats['Bizz2']+1;
						$rbizz1 = mysql_query("SELECT * FROM `lvrp_server_bizz` WHERE `id`=".$biz2."");
						$dbizz2 = mysql_fetch_array($rbizz2);
						echo ('<li><b>Bizz slot 2 :</b> ID : '.$dStats['Bizz2'].' - Nom : '.$dbizz2['Message'].'</li>');
					}
				}
				if($dStats['Bizz3'] != -1) 
				{
					if($dStats['Bizz3'] >= 1000)
					{
						$biz3=$dStats['Bizz3']-999;
						$rbizz3 = mysql_query("SELECT * FROM `lvrp_server_uniquebizz` WHERE `id`=".$biz3."");
						$dbizz3 = mysql_fetch_array($rbizz3);
						echo ('<li><b>Bizz slot 3 :</b> ID : '.$dStats['Bizz3'].' - Nom : '.$dbizz3['Message'].'</li>');
					}
					else
					{
						$biz3=$dStats['Bizz3']+1;
						$rbizz3 = mysql_query("SELECT * FROM `lvrp_server_bizz` WHERE `id`=".$biz3."");
						$dbizz3 = mysql_fetch_array($rbizz3);
						echo ('<li><b>Bizz slot 3 :</b> ID : '.$dStats['Bizz3'].' - Nom : '.$dbizz3['Message'].'</li>');
					}
				}
			echo '</ul>',"\n"
                . '</td></table><br />',"\n";
				
			echo '<table style="margin:auto; background:#ffffff; border:1px solid #1E1E1E; width:75%;" cellpadding="0" cellspacing="1">',"\n"
                . '<tr style="background: #1E1E1E"><td colspan="2" align="center" style="padding:2px"><font color="white"><b>Maison(s)</b></font></td></tr>',"\n"
                . '<tr style="background: #00FFFA"><td align="left" valign="middle" style="width:100%; background:#ffffff">',"\n"
                . '<ul style="list-style-type:square;margin-left:25px">',"\n";
				if($dStats['House1'] == -1 && $dStats['House2'] == -1 & $dStats['House3'] == -1)
					echo ('<li><i>Vous n\'avez pas de maison</i></li>');
				if($dStats['House1'] != -1)
				{
					$house1=$dStats['House1']+1;
					$rhouse1 = mysql_query("SELECT * FROM `lvrp_server_houses` WHERE `id`=".$house1."");
					$dhouse1 = mysql_fetch_array($rhouse1);
					echo ('<li><b>Maison slot 1 :</b> ID : '.$dStats['House1'].' - Info : '.$dhouse1['Message'].'</li>');
				}
				if($dStats['House2'] != -1)
				{
					$house2=$dStats['House2']+1;
					$rhouse2 = mysql_query("SELECT * FROM `lvrp_server_houses` WHERE `id`=".$house2."");
					$dhouse2 = mysql_fetch_array($rhouse2);
					echo ('<li><b>Maison slot 2 :</b> ID : '.$dStats['House2'].' - Info : '.$dhouse2['Message'].'</li>');
				}
				if($dStats['House3'] != -1)
				{
					$house3=$dStats['House3']+1;
					$rhouse3 = mysql_query("SELECT * FROM `lvrp_server_houses` WHERE `id`=".$house3."");
					$dhouse3 = mysql_fetch_array($rhouse3);
					echo ('<li><b>Maison slot 3 :</b> ID : '.$dStats['House3'].' - Info : '.$dhouse3['Message'].'</li>');
				}
			echo '</ul>',"\n"
                . '</td></table><br />',"\n";
				
			echo '<table style="margin:auto; background:#ffffff; border:1px solid #1E1E1E; width:75%;" cellpadding="0" cellspacing="1">',"\n"
                . '<tr style="background: #1E1E1E"><td colspan="2" align="center" style="padding:2px"><font color="white"><b>Garage(s)</b></font></td></tr>',"\n"
                . '<tr style="background: #00FFFA"><td align="left" valign="middle" style="width:100%; background:#ffffff">',"\n"
                . '<ul style="list-style-type:square;margin-left:25px">',"\n";
				if($dStats['Garage1'] == -1 && $dStats['Garage2'] == -1 & $dStats['Garage3'] == -1)
					echo ('<li><i>Vous n\'avez pas de garage</i></li>');
				if($dStats['Garage1'] != -1) echo ('<li><b>Garage slot 1 : ID : '.$dStats['Garage1'].'</li>');
				if($dStats['Garage2'] != -1) echo ('<li><b>Garage slot 2 : ID : '.$dStats['Garage2'].'</li>');
				if($dStats['Garage3'] != -1) echo ('<li><b>Garage slot 3 : ID : '.$dStats['Garage3'].'</li>');
			echo '</ul>',"\n"
                . '</td></table><br />',"\n";
				
			echo '</div></article>';
		}
		else
			{site_ShowNotConnect();}
	}
	
	function profil_Casier()
	{
		if(isconnected())
		{
			$rStats = mysql_query("SELECT * FROM `lvrp_users_casiers` WHERE `SQLid`='".$_SESSION['MySQLid']."'");
			$dStats = mysql_fetch_array($rStats);
			
			echo '<article><div class="title">Profil</div><div class="new">';
			
			echo '<div style="text-align: center"><br /><big><b>' . $_SESSION['login'] . '</b></big><br /><br />',"\n"
                . '<a href="index.php?do=profil&amp;type=1"> Profil </a> | ',"\n"
				. '<a href="index.php?do=profil&amp;type=3"> Faction/Job </a> | ',"\n"
                . '<a href="index.php?do=profil&amp;type=4"> Biens </a> | ',"\n"
                . '<b> Casier </b> | ',"\n"
                . '<a href="index.php?do=profil&amp;type=6""> Inventaire</a></b></div><br />',"\n";
				
			echo '<table style="margin:auto; background:#ffffff; border:1px solid #1E1E1E; width:75%;" cellpadding="0" cellspacing="1">',"\n"
                . '<tr style="background: #1E1E1E"><td colspan="2" align="center" style="padding:2px"><font color="white"><b> Crime actuelle</b></font></td></tr>',"\n"
                . '<tr style="background: #00FFFA"><td align="left" valign="middle" style="width:100%; background:#ffffff">',"\n"
                . '<ul style="list-style-type:square;margin-left:25px">',"\n";
				if($dStats)
				{
					echo '<li><b>Nom du crime :</b> '.$dStats['Crime1'].'</li>
						  <li><b>Victime :</b> '.$dStats['Victim'].'</li>
						  <li><b>Témoin :</b> '.$dStats['Witness'].'</li>';
				}
				else
					{echo '<li><i>Vous n\'avez aucun crime en ce moment.</i></li>';}
			echo '</ul>',"\n"
                . '</td></table><br />',"\n";
				
			echo '<table style="margin:auto; background:#ffffff; border:1px solid #1E1E1E; width:75%;" cellpadding="0" cellspacing="1">',"\n"
                . '<tr style="background: #1E1E1E"><td colspan="2" align="center" style="padding:2px"><font color="white"><b>Casier judiciaire</b></font></td></tr>',"\n"
                . '<tr style="background: #00FFFA"><td align="left" valign="middle" style="width:100%; background:#ffffff">',"\n"
                . '<ul style="list-style-type:square;margin-left:25px">',"\n";
				if($dStats)
				{
					echo '<li><b>Crime(s) comis au total :</b> '.$dStats['Crimes'].'</li>
					      <li><b>Nombre de fois arrété :</b> '.$dStats['Arrested'].'</li>
					      <li><b>Ancien(s) crime(s) :</b></li>
						  <li>'.$dStats['Crime2'].'</b></li>
						  <li>'.$dStats['Crime3'].'</b></li>
						  <li>'.$dStats['Crime4'].'</b></li>
						  <li>'.$dStats['Crime5'].'</b></li>';
				}
				else
					{echo '<li><i>Vous n\'avez pas de casier.</i></li>';}
			echo '</ul>',"\n"
                . '</td></table><br />',"\n";
			
			echo '</div></article>';
		}
		else
			{site_ShowNotConnect();}
	}
	
	function profil_Fac()
	{
		if(isconnected())
		{
			$rStats = mysql_query("SELECT * FROM `lvrp_users` WHERE `Name`='".$_SESSION['login']."'");
			$dStats = mysql_fetch_array($rStats);

			if($dStats['Leader'] == $dStats['Member']) $dStats['Leader'] = 'Oui';
			else $dStats['Leader']="Non";
			
			echo '<article><div class="title">Profil</div><div class="new">';
			
			echo '<div style="text-align: center"><br /><big><b>' . $dStats['Name'] . '</big><br /><br />',"\n"
                . '<a href="index.php?do=profil&amp;type=1"> Profil </a> | ',"\n"
				. '<b>Faction/Job </b> | ',"\n"
                . '<a href="index.php?do=profil&amp;type=4"> Biens </a> | ',"\n"
                . '<a href="index.php?do=profil&amp;type=5"> Casier </a> | ',"\n"
                . '<a href="index.php?do=profil&amp;type=6""> Inventaire</a></b></div><br />',"\n";
				
			if($dStats['Member'] > 0)
			{
				echo '<table style="margin:auto; background:#ffffff; border:1px solid #1E1E1E; width:75%;" cellpadding="0" cellspacing="1">',"\n"
					. '<tr style="background: #1E1E1E"><td colspan="2" align="center" style="padding:2px"><font color="white"><b>Faction</b></font></td></tr>',"\n"
					. '<tr style="background: #00FFFA"><td align="left" valign="middle" style="width:100%; background:#ffffff">',"\n"
					. '<ul style="list-style-type:square;margin-left:25px">',"\n"
					. '<li><b>Faction :</b> ' . get_FacName($dStats['Member']).'</li>',"\n"
					. '<li><b>Leader :</b> ' . $dStats['Leader'] . '</li>',"\n"
					. '<li><b>Rang :</b> ' .get_FacRank($dStats['Member'],$dStats['Rank']). ' ('.$dStats['Rank'].')</li>',"\n"
					. '<li><b>Temps de travail : </b> ' . $dStats['DutyTime'] . ' minute(s)</li>',"\n"
					. '</ul>',"\n"
					. '</td></table><br />',"\n";
			}
			else
			{
				echo '<table style="margin:auto; background:#ffffff; border:1px solid #1E1E1E; width:75%;" cellpadding="0" cellspacing="1">',"\n"
					. '<tr style="background: #1E1E1E"><td colspan="2" align="center" style="padding:2px"><font color="white"><b>Faction</b></font></td></tr>',"\n"
					. '<tr style="background: #00FFFA"><td align="left" valign="middle" style="width:100%; background:#ffffff">',"\n"
					. '<ul style="list-style-type:square;margin-left:25px">',"\n"
					. '<li><i>Vous ne faites parti d\'aucunes factions.</i></li>',"\n"
					. '</ul>',"\n"
					. '</td></table><br />',"\n";
			}
			
			if($dStats['Job'] > 0)
			{
				echo '<table style="margin:auto; background:#ffffff; border:1px solid #1E1E1E; width:75%;" cellpadding="0" cellspacing="1">',"\n"
					. '<tr style="background: #1E1E1E"><td colspan="2" align="center" style="padding:2px"><font color="white"><b>Job</b></font></td></tr>',"\n"
					. '<tr style="background: #00FFFA"><td align="left" valign="middle" style="width:100%; background:#ffffff">',"\n"
					. '<ul style="list-style-type:square;margin-left:25px">',"\n"
					. '<li><b>Job :</b> ' . get_JobName($dStats['Job']).'</li>',"\n"
					. '<li><b>Niveau :</b> ' . $dStats['JobLvl'] . '</li>',"\n"
					. '<li><b>Expérience :</b> ' .$dStats['JobExp'].'</li>',"\n"
					. '<li><b>Bonus : $</b> ' .$dStats['JobBonnus'].'</li>',"\n"
					. '<li><b>Temps de travail : </b> ' . $dStats['JobTime'] . ' minute(s)</li>',"\n"
					. '</ul>',"\n"
					. '</td></table><br />',"\n";
			}
			else
			{
				echo '<table style="margin:auto; background:#ffffff; border:1px solid #1E1E1E; width:75%;" cellpadding="0" cellspacing="1">',"\n"
					. '<tr style="background: #1E1E1E"><td colspan="2" align="center" style="padding:2px"><font color="white"><b>Job</b></font></td></tr>',"\n"
					. '<tr style="background: #00FFFA"><td align="left" valign="middle" style="width:100%; background:#ffffff">',"\n"
					. '<ul style="list-style-type:square;margin-left:25px">',"\n"
					. '<li><i>Vous ne faites parti d\'aucun jobs.</i></li>',"\n"
					. '</ul>',"\n"
					. '</td></table><br />',"\n";
			}
			
			echo '</div></article>';
		}
		else
			{site_ShowNotConnect();}
	}
	
	function profil_Inv()
	{
		if(isconnected())
		{
			echo '<article><div class="title">Profil</div><div class="new">';
			$rStats = mysql_query("SELECT * FROM `lvrp_users` WHERE `Name`='".$_SESSION['login']."'");
			$dStats = mysql_fetch_array($rStats);
			echo '<div style="text-align: center"><br /><big><b>' . $dStats['Name'] . '</b></big><br /><br />',"\n"
                . '<a href="index.php?do=profil&amp;type=1"> Profil </a> | ',"\n"
				. '<a href="index.php?do=profil&amp;type=3"> Faction/Job </a> | ',"\n"
                . '<a href="index.php?do=profil&amp;type=4"> Biens </a> | ',"\n"
                . '<a href="index.php?do=profil&amp;type=5"> Casier </a> | ',"\n"
                . '<b> Inventaire</a></b></div><br />',"\n";
				
			echo '<table style="margin:auto; background:#ffffff; border:1px solid #1E1E1E; width:75%;" cellpadding="0" cellspacing="1">',"\n"
                . '<tr style="background: #1E1E1E"><td colspan="2" align="center" style="padding:2px"><font color="white"><b> Arme(s)</b></font></td></tr>',"\n"
                . '<tr style="background: #00FFFA"><td align="left" valign="middle" style="width:100%; background:#ffffff">',"\n"
                . '<ul style="list-style-type:square;margin-left:25px">',"\n";
				if($dStats['InvWeapon1'] == 0 && $dStats['InvWeapon2'] == 0 && $dStats['InvWeapon3'] == 0 && $dStats['InvWeapon4'] == 0 && ($dStats['InvWeapon5'] == 0 && $dStats['InvDev5'] == 1) && ($dStats['InvWeapon6'] == 0 && $dStats['InvDev6'] == 1))
					echo ('<li><i>Vous n\'avez pas d\'armes dans votre inventaire.</i></li>');
				if($dStats['InvWeapon1'] != 0 && $dStats['InvAmmo1'] != 0) echo ('<li><b>Arme slot 1 :</b> '.get_WepName($dStats['InvWeapon1']).' ('.$dStats['InvAmmo1'].' balle(s)) </li>');
				if($dStats['InvWeapon2'] != 0 && $dStats['InvAmmo2'] != 0) echo ('<li><b>Arme slot 2 :</b> '.get_WepName($dStats['InvWeapon2']).' ('.$dStats['InvAmmo2'].' balle(s)) </li>');
				if($dStats['InvWeapon3'] != 0 && $dStats['InvAmmo3'] != 0) echo ('<li><b>Arme slot 3 :</b> '.get_WepName($dStats['InvWeapon3']).' ('.$dStats['InvAmmo3'].' balle(s)) </li>');
				if($dStats['InvWeapon4'] != 0 && $dStats['InvAmmo4'] != 0) echo ('<li><b>Arme slot 4 :</b> '.get_WepName($dStats['InvWeapon4']).' ('.$dStats['InvAmmo4'].' balle(s)) </li>');
				if($dStats['InvWeapon4'] != 0 && $dStats['InvAmmo5'] != 0) echo ('<li><b>Arme slot 5 :</b> '.get_WepName($dStats['InvWeapon5']).' ('.$dStats['InvAmmo5'].' balle(s)) </li>');
				if($dStats['InvWeapon4'] != 0 && $dStats['InvAmmo6'] != 0) echo ('<li><b>Arme slot 6 :</b> '.get_WepName($dStats['InvWeapon6']).' ('.$dStats['InvAmmo6'].' balle(s)) </li>');

			echo '</ul>',"\n"
                . '</td></table><br />',"\n";
				
			echo '<table style="margin:auto; background:#ffffff; border:1px solid #1E1E1E; width:75%;" cellpadding="0" cellspacing="1">',"\n"
                . '<tr style="background: #1E1E1E"><td colspan="2" align="center" style="padding:2px"><font color="white"><b> Divers</b></font></td></tr>',"\n"
                . '<tr style="background: #00FFFA"><td align="left" valign="middle" style="width:100%; background:#ffffff">',"\n"
                . '<ul style="list-style-type:square;margin-left:25px">',"\n";
				if($dStats['Weed'] > 0) echo ('<li><b>Weed :</b> '.$dStats['Weed'].' gramme(s)</li>');
				if($dStats['SeedWeed'] > 0) echo ('<li><b>Graine(s) de weed :</b> '.$dStats['SeedWeed'].' </li>');
				if($dStats['Heroine'] > 0) echo ('<li><b>Heroïne :</b> '.$dStats['Heroine'].' gramme(s)</li>');
				if($dStats['Cocaine'] > 0) echo ('<li><b>Cocaïne :</b> '.$dStats['Cocaine'].' gramme(s)</li>');
				if($dStats['Ecstasie'] > 0) echo ('<li><b>Ecstasie :</b> '.$dStats['Ecstasie'].' gramme(s)</li>');
				if($dStats['Tabac'] > 0) echo ('<li><b>Tabac :</b> '.$dStats['Tabac'].' </li>');
				if($dStats['Leaf'] > 0) echo ('<li><b>Feuilles :</b> '.$dStats['Leaf'].' </li>');
				if($dStats['Materials'] > 0) echo ('<li><b>Matériaux :</b> '.$dStats['Materials'].' </li>');
			echo '</ul>',"\n"
                . '</td></table><br />',"\n";
				
			echo '</div></article>';
		}
		else
			{site_ShowNotConnect();}
	}
	
	function profil_Stats()
	{
		if(isconnected())
		{
			$rStats = mysql_query("SELECT * FROM `lvrp_users` WHERE `Name`='".$_SESSION['login']."'");
			$dStats = mysql_fetch_array($rStats);

			if($dStats['Origin'] == '1') $dStats['Origin'] = 'Vice City';
			elseif($dStats['Origin'] == '2') $dStats['Origin'] = 'Liberty City';
			elseif($dStats['Origin'] == '3') $dStats['Origin'] = 'Chinatown';
			elseif($dStats['Origin'] == '4') $dStats['Origin'] = 'San Fierro';
			elseif($dStats['Origin'] == '5') $dStats['Origin'] = 'Las Venturas';
			
			if($dStats['City'] == '1') $dStats['City'] = 'Los Santos';
			elseif($dStats['City'] == '2') $dStats['City'] = 'San Fierro';
			elseif($dStats['City'] == '3') $dStats['City'] = 'Las Venturas';
			elseif($dStats['City'] == '4') $dStats['City'] = 'Fort Carson';
			
			if($dStats['CarLic'] == '0') $dStats['CarLic'] = 'Non acquis';
			elseif($dStats['CarLic'] == '1') $dStats['CarLic'] = 'Acquis';
			
			if($dStats['FlyLic'] == '0') $dStats['FlyLic'] = 'Non acquis';
			elseif($dStats['FlyLic'] == '1') $dStats['FlyLic'] = 'Acquis';
			
			if($dStats['BoatLic'] == '0') $dStats['BoatLic'] = 'Non acquis';
			elseif($dStats['BoatLic'] == '1') $dStats['BoatLic'] = 'Acquis';
			
			if($dStats['MotoLic'] == '0') $dStats['MotoLic'] = 'Non acquis';
			elseif($dStats['MotoLic'] == '1') $dStats['MotoLic'] = 'Acquis';
			
			if($dStats['LourdLic'] == '0') $dStats['LourdLic'] = 'Non acquis';
			elseif($dStats['LourdLic'] == '1') $dStats['LourdLic'] = 'Acquis';
			
			if($dStats['FishLic'] == '0') $dStats['FishLic'] = 'Non acquis';
			elseif($dStats['FishLic'] == '1') $dStats['FishLic'] = 'Acquis';
			
			if($dStats['TrainLic'] == '0') $dStats['TrainLic'] = 'Non acquis';
			elseif($dStats['TrainLic'] == '1') $dStats['TrainLic'] = 'Acquis';
			
			if($dStats['Sex'] == '1') $dStats['Sex'] = 'Homme';
			elseif($dStats['Sex'] == '2') $dStats['Sex'] = 'Femme';
			
			if($dStats['PhoneNr'] == '0') $dStats['PhoneNr'] = 'Aucun';
			
			if($dStats['Connected'] == '0') $dStats['Connected'] = 'Non';
			else $dStats['Connected'] = '<font color="red">Oui</font>';
			
			$age = $dStats['Level']+16;
			
			echo '<article><div class="title">Profil</div><div class="new">';
			
			echo '<div style="text-align: center;"><br /><big><b>' . $dStats['Name'] . '</b></big><br /><br />',"\n"
                . '<b> Profil </b> | ',"\n"
				. '<a href="index.php?do=profil&amp;type=3"> Faction/Job </a> | ',"\n"
                . '<a href="index.php?do=profil&amp;type=4"> Biens </a> | ',"\n"
                . '<a href="index.php?do=profil&amp;type=5"> Casier </a> | ',"\n"
                . '<a href="index.php?do=profil&amp;type=6""> Inventaire</a></b></div><br />',"\n";
				
			echo '<table style="margin:auto; background:#ffffff; border:1px solid #1E1E1E; width:75%;" cellpadding="0" cellspacing="1">',"\n"
                . '<tr style="background: #1E1E1E"><td colspan="2" align="center" style="padding:2px"><font color="white"><b>Compte</b></font></td></tr>',"\n"
                . '<tr style="background: #00FFFA"><td align="left" valign="middle" style="width:100%; background:#ffffff">',"\n"
                . '<ul style="list-style-type:square;margin-left:25px">',"\n"
                . '<li><b>Actuellement connecté IG :</b> ' . $dStats['Connected'] .'</li>',"\n"
                . '<li><b>Temps de jeu :</b> ' . $dStats['ConnectedTime'] . ' heure(s)</li>',"\n"
                . '<li><b>Avertissement(s) :</b> ' . $dStats['Warnings'] . '</li>',"\n"
                . '<li><b>Email : </b> ' . $dStats['Email'] . '</li>',"\n"
                . '</ul>',"\n"
                . '</td></table><br />',"\n";
				
			echo '<table style="margin:auto; background:#ffffff; border:1px solid #1E1E1E; width:75%;" cellpadding="0" cellspacing="1">',"\n"
                . '<tr style="background: #1E1E1E"><td colspan="2" align="center" style="padding:2px"><font color="white"><b>Le personnage</b></font></td></tr>',"\n"
                . '<tr style="background: #00FFFA"><td align="left" valign="middle" style="width:100%; background:#ffffff">',"\n"
                . '<ul style="list-style-type:square;margin-left:25px">',"\n"
                . '<li><b>Identité :</b> ' . $dStats['Name'] .'</li>',"\n"
                . '<li><b>Age :</b> ' .$age. ' ans</li>',"\n"
                . '<li><b>Level :</b> ' . $dStats['Level'] . '</li>',"\n"
                . '<li><b>Origine : </b> ' . $dStats['Origin'] . '</li>',"\n"
                . '<li><b>Sexe : </b> ' . $dStats['Sex'] . '</li>',"\n"
				. '<li><b>Ville de résidence : </b> ' . $dStats['City'] . '</li>',"\n"
				. '<li><b>Numéro de téléphone : </b> ' . $dStats['PhoneNr'] . '</li>',"\n"
				. '<li><b>Cash : </b> $' . $dStats['Cash'] . '</li>',"\n"
				. '<li><b>Compte en banque : </b> $' . $dStats['Bank'] . '</li>',"\n"
				. '<li><b>Première langue : </b> ' . get_LangName($dStats['Lang1']) . '</li>',"\n"
				. '<li><b>Deuxième langue : </b> ' . get_LangName($dStats['Lang2']) . '</li>',"\n"
                . '</ul>',"\n"
                . '</td>',"\n"
                . '<td align="right" valign="middle" style="padding:5px; background:#ffffff">',"\n"
                . '<img style="border: 0; overflow: auto; max-width: 100px; width: expression(this.scrollWidth >= 100? \'100px\' : \'auto\');" src="../images/SKINS/' . $dStats['Skin'] . '.jpg" alt="" />',"\n"
                . '</td></tr></table><br />',"\n";
				
			echo '<table style="margin:auto; background:#ffffff; border:1px solid #1E1E1E; width:75%;" cellpadding="0" cellspacing="1">',"\n"
                . '<tr style="background: #1E1E1E"><td colspan="2" align="center" style="padding:2px"><font color="white"><b>Les permis</b></font></td></tr>',"\n"
                . '<tr style="background: #00FFFA"><td align="left" valign="middle" style="width:100%; background:#ffffff">',"\n"
                . '<ul style="list-style-type:square;margin-left:25px">',"\n"
                . '<li><b>Permis conduire :</b> ' . $dStats['CarLic'] .'</li>',"\n"
                . '<li><b>Permis de vol :</b> ' . $dStats['FlyLic'] . '</li>',"\n"
                . '<li><b>Permis de navigation :</b> ' . $dStats['BoatLic'] . '</li>',"\n"
                . '<li><b>Permis moto : </b> ' . $dStats['MotoLic'] . '</li>',"\n"
                . '<li><b>Permis poids lourd : </b> ' . $dStats['LourdLic'] . '</li>',"\n"
				. '<li><b>Permis de pêche : </b> ' . $dStats['FishLic'] . '</li>',"\n"
				. '<li><b>Permis de train : </b> ' . $dStats['TrainLic'] . '</li>',"\n"
                . '</ul>',"\n"
                . '</td></table><br />',"\n";
				
				
			echo '</div></article>';
		}
		else
			{site_ShowNotConnect();}
	}
?>