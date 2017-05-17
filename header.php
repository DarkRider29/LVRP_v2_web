<?php

/**
 * Copyright (C) 2008-2012 FluxBB
 * based on code by Rickard Andersson copyright (C) 2002-2008 PunBB
 * License: http://www.gnu.org/licenses/gpl.html GPL version 2 or higher
 */

// Make sure no one attempts to run this script "directly"
if (!defined('PUN'))
	exit;

// Send no-cache headers
header('Expires: Thu, 21 Jul 1977 07:30:00 GMT'); // When yours truly first set eyes on this world! :)
header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache'); // For HTTP/1.0 compatibility

// Send the Content-type header in case the web server is setup to send something else
header('Content-type: text/html; charset=utf-8');

// Load the template
if (defined('PUN_ADMIN_CONSOLE'))
	$tpl_file = 'admin.tpl';
else if (defined('PUN_HELP'))
	$tpl_file = 'help.tpl';
else
	$tpl_file = 'main.tpl';

if (file_exists(PUN_ROOT.'style/'.$pun_user['style'].'/'.$tpl_file))
{
	$tpl_file = PUN_ROOT.'style/'.$pun_user['style'].'/'.$tpl_file;
	$tpl_inc_dir = PUN_ROOT.'style/'.$pun_user['style'].'/';
}
else
{
	$tpl_file = PUN_ROOT.'include/template/'.$tpl_file;
	$tpl_inc_dir = PUN_ROOT.'include/user/';
}

$tpl_main = file_get_contents($tpl_file);

// START SUBST - <pun_include "*">
preg_match_all('%<pun_include "([^/\\\\]*?)\.(php[45]?|inc|html?|txt)">%i', $tpl_main, $pun_includes, PREG_SET_ORDER);

foreach ($pun_includes as $cur_include)
{
	ob_start();

	// Allow for overriding user includes, too.
	if (file_exists($tpl_inc_dir.$cur_include[1].'.'.$cur_include[2]))
		require $tpl_inc_dir.$cur_include[1].'.'.$cur_include[2];
	else if (file_exists(PUN_ROOT.'include/user/'.$cur_include[1].'.'.$cur_include[2]))
		require PUN_ROOT.'include/user/'.$cur_include[1].'.'.$cur_include[2];
	else
		error(sprintf($lang_common['Pun include error'], htmlspecialchars($cur_include[0]), basename($tpl_file)));

	$tpl_temp = ob_get_contents();
	$tpl_main = str_replace($cur_include[0], $tpl_temp, $tpl_main);
	ob_end_clean();
}
// END SUBST - <pun_include "*">


// START SUBST - <pun_language>
$tpl_main = str_replace('<pun_language>', $lang_common['lang_identifier'], $tpl_main);
// END SUBST - <pun_language>


// START SUBST - <pun_content_direction>
$tpl_main = str_replace('<pun_content_direction>', $lang_common['lang_direction'], $tpl_main);
// END SUBST - <pun_content_direction>


// START SUBST - <pun_head>
ob_start();

// Define $p if its not set to avoid a PHP notice
$p = isset($p) ? $p : null;

// Is this a page that we want search index spiders to index?
if (!defined('PUN_ALLOW_INDEX'))
	echo '<meta name="ROBOTS" content="NOINDEX, FOLLOW" />'."\n";

?>
<title><?php echo generate_page_title($page_title, $p) ?></title>
<link rel="stylesheet" type="text/css" href="style/<?php echo $pun_user['style'].'.css' ?>" />
<link rel="stylesheet" type="text/css" href="chat/css/shoutbox.css" />
<link rel="stylesheet" type="text/css" href="css/jquery.cleditor.css" />
<link rel="icon" href="images/icon.ico" type="image/x-icon">
<script src="include/jquery.cleditor.js"></script>
<link rel="stylesheet" media="screen" type="text/css" title="" href="css/site.css" />
		<div id="header">
			<div class="title"><?php echo $Server['Name']; ?></div>
			<div class="navigation">
				<ul>
					<li><a href="index.php">Accueil</a></li>
					<li class="active"><a href="forum.php">Forum</a>
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
							echo '<li><a href="#">Boutique</a>
							<ul>
								<li><a href="index.php?do=boutique&amp;type=token">Tokens</a></li>
								<li><a href="index.php?do=boutique&amp;type=buy">Achats</a></li>
							</ul>
							</li>
							';
						}
					?>
					<li><a href="#">Aide</a>
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
									<input class="buton_g" type="submit" name="login" id="send" value="Connexion" />
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
<?php

// <<< EZ BBcode
if (is_file(PUN_ROOT.'ez_bbcode.v1.0.php'))
{
	require PUN_ROOT.'ez_bbcode.v1.0.php';
} 
//  EZ BBcode >>>

