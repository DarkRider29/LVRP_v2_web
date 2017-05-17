<?php
// Ez BBcode V1.0
// Jquery and Php, BBcode insert tool
// By Supraname (supraname@gmail.com)
// 2011 GNU GPL License

// Language
	if (file_exists(PUN_ROOT.'lang/'.$pun_user['language'].'/ez_bbcode.php')){
	require PUN_ROOT.'lang/'.$pun_user['language'].'/ez_bbcode.php';
	}
	else {
	require PUN_ROOT.'lang/English/ez_bbcode.php';
	}

// 64 Color palette building
function palette(){
$coul = array('00','55','AA','FF');
$col = array();
$ct = 0; $ct1 = 0; $ct2 = 0; $ct3 = 0;
	while ($ct < 64){
	$hex = $coul[$ct1].$coul[$ct2].$coul[$ct3];
	$col[] = "									<option value=\"$hex\">$hex</option>\n";
	$ct3 ++; $ct++;
	if ($ct3 == 4){$ct3 = 0; $ct2 ++;}
	if ($ct2 == 4){$ct2 = 0; $ct1 ++;}
	}
return implode("", $col);
}

// Main function
function ez_bbcode($lang_ez_bbcode){

	// BBcode table of BBcode text format tool
	$bbcode = array(
		'[b][/b]' => array('[b]#1[/b]',$lang_ez_bbcode['bold'].' [b][/b]', 'b_ico.png', $lang_ez_bbcode['title_bold']),
		'[i][/i]' => array('[i]#1[/i]', $lang_ez_bbcode['italic'].' [i][/i]', 'i_ico.png', $lang_ez_bbcode['title_italic']),
		'[u][/u]' => array('[u]#1[/u]', $lang_ez_bbcode['underline'].' [u][/u]', 'u_ico.png', $lang_ez_bbcode['title_underline']),
		'[s][/s]' => array('[s]#1[/s]', $lang_ez_bbcode['striketh'].' [s][/s]', 's_ico.png', $lang_ez_bbcode['title_striketh']),
		'[url][/url]' => array('[url]#1[/url]', $lang_ez_bbcode['link'].' [url][/url]', 'url_ico.png', $lang_ez_bbcode['title_link']),
		'[url=][/ur]' => array('[url=#2]#1[/url]', $lang_ez_bbcode['link_more'].' [url=*][/url]', 'url_add_ico.png', $lang_ez_bbcode['title_link_more']),
		'[email][/email]' => array('[email]#1[/email]', $lang_ez_bbcode['email'].' [email][/email]', 'email_ico.png', $lang_ez_bbcode['title_email']),
		'[email=][/email]' => array('[email=#2]#1[/email]', $lang_ez_bbcode['email_more'].' [email=*][/email]', 'email_add_ico.png', $lang_ez_bbcode['title_email_more']),
		'[img][/img]' => array('[img]#1[/img]', $lang_ez_bbcode['image'].' [img=]*[/img]', 'img_ico.png', $lang_ez_bbcode['title_image']),
		'[img=][/img]' => array('[img=#1]#2[/img]', $lang_ez_bbcode['image_more'].' [img=]*[/img]', 'img_add_ico.png', $lang_ez_bbcode['title_image_more']),
		'[quote][/quote]' => array('[quote]#1[/quote]', $lang_ez_bbcode['quote'].' [quote][/quote]', 'quote_ico.png', $lang_ez_bbcode['title_quote']),
		'[quote=][/quote]' => array('[quote=#2]#1[/quote]', $lang_ez_bbcode['quote_more'].' [quote=*][/quote]', 'quote_add_ico.png', $lang_ez_bbcode['title_quote_more']),
		'[code][/code]' => array('[code]#1[/code]', $lang_ez_bbcode['code'].' [code][/code]', 'code_ico.png', $lang_ez_bbcode['title_code']),
		'[list][/list]' => array('[list]#1[/list]', $lang_ez_bbcode['list'].' [list][/list]', 'list_ico.png', $lang_ez_bbcode['title_list']),
		'[*][/*]' => array('[*]#1[/*]', $lang_ez_bbcode['list_item'].' [*][/*]', 'li_ico.png', $lang_ez_bbcode['title_list_item']),
		'[h][/h]' => array('[h]#1[/h]', $lang_ez_bbcode['header'].' [h][/h]', 'h1_ico.png', $lang_ez_bbcode['title_header']),
		'[ins][/ins]' => array('[ins]#1[/ins]', $lang_ez_bbcode['ins_text'].' [ins][/ins]', 'ins_ico.png', $lang_ez_bbcode['title_ins_text']),
		
	);
	
	// BBcode table of smileys
	$bbcode_smile = array(
		'smile' => array(':)', $lang_ez_bbcode['smile'], 'smile.png', $lang_ez_bbcode['title_smile']),
		'neutral' => array(':|', $lang_ez_bbcode['neutral'], 'neutral.png', $lang_ez_bbcode['title_neutral']),
		'sad' => array(':(', $lang_ez_bbcode['sad'], 'sad.png', $lang_ez_bbcode['title_sad'],),
		'big_smile' => array(':D', $lang_ez_bbcode['big_smile'], 'big_smile.png', $lang_ez_bbcode['title_big_smile']),
		'yikes' => array(':O', $lang_ez_bbcode['yikes'], 'yikes.png', $lang_ez_bbcode['title_yikes']),
		'wink' => array(';)', $lang_ez_bbcode['wink'], 'wink.png', $lang_ez_bbcode['title_wink']),
		'hmm' => array(':/', $lang_ez_bbcode['hmm'], 'hmm.png', $lang_ez_bbcode['title_hmm']),
		'tongue' => array(':P', $lang_ez_bbcode['tongue'], 'tongue.png', $lang_ez_bbcode['title_tongue']),
		'lol' => array(':lol:', $lang_ez_bbcode['lol'], 'lol.png', $lang_ez_bbcode['title_lol']),
		'mad' => array(':mad:', $lang_ez_bbcode['mad'], 'mad.png', $lang_ez_bbcode['title_mad']),
		'roll' => array(':rolleyes:', $lang_ez_bbcode['roll'], 'roll.png', $lang_ez_bbcode['title_roll']),
		'cool' => array(':cool:', $lang_ez_bbcode['smile'], 'cool.png', $lang_ez_bbcode['title_cool'])
	);	
	
	// Menu building
	$menu = '';
	$menu .= "	<div id=\"ez_bbcode_menu\" style=\"display:none\">\n";
	
		// Insert while of text bbcode
		foreach ($bbcode as $clef => $tableau){
		$menu .= "							<img src=\"./ez_bbcode/icon/".$tableau[2]."\" width=\"16\" height=\"16\" alt=\"".$tableau[1]."\" class=\"ez_bbcode_ico\" title=\"".$tableau[3]."\" onclick=\"javascript:str = '".$tableau[0]."'\" />\n";
		};
		
	$menu .= "								<select name=\"colour\" id=\"ez_bbcode_select_color\">\n";
	$menu .= palette();
	$menu .= "								</select>\n";
	$menu .= "							<br /> \n";
	
		// Insert while of smyley BBcode
		foreach ($bbcode_smile as $clef => $tableau){
		$menu .= "							<img src=\"./img/smilies/".$tableau[2]."\" width=\"16\" height=\"16\" alt=\"".$tableau[1]."\" class=\"ez_bbcode_ico\" title=\"".$tableau[3]."\" onclick=\"javascript:str = '".$tableau[0]."'\" />\n";
		};
	$menu .= "						</div>\n";
	return $menu;
}
?>

<link rel="stylesheet" type="text/css" href="./ez_bbcode/css/ez_bbcode_style.css" />

<?php 
echo '<script type="text/javascript" src="./ez_bbcode/js/jquery-1.4.3.min.js"></script>'; // <== Comment or delete this row if you already use Jquery in your FluxBB forum 
?>


<script type="text/javascript">
/* <![CDATA[ */
<?php /*Check if Jquery is loaded, if yes he load javascript contents */ ?>
	if (typeof jQuery != 'undefined') { 
	var ez_bbcode_select_color = '<?php echo $lang_ez_bbcode['ch_color']; ?>';
	var ez_bbcode_ico_color = '<?php echo $lang_ez_bbcode['color']; ?>';
	var ez_bbcode_title_ico_color = '<?php echo $lang_ez_bbcode['title_color']; ?>';
	document.write("\<script type=\"text/javascript\" src=\"./ez_bbcode/js/ez_bbcode.js\">\<\/script>");
	}
/* ]]> */
</script>

