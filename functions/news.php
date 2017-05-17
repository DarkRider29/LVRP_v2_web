<?php
	function new_Show()
	{
		$rNews = mysql_query("SELECT * FROM `lvrp_site_news` ORDER BY `id` DESC LIMIT 0,3");
		while($dNews = mysql_fetch_array($rNews))
		{ 
			echo '<div class="title">'.$dNews['Title'].'</div>
			<div class="new">
			<b>'.$dNews['Contenu'].'
			<div class="date"><br/>le '.date('d/m/Y',$dNews['Date']).', par '.$dNews['Autor'].'</b></div>
			</div><br/>';
		}
	}
?>