if (defined('PUN_ADMIN_CONSOLE'))
{
	if (file_exists(PUN_ROOT.'style/'.$pun_user['style'].'/base_admin.css'))
		echo '<link rel="stylesheet" type="text/css" href="style/'.$pun_user['style'].'/base_admin.css" />'."\n";
	else
		echo '<link rel="stylesheet" type="text/css" href="style/imports/base_admin.css" />'."\n";
}

if (isset($required_fields))
{
	// Output JavaScript to validate form (make sure required fields are filled out)

?>
<script type="text/javascript">
/* <![CDATA[ */
function process_form(the_form)
{
	var required_fields = {
<?php
	// Output a JavaScript object with localised field names
	$tpl_temp = count($required_fields);
	foreach ($required_fields as $elem_orig => $elem_trans)
	{
		echo "\t\t\"".$elem_orig.'": "'.addslashes(str_replace('&#160;', ' ', $elem_trans));
		if (--$tpl_temp) echo "\",\n";
		else echo "\"\n\t};\n";
	}
?>
	if (document.all || document.getElementById)
	{
		for (var i = 0; i < the_form.length; ++i)
		{
			var elem = the_form.elements[i];
			if (elem.name && required_fields[elem.name] && !elem.value && elem.type && (/^(?:text(?:area)?|password|file)$/i.test(elem.type)))
			{
				alert('"' + required_fields[elem.name] + '" <?php echo $lang_common['required field'] ?>');
				elem.focus();
				return false;
			}
		}
	}
	return true;
}
/* ]]> */
</script>
<?php

}

// JavaScript tricks for IE6 and older
echo '<!--[if lte IE 6]><script type="text/javascript" src="style/imports/minmax.js"></script><![endif]-->'."\n";
$page_head['colorize_groups'] = '<style type="text/css">'.$GLOBALS['pun_colorize_groups']['style'].'</style>'; // need $GLOBALS for message function

if (basename($_SERVER['PHP_SELF']) == 'viewtopic.php')
{
	$page_head['jquery'] = '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>';

	if (file_exists(PUN_ROOT.'lang/'.$pun_user['language'].'/ajax_post_edit.php'))
		require PUN_ROOT.'lang/'.$pun_user['language'].'/ajax_post_edit.php';
	else
		require PUN_ROOT.'lang/English/ajax_post_edit.php';

	$ape = 'var base_url = \''.$pun_config['o_base_url'].'\';';
	$ape .= "\n".'var ape = {\'Loading\' : \''.$lang_ape['Loading'].'\'';
	$ape .= ', \'Quick edit\' : \''.$lang_ape['Quick Edit'].'\'';
	$ape .= ', \'Full edit\' : \''.$lang_ape['Full Edit'].'\'';
	$ape .= ', \'Cancel edit confirm\' : \''.$lang_ape['Cancel edit confirm'].'\'';
	if (isset($GLOBALS['forum_url'])) // friendly url integration
		$ape .= ', \'edit_url\' : \''.$GLOBALS['forum_url']['edit'].'\'';
	$ape .= '}';

	$page_head['ape'] = '<script type="text/javascript">'."\n".$ape."\n".'</script>';
	$page_head['ape_js'] = '<script type="text/javascript" src="include/ajax_post_edit/ajax_post_edit.js"></script>';
	$page_head['ape_css'] = '<link rel="stylesheet" type="text/css" href="include/ajax_post_edit/style.css" />';
}

if (isset($page_head))
	echo implode("\n", $page_head)."\n";

$tpl_temp = trim(ob_get_contents());
$tpl_main = str_replace('<pun_head>', $tpl_temp, $tpl_main);
ob_end_clean();
// END SUBST - <pun_head>


// START SUBST - <body>
if (isset($focus_element))
{
	$tpl_main = str_replace('<body onload="', '<body onload="document.getElementById(\''.$focus_element[0].'\').elements[\''.$focus_element[1].'\'].focus();', $tpl_main);
	$tpl_main = str_replace('<body>', '<body onload="document.getElementById(\''.$focus_element[0].'\').elements[\''.$focus_element[1].'\'].focus()">', $tpl_main);
}
// END SUBST - <body>


// START SUBST - <pun_page>
$tpl_main = str_replace('<pun_page>', htmlspecialchars(basename($_SERVER['PHP_SELF'], '.php')), $tpl_main);
// END SUBST - <pun_page>

/*$sampquery = new SampQuery($Server['Address'], $Server['Port']);
if($sampquery->isOnline()) 
{
	$sinfos = $sampquery->getInfo();
	$tpl_main = str_replace('<pun_desc>', '<div id="brddesc">Joueurs actuellement connectés : ' .$sinfos['players']. '/' .$sinfos['maxplayers'].'</div>', $tpl_main);
}
else
{
	$tpl_main = str_replace('<pun_desc>', '<div id="brddesc">Statue : Serveur SA:MP hors ligne</div>', $tpl_main);
}*/

// START SUBST - <pun_desc>
//$tpl_main = str_replace('<pun_desc>', '<div id="brddesc">'.$pun_config['o_board_desc'].'</div>', $tpl_main);
// END SUBST - <pun_desc>



// START SUBST - <pun_status>
$page_statusinfo = $page_topicsearches = array();

if ($pun_user['is_guest'])
	$page_statusinfo = '<p class="conl">'.$lang_common['Not logged in'].'</p>';
else
{
	$page_statusinfo[] = '<li>'.sprintf($lang_common['Last visit'], format_time($pun_user['last_visit'])).'</li>';

	if ($pun_user['is_admmod'])
	{
		if ($pun_config['o_report_method'] == '0' || $pun_config['o_report_method'] == '2')
		{
			$result_header = $db->query('SELECT 1 FROM '.$db->prefix.'reports WHERE zapped IS NULL') or error('Unable to fetch reports info', __FILE__, __LINE__, $db->error());

			if ($db->result($result_header))
				$page_statusinfo[] = '<li class="reportlink"><span><strong><a href="admin_reports.php">'.$lang_common['New reports'].'</a></strong></span></li>';
		}

		if ($pun_config['o_maintenance'] == '1')
			$page_statusinfo[] = '<li class="maintenancelink"><span><strong><a href="admin_options.php#maintenance">'.$lang_common['Maintenance mode enabled'].'</a></strong></span></li>';
	}

	if ($pun_user['g_read_board'] == '1' && $pun_user['g_search'] == '1')
	{
		$page_topicsearches[] = '<a href="search.php?action=show_replies" title="'.$lang_common['Show posted topics'].'">'.$lang_common['Posted topics'].'</a>';
		$page_topicsearches[] = '<a href="search.php?action=show_new" title="'.$lang_common['Show new posts'].'">'.$lang_common['New posts header'].'</a>';
	}
}

// Quick searches
if ($pun_user['g_read_board'] == '1' && $pun_user['g_search'] == '1')
{
	$page_topicsearches[] = '<a href="search.php?action=show_recent" title="'.$lang_common['Show active topics'].'">'.$lang_common['Active topics'].'</a>';
	$page_topicsearches[] = '<a href="search.php?action=show_unanswered" title="'.$lang_common['Show unanswered topics'].'">'.$lang_common['Unanswered topics'].'</a>';
}


// Generate all that jazz
$tpl_temp = '<div id="brdwelcome" class="inbox">';

// The status information
if (is_array($page_statusinfo))
{
	$tpl_temp .= "\n\t\t\t".'<ul class="conl">';
	$tpl_temp .= "\n\t\t\t\t".implode("\n\t\t\t\t", $page_statusinfo);
	$tpl_temp .= "\n\t\t\t".'</ul>';
}
else
	$tpl_temp .= "\n\t\t\t".$page_statusinfo;

// Generate quicklinks
if (!empty($page_topicsearches))
{
	$tpl_temp .= "\n\t\t\t".'<ul class="conr">';
	$tpl_temp .= "\n\t\t\t\t".'<li><span>'.$lang_common['Topic searches'].' '.implode(' | ', $page_topicsearches).'</span></li>';
	$tpl_temp .= "\n\t\t\t".'</ul>';
}

$tpl_temp .= "\n\t\t\t".'<div class="clearer"></div>'."\n\t\t".'</div><img height="160" width="900" src="img/LVRP2.png"/>';

$tpl_main = str_replace('<pun_status>', $tpl_temp, $tpl_main);
// END SUBST - <pun_status>



if ($pun_user['g_read_board'] == '1' && $pun_config['o_announcement'] == '1')
{
	ob_start();

?>
<div id="announce" class="block">
	<div class="hd"><h2><span><?php echo $lang_common['Announcement'] ?></span></h2></div>
	<div class="box">
		<div id="announce-block" class="inbox">
			<div class="usercontent"><?php echo $pun_config['o_announcement_message'] ?></div>
		</div>
	</div>
</div>
<?php

	$tpl_temp = trim(ob_get_contents());
	$tpl_main = str_replace('<pun_announcement>', $tpl_temp, $tpl_main);
	ob_end_clean();
}
else
	$tpl_main = str_replace('<pun_announcement>', '', $tpl_main);
// END SUBST - <pun_announcement>

// START SUBST - <pun_main>
ob_start();


define('PUN_HEADER', 1);
