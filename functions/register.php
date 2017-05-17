<?php
	function register_Step1()
	{
		if(isconnected())
			{site_show('accueil','-',true,0,'index.php?do=accueil'); break;}
		else
		{
			echo '<article><div class="title">Inscription</div>
			<div class="new"><br/>
			<center>Les inscriptions sont temporairement désactivées.</center><br/>
			</form></div></article>';
			/*
			$_SESSION['register']=1;
			echo '<article><div class="title">Inscription</div>
			<div class="new">
			<br/>
			<div class="title2">Etape 1</div>';

			echo '<form name="ques" method="post" action="index.php?do=register&amp;step=2">';
			$id=0;
			while($id<15)
			{
				$idsql=$id+1;
				$rQuestion = mysql_query("SELECT * FROM `lvrp_server_questions` WHERE `id`='".$idsql."'");
				$dQ = mysql_fetch_array($rQuestion);
				echo '<p style="text-indent:2em"><font size="2.5"><b>Question '.$idsql.' :</b></font> '.$dQ['question'].'<br/>';
				echo '
						<INPUT checked type="radio" name="R'.$idsql.'" value="1"> '.$dQ['R1'].'<br/>
						<INPUT type="radio" name="R'.$idsql.'" value="2"> '.$dQ['R2'].'<br/>
						<INPUT type="radio" name="R'.$idsql.'" value="3"> '.$dQ['R3'].'<br/><br/>';
				$id++;
			}
			echo '
			<center><input type="submit" name="submit" id="send" value="Valider" /></center>
			</form></div></article>';*/
		}
	}
	function register_Step2()
	{
		if(isconnected())
			{site_show('accueil','-',true,0,'index.php?do=accueil'); break;}
		else
		{
			if($_SESSION['register']==1)
			{
				$score=0;
				$id=0;
				while($id<15)
				{
					$idsql=$id+1;
					$rQuestion = mysql_query("SELECT * FROM `lvrp_server_questions` WHERE `id`='".$idsql."'");
					$dQ = mysql_fetch_array($rQuestion);
					if($dQ['reponseJuste'] == $_POST['R'.$idsql.''])
						{$score++;}
					$id++;
				}
			}
			else
				{site_show('accueil','-',true,0,'index.php?do=accueil'); break;}
				
			if($score==15)
				{$_SESSION['register']=2;}
			else
			{
			}
			if($_SESSION['register']==2)
			{
				echo '<article><div class="title">Inscription</div>
					<div class="new">
					<br/>
					<div class="title2">Etape 2</div>
					<center>
					<form name="ques" method="post" action="index.php?do=register_s3">
					Prénom_Nom :<br/><input type="text" name="name" size="30" maxlength="30" />
					<br/><br/>
					Email :<br/><input type="email" name="email" size="30" maxlength="64" />
					<br/><br/>
					Retapez votre Email :<br/><input type="email" name="email2" size="30" maxlength="64" />
					<br/><br/>
					Mot de passe :<br/><input type="password" name="pass1" size="30" maxlength="64" />
					<br/><br/>
					Retapez votre Mot de passe :<br/><input type="password" name="pass2" size="30" maxlength="64" />
					<br/><br/>
					Sexe : <br/>
					<select>
						<option selected value=0>Sélectionnez</option>
						<option  value=1>Homme</option>
						<option  value=2>Femme</option>
					</select>
					<br/><br/>
					Origine : <br/>
					<select>
						<option selected value=0>Sélectionnez</option>
						<option  value=1>Vice City</option>
						<option  value=2>Liberty City</option>
						<option  value=3>Chinatown Wars</option>
						<option  value=4>Los Santos</option>
						<option  value=5>San Fierro</option>
						<option  value=6>Las Venturas</option>
						<option  value=7>Fort Carson</option>
					</select>
					<br/><br/>
					Langue IG : <br/>
					<select>
						<option selected value=0>Sélectionnez</option>
						';
						$id=1;
						while($id<18)
						{
							echo '<option  value='.$id.'>'.get_LangName($id).'</option>';
							$id++;
						}
						echo '
					</select>
					<br/><br/>
					Ville de résidence : <br/>
					<select>
					<option selected value=0>Sélectionnez</option>';
					$rCities = mysql_query("SELECT * FROM `rpa_cities` WHERE `id`=1");
					$dCities = mysql_fetch_array($rCities);
					if($dCities['LosSantos'] == 1)
						{echo '<option  value=1>Los Santos</option>';}
					if($dCities['SanFierro'] == 1)
						{echo '<option  value=2>San Fierro</option>';}
					if($dCities['LasVenturas'] == 1)
						{echo '<option  value=3>Las Venturas</option>';}
					if($dCities['FortCarson'] == 1)
						{echo '<option  value=4>Fort Carson</option>';}
					
				echo '</select>
					<br/><br/>';
				
				echo '
					<center><input type="submit" name="submit" id="send" value="Valider" /></center>
					</form></center></div></article>';
			}
		}
	}
?>