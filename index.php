<?php
	/*
		index.php
		Développé par Dark_Rider
	*/
	
	// FluxBB
	define('PUN_ROOT', dirname(__FILE__).'/');
	require PUN_ROOT.'include/common.php';
	define('PUN_ALLOW_INDEX', 1);
	define('PUN_ACTIVE_PAGE', 'index');
	
	require PUN_ROOT.'header_site.php';
	
	if(isset($_GET['do']))
	{
		if($_GET['do']=='admin')
		{
			switch($_GET['cd'])
				{
					case 'index': admin_Index(); break;
					case 'log_a': log_Admin(); break;
					case 'log_k': log_Kick(); break;
					case 'log_p': log_Pay(); break;
					case 'log_c': log_Connect(); break;
					case 'log_b': log_Ban(); break;
					case 'news_index': news_Index(); break;
					case 'news_create': news_Create(); break;
					case 'news_create_2': news_CreateSave(); break;
					case 'news_sup': news_Delete($_GET['id']); break;
					case 'news_edit': news_Edit($_GET['id']); break;
					case 'news_edit_2': news_EditSave($_GET['id']); break;
				}
		}
		elseif($_GET['do']=='profil')
			{
				switch($_GET['type'])
				{
					case '1': profil_Stats(); break;
					case '3': profil_Fac(); break;
					case '4': profil_Biens(); break;
					case '5': profil_Casier(); break;
					case '6': profil_Inv(); break;
					case '7': profil_Vip(); break;
				}
			}
		elseif($_GET['do']=='help')
			{
				switch($_GET['type'])
				{
					case 'def': help_Def(); break;
					case 'rules': help_Rules(); break;
					case 'staff': help_Staff(); break;
				}
			}
		elseif($_GET['do']=='boutique')
			{
				switch($_GET['type'])
				{
					case 'token': boutique_Tokens(); break;
					case 'buy': boutique_Buy(); break;
					case 'achat1': boutique_BuyType(1); break;
					case 'achat2': boutique_BuyType(2); break;
					case 'achat3': boutique_BuyType(3); break;
					case 'achat4': boutique_BuyType(4); break;
					case 'achat5': boutique_BuyType(5); break;
					case 'achat6': boutique_BuyType(6); break;
					case 'achat7': boutique_BuyType(7); break;
					case 'achat8': boutique_BuyType(8); break;
					case 'achat9': boutique_BuyType(9); break;
					case 'achat10': boutique_BuyType(10); break;
					case 'achat11': boutique_BuyType(11); break;
					case 'achat12': boutique_BuyType(12); break;
					case 'achat13': boutique_BuyType(13); break;
					case 'achat14': boutique_BuyType(14); break;
				}
			}
		elseif($_GET['do']=='faction')
			{
				faction_Gestion($_GET['id']);
			}
		elseif($_GET['do']=='vote')
			{
				switch($_GET['type'])
				{
					case '1': 
					{
						if(vote_GetTime(1) > 2)
							{vote_Top(1);}
						else
							{echo '<meta http-equiv="refresh" content="0; URL=index.php">';}
						break;
					}
					case '2': 
					{
						if(vote_GetTime(2) > 2)
							{vote_Top(2);}
						else
							{echo '<meta http-equiv="refresh" content="0; URL=index.php">';}
						break;
					}
				}
			}
	}
	else
		{slider();new_Show();}
	require PUN_ROOT.'aside_site.php';
	require PUN_ROOT.'footer_site.php';
	$footer_style = 'index';
?>