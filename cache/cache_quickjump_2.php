<?php

if (!defined('PUN')) exit;
define('PUN_QJ_LOADED', 1);
$forum_id = isset($forum_id) ? $forum_id : 0;

?>				<form id="qjump" method="get" action="viewforum.php">
					<div><label><span><?php echo $lang_common['Jump to'] ?><br /></span>
					<select name="id" onchange="window.location=('viewforum.php?id='+this.options[this.selectedIndex].value)">
						<optgroup label="Le serveur">
							<option value="7"<?php echo ($forum_id == 7) ? ' selected="selected"' : '' ?>>Informations &amp; Annonces</option>
							<option value="8"<?php echo ($forum_id == 8) ? ' selected="selected"' : '' ?>>Règlement</option>
							<option value="9"<?php echo ($forum_id == 9) ? ' selected="selected"' : '' ?>>Présentation joueur/admins</option>
						</optgroup>
						<optgroup label="Demandes Administratives">
							<option value="10"<?php echo ($forum_id == 10) ? ' selected="selected"' : '' ?>>Récupérations de Comptes</option>
							<option value="18"<?php echo ($forum_id == 18) ? ' selected="selected"' : '' ?>>&nbsp;&nbsp;&nbsp;Acceptés</option>
							<option value="17"<?php echo ($forum_id == 17) ? ' selected="selected"' : '' ?>>&nbsp;&nbsp;&nbsp;Refusées</option>
							<option value="11"<?php echo ($forum_id == 11) ? ' selected="selected"' : '' ?>>Demandes de débannissements</option>
							<option value="16"<?php echo ($forum_id == 16) ? ' selected="selected"' : '' ?>>&nbsp;&nbsp;&nbsp;Acceptés</option>
							<option value="15"<?php echo ($forum_id == 15) ? ' selected="selected"' : '' ?>>&nbsp;&nbsp;&nbsp;Refusées</option>
							<option value="12"<?php echo ($forum_id == 12) ? ' selected="selected"' : '' ?>>Plaintes (Hors RôlePlay)</option>
							<option value="21"<?php echo ($forum_id == 21) ? ' selected="selected"' : '' ?>>&nbsp;&nbsp;&nbsp;Acceptés</option>
							<option value="13"<?php echo ($forum_id == 13) ? ' selected="selected"' : '' ?>>Bugs</option>
							<option value="20"<?php echo ($forum_id == 20) ? ' selected="selected"' : '' ?>>&nbsp;&nbsp;&nbsp;Site</option>
							<option value="19"<?php echo ($forum_id == 19) ? ' selected="selected"' : '' ?>>&nbsp;&nbsp;&nbsp;Serveur</option>
							<option value="14"<?php echo ($forum_id == 14) ? ' selected="selected"' : '' ?>>Suggestions (Idées)</option>
							<option value="23"<?php echo ($forum_id == 23) ? ' selected="selected"' : '' ?>>&nbsp;&nbsp;&nbsp;Site</option>
							<option value="22"<?php echo ($forum_id == 22) ? ' selected="selected"' : '' ?>>&nbsp;&nbsp;&nbsp;Serveur</option>
							<option value="24"<?php echo ($forum_id == 24) ? ' selected="selected"' : '' ?>>Reventes inactifs</option>
						</optgroup>
						<optgroup label="La Communauté">
							<option value="25"<?php echo ($forum_id == 25) ? ' selected="selected"' : '' ?>>Evènements</option>
							<option value="26"<?php echo ($forum_id == 26) ? ' selected="selected"' : '' ?>>Galerie de photos/vidéos</option>
							<option value="28"<?php echo ($forum_id == 28) ? ' selected="selected"' : '' ?>>&nbsp;&nbsp;&nbsp;Photos</option>
							<option value="27"<?php echo ($forum_id == 27) ? ' selected="selected"' : '' ?>>&nbsp;&nbsp;&nbsp;Vidéos</option>
							<option value="29"<?php echo ($forum_id == 29) ? ' selected="selected"' : '' ?>>Discussions générales</option>
							<option value="30"<?php echo ($forum_id == 30) ? ' selected="selected"' : '' ?>>GTA Modding</option>
							<option value="35"<?php echo ($forum_id == 35) ? ' selected="selected"' : '' ?>>&nbsp;&nbsp;&nbsp;Skins</option>
							<option value="34"<?php echo ($forum_id == 34) ? ' selected="selected"' : '' ?>>&nbsp;&nbsp;&nbsp;Armes</option>
							<option value="33"<?php echo ($forum_id == 33) ? ' selected="selected"' : '' ?>>&nbsp;&nbsp;&nbsp;Véhicules</option>
							<option value="32"<?php echo ($forum_id == 32) ? ' selected="selected"' : '' ?>>&nbsp;&nbsp;&nbsp;Autres</option>
							<option value="31"<?php echo ($forum_id == 31) ? ' selected="selected"' : '' ?>>&nbsp;&nbsp;&nbsp;Recherche de mods</option>
							<option value="36"<?php echo ($forum_id == 36) ? ' selected="selected"' : '' ?>>Tutoriaux</option>
							<option value="37"<?php echo ($forum_id == 37) ? ' selected="selected"' : '' ?>>&nbsp;&nbsp;&nbsp;RôlePlay</option>
							<option value="39"<?php echo ($forum_id == 39) ? ' selected="selected"' : '' ?>>&nbsp;&nbsp;&nbsp;Modding</option>
							<option value="38"<?php echo ($forum_id == 38) ? ' selected="selected"' : '' ?>>&nbsp;&nbsp;&nbsp;Guides</option>
						</optgroup>
					</select>
					<input type="submit" value="<?php echo $lang_common['Go'] ?>" accesskey="g" />
					</label></div>
				</form>
