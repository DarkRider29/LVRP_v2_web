<?php
	function boutique_Tokens()
	{
		if(isconnected())
		{
			$rStats = mysql_query("SELECT * FROM `lvrp_users` WHERE `Name`='".$_SESSION['login']."'");
			$dStats = mysql_fetch_array($rStats);
			
			echo '<article><div class="title">Tokens</div><div class="new">';
			echo '<br/><center><b>Vous disposez de <font color="red"> '.$dStats['Tokens'].'</font> token(s).<br/><br/>
			Commande de 100 tokens ci-dessous :</b></center>';
			echo '
			<div id="starpass_146281"></div>
			<script type="text/javascript" src="http://script.starpass.fr/script.php?idd=146281&amp;verif_en_php=1&amp;datas=">
			</script>
			<noscript>Veuillez activer le Javascript de votre navigateur s\'il vous pla&icirc;t.<br />
			<a href="http://www.starpass.fr/">Micro Paiement StarPass</a>
			</noscript>
			<i><b> * Nous ne sommes en aucuns cas responsable de la perte de votre code ou d\'un code incorrect. Ce service est sécurisé par STARPASS.
			<br/>Nous vous invitons à lire le <a href="http://www.starpass.fr/include/StarPass-CGU.pdf">CGU STARPASS</a></i>
			<br/></b>';
			echo '</div></article>';
		}
		else
			{site_ShowNotConnect();}
	}
	function boutique_Buy()
	{
		echo 'test';
		if(isconnected())
		{
			$rStats = mysql_query("SELECT * FROM `lvrp_users` WHERE `Name`='".$_SESSION['login']."'");
			$dStats = mysql_fetch_array($rStats);
			echo '<article><div class="title">Boutique</div><div class="new">';
			echo '<br/><center><b>Vous disposez de <font color="red"> '.$dStats['Tokens'].'</font> token(s).<br/><br/></b></center>';
			
			if(isconnectedIG())
				{echo '<b><center><font color="red">Attention, vous devez être déconnecté du serveur !</font></center></b><br/>';}
			
			echo '<table style="margin:auto; background:#ffffff; border:1px solid #1E1E1E; width:75%;" cellpadding="0" cellspacing="1">',"\n"
                . '<tr style="background: #1E1E1E"><td colspan="2" align="center" style="padding:2px"><font color="white"><b>Informations Générales</b></font></td></tr>',"\n"
                . '<tr style="background: #00FFFA"><td align="left" valign="middle" style="width:100%; background:#ffffff">',"\n"
                . '<ul style="list-style-type:square;margin-left:25px">',"\n";
			echo '</ul>',"\n"
                . '<b>
				Les packs VIP servent à payer les hébergements pour la continuité du serveur, en aucuns cas
				ils sont bénéfiques à des fins personnelles.<br/>
				<font color="green">Livraison immédiate après achat !</font></b>
				</td></table><br />',"\n";
			
			echo '<table style="margin:auto; background:#ffffff; border:1px solid #1E1E1E; width:75%;" cellpadding="0" cellspacing="1">',"\n"
                . '<tr style="background: #1E1E1E"><td colspan="2" align="center" style="padding:2px"><font color="white"><b>Informations Pack VIP</b></font></td></tr>',"\n"
                . '<tr style="background: #00FFFA"><td align="left" valign="middle" style="width:100%; background:#ffffff">',"\n"
                . '<ul style="list-style-type:square;margin-left:25px">',"\n";
			echo '<li><b>Cannal VIP</li>';
			echo '<li>Possibilité de mettre son armure à 50 toutes les 30 mns</li>';
			echo '<li>Possibilité de changer de skin</li>';
			echo '<li>Accès aux PM</li>';
			echo '<li>Titre \'VIP\' sur les canaux</li></b>';
			echo '</ul>',"\n"
                . '<center><b><font color="green">Valable pour tout les pack VIP.</font></b></center></td>
				</table><br />',"\n";
			
			echo '<table style="margin:auto; background:#ffffff; border:1px solid #1E1E1E; width:75%;" cellpadding="0" cellspacing="1">',"\n"
                . '<tr style="background: #1E1E1E"><td colspan="2" align="center" style="padding:2px"><font color="white"><b>Pack VIP Fer</b></font></td></tr>',"\n"
                . '<tr style="background: #00FFFA"><td align="left" valign="middle" style="width:100%; background:#ffffff">',"\n"
                . '<ul style="list-style-type:square;margin-left:25px">',"\n";
			echo '<li><b>+ 1 Slot de véhicule en plus</li>';
			echo '<li>+ 1 Rename</li>';
			echo '<li>+ 1 Changement de numéro personnalisé</li>';
			echo '<li>+ 2 Points de respect</li></b>';
			echo '<br/><b><font color="blue"> Coût : 100 tokens</font></b>';
			echo '<br/><b><font color="red"> Durée 48 heures de jeu</font></b>';
			echo '</ul>',"\n"
                . '<center><form  name="form1" method="post" action="boutique.php?do=achat1">
					<input  type="submit" name="submit" id="send" value="Acheter" />
				</form></center></td>
				</table><br />',"\n";
				
			echo '<table style="margin:auto; background:#ffffff; border:1px solid #1E1E1E; width:75%;" cellpadding="0" cellspacing="1">',"\n"
                . '<tr style="background: #1E1E1E"><td colspan="2" align="center" style="padding:2px"><font color="white"><b>Pack VIP Argent</b></font></td></tr>',"\n"
                . '<tr style="background: #00FFFA"><td align="left" valign="middle" style="width:100%; background:#ffffff">',"\n"
                . '<ul style="list-style-type:square;margin-left:25px">',"\n";
			echo '<li><b>+ 1 Slot de véhicule en plus</li>';
			echo '<li>+ 2 Renames</li>';
			echo '<li>+ 1 Changement de numéro personnalisé</li>';
			echo '<li>+ 1 Changement de plaque</li>';
			echo '<li>+ 4 Points de respect</li>';
			echo '<li>+ $5.000</li></b>';
			echo '<br/><b><font color="blue"> Coût : 300 tokens</font></b>';
			echo '<br/><b><font color="red"> Durée 96 heures de jeu</font></b>';
			echo '</ul>',"\n"
                . '<center><form  name="form1" method="post" action="boutique.php?do=achat1">
					<input  type="submit" name="submit" id="send" value="Acheter" />
				</form></center></td>
				</table><br />',"\n";
				
			echo '<table style="margin:auto; background:#ffffff; border:1px solid #1E1E1E; width:75%;" cellpadding="0" cellspacing="1">',"\n"
                . '<tr style="background: #1E1E1E"><td colspan="2" align="center" style="padding:2px"><font color="white"><b>Pack VIP Or</b></font></td></tr>',"\n"
                . '<tr style="background: #00FFFA"><td align="left" valign="middle" style="width:100%; background:#ffffff">',"\n"
                . '<ul style="list-style-type:square;margin-left:25px">',"\n";
			echo '<li><b>+ 2 Slots de véhicule en plus</li>';
			echo '<li>+ 3 Renames</li>';
			echo '<li>+ 1 Changement de numéro personnalisé</li>';
			echo '<li>+ 2 Changements de plaque</li>';
			echo '<li>+ 8 Points de respect</li>';
			echo '<li>+ $10.000</li>';
			echo '<li>+ Accès au sac VIP (+2 Slots d\'arme et 750 Kg Max.)</li></b>';
			echo '<br/><b><font color="blue"> Coût : 500 tokens</font></b>';
			echo '<br/><b><font color="red"> Durée 192 heures de jeu</font></b>';
			echo '</ul>',"\n"
                . '<center><form  name="form1" method="post" action="boutique.php?do=achat1">
					<input  type="submit" name="submit" id="send" value="Acheter" />
				</form></center></td>
				</table><br />',"\n";
				
			echo '<table style="margin:auto; background:#ffffff; border:1px solid #1E1E1E; width:75%;" cellpadding="0" cellspacing="1">',"\n"
                . '<tr style="background: #1E1E1E"><td colspan="2" align="center" style="padding:2px"><font color="white"><b>Pack VIP Diamant</b></font></td></tr>',"\n"
                . '<tr style="background: #00FFFA"><td align="left" valign="middle" style="width:100%; background:#ffffff">',"\n"
                . '<ul style="list-style-type:square;margin-left:25px">',"\n";
			echo '<li><b>+ 3 Slots de véhicule en plus</li>';
			echo '<li>+ 4 Renames</li>';
			echo '<li>+ 2 Changements de numéro personnalisé</li>';
			echo '<li>+ 2 Changements de plaque</li>';
			echo '<li>+ 16 Points de respect</li>';
			echo '<li>+ $25.000</li>';
			echo '<li>+ Accès au sac VIP (+2 Slots d\'arme et 750 Kg Max.)</li></b>';
			echo '<br/><b><font color="blue"> Coût : 800 tokens</font></b>';
			echo '<br/><b><font color="red"> Durée 384 heures de jeu</font></b>';
			echo '</ul>',"\n"
                . '<center><form  name="form1" method="post" action="boutique.php?do=achat1">
					<input  type="submit" name="submit" id="send" value="Acheter" />
				</form></center></td>
				</table><br />',"\n";
				
			echo '<table style="margin:auto; background:#ffffff; border:1px solid #1E1E1E; width:75%;" cellpadding="0" cellspacing="1">',"\n"
                . '<tr style="background: #1E1E1E"><td colspan="2" align="center" style="padding:2px"><font color="white"><b>Argent</b></font></td></tr>',"\n"
                . '<tr style="background: #00FFFA"><td align="left" valign="middle" style="width:100%; background:#ffffff">',"\n"
                . '<ul style="list-style-type:square;margin-left:25px">',"\n";
			echo '<li><b>+ $1.000</b>';
			echo '<br/><b><font color="blue"> Coût : 25 tokens</font></b>';
			echo '<form  name="form1" method="post" action="boutique.php?do=achat1">
					<input  type="submit" name="submit" id="send" value="Acheter" />
				</form></li>';
			echo '<li><b>+ $2.500</b>';
			echo '<br/><b><font color="blue"> Coût : 50 tokens</font></b>';
			echo '<form  name="form1" method="post" action="boutique.php?do=achat1">
					<input  type="submit" name="submit" id="send" value="Acheter" />
				</form></li>';
			echo '<li><b>+ $5.000</b>';
			echo '<br/><b><font color="blue"> Coût : 100 tokens</font></b>';
			echo '<form  name="form1" method="post" action="boutique.php?do=achat1">
					<input  type="submit" name="submit" id="send" value="Acheter" />
				</form></li>';
			echo '<li><b>+ $10.000 </b>';
			echo '<br/><b><font color="blue"> Coût : 200 tokens</font></b>';
			echo '<form  name="form1" method="post" action="boutique.php?do=achat1">
					<input  type="submit" name="submit" id="send" value="Acheter" />
				</form></li>';
			echo '<li><b>+ $20.000</b>';
			echo '<br/><b><font color="blue"> Coût : 250 tokens</font></b>';
			echo '<form  name="form1" method="post" action="boutique.php?do=achat1">
					<input  type="submit" name="submit" id="send" value="Acheter" />
				</form></li>';
			echo '</ul>',"\n"
                . '<b>Notre but n\'est pas de vous faire évoler avec de l\'argent IRL et ni de vous arnaquer,
				nous avons décidé de faire des pack argent mais pas dans le but de nous enrichir, c\'est pour cela qu\'il sont
				chère et vous obligeront à gagner de l\'argent en travaillant IG.</b></td>
				</table><br />',"\n";
				
			echo '<table style="margin:auto; background:#ffffff; border:1px solid #1E1E1E; width:75%;" cellpadding="0" cellspacing="1">',"\n"
                . '<tr style="background: #1E1E1E"><td colspan="2" align="center" style="padding:2px"><font color="white"><b>Autres</b></font></td></tr>',"\n"
                . '<tr style="background: #00FFFA"><td align="left" valign="middle" style="width:100%; background:#ffffff">',"\n"
                . '<ul style="list-style-type:square;margin-left:25px">',"\n";
			echo '<li><b>+ 1 Rename</b>';
			echo '<br/><b><font color="blue"> Coût : 50 tokens</font></b>';
			echo '<form  name="form1" method="post" action="boutique.php?do=achat1">
					<input  type="submit" name="submit" id="send" value="Acheter" />
				</form></li>';
			echo '<li><b>+ 1 Changement de numéro</b>';
			echo '<br/><b><font color="blue"> Coût : 50 tokens</font></b>';
			echo '<form  name="form1" method="post" action="boutique.php?do=achat1">
					<input  type="submit" name="submit" id="send" value="Acheter" />
				</form></li>';
			echo '<li><b>+ 1 Changement de plaque</b>';
			echo '<br/><b><font color="blue"> Coût : 50 tokens</font></b>';
			echo '<form  name="form1" method="post" action="boutique.php?do=achat1">
					<input  type="submit" name="submit" id="send" value="Acheter" />
				</form></li>';
			echo '<li><b>+ 1 Respect</b>';
			echo '<br/><b><font color="blue"> Coût : 20 tokens</font></b>';
			echo '<form  name="form1" method="post" action="boutique.php?do=achat1">
					<input  type="submit" name="submit" id="send" value="Acheter" />
				</form></li>';
			echo '<li><b>+ 1 Level</b>';
			echo '<br/><b><font color="blue"> Coût : 400 tokens</font></b>';
			echo '<form  name="form1" method="post" action="boutique.php?do=achat1">
					<input  type="submit" name="submit" id="send" value="Acheter" />
				</form></li>';
			echo '</ul>',"\n"
                . '</td>
				</table><br />',"\n";
				
			echo '</div></article>';
		}
		else
			{site_ShowNotConnect();}
	}
?>