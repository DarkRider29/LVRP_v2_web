<script language="JavaScript">
function desactiver(id) {
doc = document.getElementById(id);
doc.disabled = "disabled";
doc.value="Patientez...";
if(id=='vote1')
	{window.location = "index.php?do=vote&type=1"}
if(id=='vote2')
	{window.location = "index.php?do=vote&type=2"}
}
</script>
<aside>
			<?php
				if(!$pun_user['is_guest'])
				{
					echo '<div class="title">Gagne des tokens !</div>
						<div class="in">
							<br/><b>
							Voici un moyen simple de gagner 0.5 à 1 tokens toutes les 2 heures. Il vous suffit de voter pour nous en cliquant sur les boutons ci-dessous.</b>
							<br/><br/>';
					if(vote_GetTime(1) <= 2)
					{
						echo '<form>
							<input type="submit" class="buton_b" disabled name="test" value="2 heures">
						</form>';
					}
					else
					{
						echo '<form">
							<input type="submit" id="vote1" class="buton_b" name="test" value="Root Top" onclick="desactiver(this.id);">
						</form>';
					}
					if(vote_GetTime(2) <= 2)
					{
						echo '<form>
							<input type="submit" class="buton_b" disabled name="test" value="2 heures">
						</form>';
					}
					else
					{
						echo '<form>
							<input type="submit" id="vote2" class="buton_b" name="test" value="GTA Top" onclick="desactiver(this.id);">
						</form>';
					}
					echo '</div><br/>';
				}
			?>
				<div class="title">ReSEAUX SOCIAUX</div>
				<div class="in">
					<br/>
					<?php echo '<a href="http://'.$Server['FaceBook'].'"><img src="../images/fb.jpg"/></a> 
					<a href="http://'.$Server['Twitter'].'"><img src="../images/tt.jpg"/></a> <br/><br/>';?>
				</div>
				<br/>				
				<div class="title">Serveur SA:MP</div>
				<div class="in">
				<br/>
				<?php
						$sampquery = new SampQuery($Server['Address'], $Server['Port']);
						if($sampquery->isOnline()) 
						{
							$sinfos = $sampquery->getInfo();
							echo '<b>'.$sinfos['hostname'].'</b>';
							echo '<br/><br/>';
							echo '<b>Joueur(s) : </b>' .$sinfos['players']. '/' .$sinfos['maxplayers'].'<br/>';
							echo '<b>Version : </b>'.$sinfos['gamemode'].'<br/>';
							echo '<b>Map : </b>'.$sinfos['mapname'].'<br/><br/>';
							echo '<b><a href="samp://'.$Server['Address'].':'.$Server['Port'].'"> Connexion au serveur</a></b><br/><br/>';
						}
						else
							{echo '<b>Le serveur est Hors Ligne.<br/><br/></b>';}
				?>
				</div>
				<br/>
				<div class="title">Serveur TeamSpeak 3</div>
				<div class="in">
				<br/>
				<?php
					echo 'Ip : 5.39.0.117<br /><br/> <b><a href="ts3server://5.39.0.117:'.$Server['TS_Port'].'"> Connexion au TeamSpeak</a></b>';
				?>
				</div>
				<!--<br/> 
				<div class="title">Partenaire</div>
				<div class="in">
				<br/><a href="http://www.timz.fr/"><img src="images/timz.png"/></a><br/><br/>
				</div> -->
				<br/>
			</aside>