##
##
##        Mod title:  Rate useful or not useful each post with thumbs
##
##      Mod version:  1.0
##  Works on FluxBB:  1.4.0, 1.4.1, 1.4.2, 1.4.3, 1.4.4
##     Release date:  2010-12-29
##
##           Author:  AFL / Fra2591 - www.theworlddebating.com / International debate forum
 Inspired by the mod "thanks for post" by Fepalkon (fepalkon@gmail.com)
##
##      Description:  Allows users to rate each post by putting a thumb up or down.
##
##   Affected files:  viewtopic.php
##		      style/Your_style.css
##                    include/functions.php
##		      profile.php
##					  
##
##       Affects DB:  Yes
##
##       DISCLAIMER:  Please note that "mods" are not officially supported by
##                    FluxBB. Installation of this modification is done at 
##                    your own risk. Backup your forum database and any and
##                    all applicable files before proceeding.
##
#---------[ 1. UPLOAD ]-------------------------------------------------------
#

install_mod.php to /your_forum_file/

files/lang/English/thanks.php to /your_forum_file/lang/English/
files/lang/English/thanks2.php to /your_forum_file/lang/English/
files/tumbup.png to /your_forum_file/img/
files/tumbdown.png to /your_forum_file/img/
files/thanks2.php to /your_forum_file/
files/thanks.php to /your_forum_file/




#
#---------[ 2. RUN ]----------------------------------------------------------
#

install_mod.php

#
#---------[ 3. DELETE ]-------------------------------------------------------
#

install_mod.php

#
#---------[ 4. OPEN ]---------------------------------------------------------
#

viewtopic.php

#
#---------[ 5. FIND ]---------------------------------------------
#

require PUN_ROOT.'lang/'.$pun_user['language'].'/topic.php';

#
#---------[ 6. AFTER, ADD ]---------------------------------------------------
#

if (file_exists(PUN_ROOT.'lang/'.$pun_user['language'].'/thanks.php'))
	require PUN_ROOT.'lang/'.$pun_user['language'].'/thanks.php';
else
	require PUN_ROOT.'lang/English/thanks.php';
	
if (file_exists(PUN_ROOT.'lang/'.$pun_user['language'].'/thanks2.php'))
	require PUN_ROOT.'lang/'.$pun_user['language'].'/thanks2.php';
else
	require PUN_ROOT.'lang/English/thanks2.php';
	
#
#---------[ 7. FIND ]---------------------------------------------
#

	$post_count++;
	$user_avatar = '';
	$user_info = array();
	$user_contacts = array();
	$post_actions = array();
	$is_online = '';
	$signature = '';

#
#---------[ 8. AFTER, ADD ]-------------------------------------------------
#


$users_thanks = array();
	
	$result_thanks = $db->query('SELECT thanks_by, thanks_by_id FROM '.$db->prefix.'thanks WHERE post_id='.$cur_post['id']) or error('Unable to fetch thanks info', __FILE__, __LINE__, $db->error());
	while ($thanks = $db->fetch_assoc($result_thanks))
	{
		if ($pun_user['g_view_users'] == '1' && $thanks['thanks_by_id'] > 1)
			$users_thanks[] = '<a href="profile.php?id='.$thanks['thanks_by_id'].'">'.pun_htmlspecialchars($thanks['thanks_by']).'</a>';
		else
			$users_thanks[] = pun_htmlspecialchars($thanks['thanks_by']);
	}
	$num_thanks = count($users_thanks);
	
$users_thanks2 = array();
	
	$result_thanks2 = $db->query('SELECT thanks_by, thanks_by_id FROM '.$db->prefix.'thanks2 WHERE post_id='.$cur_post['id']) or error('Unable to fetch thanks info', __FILE__, __LINE__, $db->error());
	while ($thanks2 = $db->fetch_assoc($result_thanks2))
	{
		if ($pun_user['g_view_users'] == '1' && $thanks2['thanks_by_id'] > 1)
			$users_thanks2[] = '<a href="profile.php?id='.$thanks2['thanks_by_id'].'">'.pun_htmlspecialchars($thanks2['thanks_by']).'</a>';
		else
			$users_thanks2[] = pun_htmlspecialchars($thanks2['thanks_by']);
	}
	$num_thanks2 = count($users_thanks2);


#
#---------[ 9. FIND ]---------------------------------------------
#

if (($cur_topic['post_replies'] == '' && $pun_user['g_post_replies'] == '1') || $cur_topic['post_replies'] == '1')
				$post_actions[] = '<li class="postquote"><span><a href="post.php?tid='.$id.'&amp;qid='.$cur_post['id'].'">'.$lang_topic['Quote'].'</a></span></li>';

#
#---------[ 10. AFTER, ADD ]---------------------------------------------------
#


if (($cur_topic['post_replies'] == '' && $pun_user['g_can_thanks'] == '1'))
				$post_actions[] = '<li class="postthanks2"><span><a href="thanks2.php?tid='.$id.'&amp;pid='.$cur_post['id'].'">'.$lang_thanks2['Say Thanks'].'</a></span></li>';
				
if (($cur_topic['post_replies'] == '' && $pun_user['g_can_thanks'] == '1'))
				$post_actions[] = '<li class="postthanks"><span><a href="thanks.php?tid='.$id.'&amp;pid='.$cur_post['id'].'">'.$lang_thanks['Say Thanks'].'</a></span></li>';


#
#---------[ 11. FIND ]---------------------------------------------
#

		$post_actions[] = '<li class="postedit"><span><a href="edit.php?id='.$cur_post['id'].'">'.$lang_topic['Edit'].'</a></span></li>';
		$post_actions[] = '<li class="postquote"><span><a href="post.php?tid='.$id.'&amp;qid='.$cur_post['id'].'">'.$lang_topic['Quote'].'</a></span></li>';

