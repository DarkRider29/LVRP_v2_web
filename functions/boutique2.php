<?php
	function boutique_Show()
	{
		if(isconnected())
		{
			include('functions/server.php');
			
			$rStats = mysql_query("SELECT * FROM `lvrp_users` WHERE `Name`='".$_SESSION['login']."'");
			$dStats = mysql_fetch_array($rStats);
			
			echo '<div style="text-align: center"><br /><big><b>Boutique</b></big><br /><br />',"\n"
                . '<b> Infos </b> | ',"\n"
                . '<a href="index.php?do=boutique_token"> Tokens </a> | ',"\n"
                . '<a href="index.php?do=boutique_buy""> Achats</a></b></div><br />',"\n";
				
			echo '<div class="saut_de_page"></div>
			Bienvenue dans la boutique de '.$Server['Name'].', c\'est dans cette section que vous retrouverez les avantages payant du serveur.
			 Cest avantages ne sont pas obligatoires pour vous. <br/> Sachez que les avantages permettent de payer la machine qui héberge le serveur, en
			  aucun cas, ils sont à des fins personnelles.<br/><br/><div align="right">Merci de votre compréhension</div>
			  <div class="saut_de_page"></div>';
			 
			if($dStats['Connected'] == '0') $dStats['Connected'] = 'Non';
			else $dStats['Connected'] = '<font color="red">Oui</font>';
			
			if($dStats['DonateRank'] >= '3') $dStats['DonateRank'] = 'Oui';
			else $dStats['DonateRank'] = 'Non';
			
			$viph = $dStats['VipTime']/60;
			 
			echo '<table style="margin:auto; background:#ffffff; border:1px solid #00CDFF; width:75%;" cellpadding="0" cellspacing="1">',"\n"
                . '<tr style="background: #00CDFF"><td colspan="2" align="center" style="padding:2px"><b>Informations</b></td></tr>',"\n"
                . '<tr style="background: #00FFFA"><td align="left" valign="middle" style="width:100%; background:#ffffff">',"\n"
                . '<ul style="list-style-type:square;margin-left:25px">',"\n"
				. '<li><b>Actuellement connecté IG :</b> '.$dStats['Connected'].'</li>',"\n"
				. '<li><b>Token(s) :</b> '.$dStats['Tokens'].'</li>',"\n"
				. '<li><b>V.I.P :</b> '.$dStats['DonateRank'].'</li>',"\n"
				. '<li><b>Temps restant :</b> '.$dStats['VipTime'].' m(s) ('.$viph.' h(s))</li>',"\n"
				;
			echo '</ul>',"\n"
                . '</td></table><br />',"\n";
		}
		else
			{site_ShowNotConnect();}
	}
	
	function boutique_Token()
	{
		if(isconnected())
		{
			include('functions/server.php');
			
			$rStats = mysql_query("SELECT * FROM `lvrp_users` WHERE `Name`='".$_SESSION['login']."'");
			$dStats = mysql_fetch_array($rStats);
			
			echo '<div style="text-align: center"><br /><big><b>Boutique</b></big><br /><br />',"\n"
                . '<a href="index.php?do=boutique"> Infos </a> | ',"\n"
                . '<b> Tokens </b> | ',"\n"
                . '<a href="index.php?do=boutique_Buy""> Achats</a></b></div><br />',"\n";
				
			echo '<center>Achat de 50 tokens.</center>';
			echo '<div id="starpass_146276"></div>
				<script type="text/javascript" src="http://script.starpass.fr/script.php?idd=146276&amp;verif_en_php=1&amp;datas=">
				</script>
				<noscript>Veuillez activer le Javascript de votre navigateur s\'il vous pla&icirc;t.<br />
				<a href="http://www.starpass.fr/">Micro Paiement StarPass</a>
				</noscript></br></br>';
				
			echo '<center>Achat de 100 tokens.</center>';
			echo '<div id="starpass_146281"></div>
				<script type="text/javascript" src="http://script.starpass.fr/script.php?idd=146281&amp;verif_en_php=1&amp;datas=">
				</script>
				<noscript>Veuillez activer le Javascript de votre navigateur s\'il vous pla&icirc;t.<br />
				<a href="http://www.starpass.fr/">Micro Paiement StarPass</a>
				</noscript></br>';
		}
		else
			{site_ShowNotConnect();}
	}
?>