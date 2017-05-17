<?php

/**
 * Copyright (C) 2008-2012 FluxBB
 * based on code by Rickard Andersson copyright (C) 2002-2008 PunBB
 * License: http://www.gnu.org/licenses/gpl.html GPL version 2 or higher
 * Page by Dark_Rider
 */

define('PUN_ROOT', dirname(__FILE__).'/');
require PUN_ROOT.'include/common.php';

if ($pun_user['g_read_board'] == '0')
	message($lang_common['No view']);

require PUN_ROOT.'header.php';

require PUN_ROOT.'include/ajax_chat.php';

$footer_style = 'index';
require PUN_ROOT.'footer.php';

?>