#
#---------[ 12. AFTER, ADD ]---------------------------------------------------
#


		$post_actions[] = '<li class="postthanks2"><span><a href="thanks2.php?tid='.$id.'&amp;pid='.$cur_post['id'].'">'.$lang_thanks2['Say Thanks'].'</a></span></li>';
		$post_actions[] = '<li class="postthanks"><span><a href="thanks.php?tid='.$id.'&amp;pid='.$cur_post['id'].'">'.$lang_thanks['Say Thanks'].'</a></span></li>';


#
#---------[ 13. FIND ]---------------------------------------------
#

				<div class="postright">

#
#---------[ 14. AFTER, ADD ---------------------------------------------------
#

<div class="thanks2">
<?php echo sprintf($lang_thanks2['Thanks'], $num_thanks2);
?><img src="img/thumbup.png" width="31" height="26" align="absbottom" oncontextmenu="return false">&nbsp;&nbsp;&nbsp;<?php echo sprintf($lang_thanks['Thanks'], $num_thanks);
?><img src="img/thumbdown.png" width="30" height="25" align="absbottom" oncontextmenu="return false">
</div>

#
#---------[ 15. OPEN ]---------------------------------------------------------
#

style/Your_style.css

#
#---------[ 16. AT THE END, ADD ]---------------------------------------------------
#

.pun .thanks2 {
	margin-top: 5px;
	margin-right: 5%;
	float:right;
}


#
#---------[ 17. OPEN ]---------------------------------------------------------
#

include/functions.php

#
#---------[ 18. FIND ]---------------------------------------------
#

		// Delete any subscriptions for this topic
	$db->query('DELETE FROM '.$db->prefix.'topic_subscriptions WHERE topic_id='.$topic_id) or error('Unable to delete subscriptions', __FILE__, __LINE__, $db->error());

#
#---------[ 19. AFTER, ADD ]---------------------------------------------------
#

		// Delete any thanks for this post
	$db->query('DELETE FROM '.$db->prefix.'thanks WHERE topic_id='.$topic_id) or error('Unable to delete thanks', __FILE__, __LINE__, $db->error());
	// Delete any thanks for this post
	$db->query('DELETE FROM '.$db->prefix.'thanks2 WHERE topic_id='.$topic_id) or error('Unable to delete thanks', __FILE__, __LINE__, $db->error());

	
#
#---------[ 20. FIND ]---------------------------------------------
#

	// Delete the post
	$db->query('DELETE FROM '.$db->prefix.'posts WHERE id='.$post_id) or error('Unable to delete post', __FILE__, __LINE__, $db->error());	
	
#
#---------[ 21. AFTER, ADD ]---------------------------------------------------
#	
	
	// Delete any thanks for this post
	$db->query('DELETE FROM '.$db->prefix.'thanks WHERE post_id='.$post_id) or error('Unable to delete thanks', __FILE__, __LINE__, $db->error());
	// Delete any thanks for this post
	$db->query('DELETE FROM '.$db->prefix.'thanks2 WHERE post_id='.$post_id) or error('Unable to delete thanks', __FILE__, __LINE__, $db->error());


#
#---------[ 22. OPEN ]---------------------------------------------------------
#

profile.php

#
#---------[ 23. FIND ]---------------------------------------------
#

		// Should we delete all posts made by this user?
		if (isset($_POST['delete_posts']))
		{
		
#
#---------[ 24. AFTER, ADD ]---------------------------------------------------
#

			$db->query('UPDATE '.$db->prefix.'thanks SET thanks_by_id=1 WHERE thanks_by_id='.$id) or error('Unable to update thanks', __FILE__, __LINE__, $db->error());
			$db->query('UPDATE '.$db->prefix.'thanks2 SET thanks_by_id=1 WHERE thanks_by_id='.$id) or error('Unable to update thanks', __FILE__, __LINE__, $db->error());


#
#---------[ 25. FIND ]---------------------------------------------
#

		else
			// Set all his/her posts to guest
			$db->query('UPDATE '.$db->prefix.'posts SET poster_id=1 WHERE poster_id='.$id) or error('Unable to update posts', __FILE__, __LINE__, $db->error());
		
#
#---------[ 26. REPLACE BY ]---------------------------------------------------
#

		else
		{
			// Set all his/her posts to guest
			$db->query('UPDATE '.$db->prefix.'posts SET poster_id=1 WHERE poster_id='.$id) or error('Unable to update posts', __FILE__, __LINE__, $db->error());
			
			$db->query('UPDATE '.$db->prefix.'thanks SET thanks_by_id=1 WHERE thanks_by_id='.$id) or error('Unable to update thanks', __FILE__, __LINE__, $db->error());
				
			$db->query('UPDATE '.$db->prefix.'thanks2 SET thanks_by_id=1 WHERE thanks_by_id='.$id) or error('Unable to update thanks', __FILE__, __LINE__, $db->error());	
		}
		
		
#
#---------[ 27. FIND ]---------------------------------------------
#

if ($username_updated)
	{

#
#---------[ 28. AFTER, ADD ]---------------------------------------------------
#

		$db->query('UPDATE '.$db->prefix.'thanks SET thanks_by=\''.$db->escape($form['username']).'\' WHERE thanks_by_id='.$id) or error('Unable to update thanks', __FILE__, __LINE__, $db->error());
		$db->query('UPDATE '.$db->prefix.'thanks2 SET thanks_by=\''.$db->escape($form['username']).'\' WHERE thanks_by_id='.$id) or error('Unable to update thanks', __FILE__, __LINE__, $db->error());


#
#---------[ 29. SAVE/UPLOAD ]-------------------------------------------------
#