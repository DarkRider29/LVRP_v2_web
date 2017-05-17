<?php

/******************************************************************************************************
		Reputation Plugin for PunBB
		----------------------------
-- Version 2.2.6
-- (c) Copyright 2006-2009 hcs  hcs@mail.ru

-- GPL:
  This software is free software; you can redistribute it and/or modify it
  under the terms of the GNU General Public License as published
  by the Free Software Foundation; either version 2 of the License,
  or (at your option) any later version.

  This software is distributed in the hope that it will be useful, but
  WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place, Suite 330, Boston,
  MA  02111-1307  USA
******************************************************************************************************/



// This following function will be called when the user presses the "Install" button.
function install()
{
	global $db, $db_type, $pun_config;
	
	switch ($db_type)
	{
		case 'mysql':
		case 'mysqli':

		
		
		
		$result = $db->query('ALTER TABLE '.$db->prefix.'users ADD COLUMN rep_minus INT(11) UNSIGNED DEFAULT 0') or error('Unable to add column reputation_minus into table '.$db->prefix.'users.',  __FILE__, __LINE__, $db->error());
			
		$result = $db->query('ALTER TABLE '.$db->prefix.'users ADD COLUMN rep_plus INT(11) UNSIGNED DEFAULT 0') or error('Unable to add column  rep_plus into table '.$db->prefix.'users.',  __FILE__, __LINE__, $db->error());	
	
	
		
		$result = $db->query('SELECT user_id, SUM(rep_plus) AS rep_plus, SUM(rep_minus) AS rep_minus FROM '.$db->prefix.'reputation  GROUP BY user_id') or error('Unable to get reputation data to convert table users', __FILE__, __LINE__, $db->error()); 		
		
		while ($cur_rep = $db->fetch_assoc($result))
		{

			$db->query('UPDATE '.$db->prefix.'users SET rep_plus='.$cur_rep['rep_plus'].', rep_minus='.$cur_rep['rep_minus'].'  WHERE  id='.$cur_rep['user_id']) or error('Unable to update reputation data for users', __FILE__, __LINE__, $db->error()); 		;

		}

			break;

	}


	$db->close();
}


define('PUN_ROOT', './');
require PUN_ROOT.'include/common.php';

// We want the complete error message if the script fails
if (!defined('PUN_DEBUG'))
	define('PUN_DEBUG', 1);


$style = (isset($cur_user)) ? $cur_user['style'] : $pun_config['o_default_style'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $mod_title ?> installation</title>
<link rel="stylesheet" type="text/css" href="style/<?php echo $pun_config['o_default_style'].'.css' ?>" />
</head>
<body>

<div id="punwrap">
<div id="puninstall" class="pun" style="margin: 10% 20% auto 20%">

<?php

install();

?>
<div class="block">
	<h2><span>Installation successful</span></h2>
	<div class="box">
		<div class="inbox">
			<p>Your database has been successfully prepared for <?php echo pun_htmlspecialchars($mod_title) ?>. See readme.txt for further instructions.</p>
		</div>
	</div>
</div>
</div>
</div>

</body>
</html>