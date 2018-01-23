<?php

global $csrf_check;

include_once("./class/Database.class.php");

$database = new Database();

// 1 - Overwatch
// 2 - League of Legends
// 3 - Counter Strike
// 4 - Hearthstone

// TODO array of objects OR read from database

$games = array(1, 2, 3, 4);

$games_team = array(6, 5, 5, 1);
$games_reps = array(2, 2, 2, 0);

$games_name = array(
	"Overwatch",
	"League of Legends",
	"Counter Strike",
	"Hearthstone");

$games_short = array(
	"ow",
	"lol",
	"csgo",
	"hs");

$games_quote = array(
	"Ryu ga waga teki wo kurau ! Nooooo...",
	"Captain Teemo on duty !",
	"Rush B my friend ! Don't stop, don't stop...",
	"You face Jaraxxus,<br />eredar lord of the burning legion !");

$games_content = array(
	'<p style="text-align:center;">
		<b><i class="fa fa-user-circle" aria-hidden="true" style="padding-right: 5px;"></i></b> 6 joueurs par équipe
		<span style="padding: 0px 10px;">|</span>
		<b><i class="fa fa-calendar" aria-hidden="true" style="padding-right: 5px;"></i></b> Les Lundis (début le 26 Février)
		<span style="padding: 0px 10px;">|</span>
		<b><i class="fa fa-trophy" aria-hidden="true" style="padding-right: 5px;"></i></b> Récompenses à venir ;)
		<span style="padding: 0px 10px;">|</span>
		<b><i class="fa fa-line-chart" aria-hidden="true" style="padding-right: 5px;"></i></b> 34 équipes l\'année dernière<br /><br />
		<span style="padding: 10px;">Finale le <b style="font-weight:bold;">12 Mai</b></span><!--<br /><br />
		<a href="./files/rules_sgl2017.pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Télécharger le règlement</a>--></p><br />',

	'<p style="text-align:center;">
		<b><i class="fa fa-user-circle" aria-hidden="true" style="padding-right: 5px;"></i></b> 5 joueurs par équipe
		<span style="padding: 0px 10px;">|</span>
		<b><i class="fa fa-calendar" aria-hidden="true" style="padding-right: 5px;"></i></b> Les Mardis (début le 27 Février)
		<span style="padding: 0px 10px;">|</span>
		<b><i class="fa fa-trophy" aria-hidden="true" style="padding-right: 5px;"></i></b> Récompenses à venir ;)
		<span style="padding: 0px 10px;">|</span>
		<b><i class="fa fa-line-chart" aria-hidden="true" style="padding-right: 5px;"></i></b> 102 équipes l\'année dernière<br /><br />
		<span style="padding: 10px;">Finale le <b style="font-weight:bold;">5 Mai</b></span><!--<br /><br />
		<a href="./files/rules_sgl2017.pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Télécharger le règlement</a>--></p><br />',

	'<p style="text-align:center;">
		<b><i class="fa fa-user-circle" aria-hidden="true" style="padding-right: 5px;"></i></b> 5 joueurs par équipe
		<span style="padding: 0px 10px;">|</span>
		<b><i class="fa fa-calendar" aria-hidden="true" style="padding-right: 5px;"></i></b> Les Mercredis (début le 28 Février)
		<span style="padding: 0px 10px;">|</span>
		<b><i class="fa fa-trophy" aria-hidden="true" style="padding-right: 5px;"></i></b> Récompenses à venir ;)
		<span style="padding: 0px 10px;">|</span>
		<b><i class="fa fa-line-chart" aria-hidden="true" style="padding-right: 5px;"></i></b> 62 équipes l\'année dernière<br /><br />
		<span style="padding: 10px;">Finale le <b style="font-weight:bold;">12 Mai</b></span><!--<br /><br />
		<a href="./files/rules_sgl2017.pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Télécharger le règlement</a>--></p><br />',

	'<p style="text-align:center;">
		<b><i class="fa fa-user-circle" aria-hidden="true" style="padding-right: 5px;"></i></b> Tournoi solo
		<span style="padding: 0px 10px;">|</span>
		<b><i class="fa fa-calendar" aria-hidden="true" style="padding-right: 5px;"></i></b> Les Dimanches (début le 25 Février)
		<span style="padding: 0px 10px;">|</span>
		<b><i class="fa fa-trophy" aria-hidden="true" style="padding-right: 5px;"></i></b> Récompenses à venir ;)
		<span style="padding: 0px 10px;">|</span>
		<b><i class="fa fa-line-chart" aria-hidden="true" style="padding-right: 5px;"></i></b> 384 joueurs l\'année dernière<br /><br />
		<span style="padding: 10px;">Finale le <b style="font-weight:bold;">5 Mai</b></span><!--<br /><br />
		<a href="./files/rules_sgl2017.pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Télécharger le règlement</a>--></p><br />');

$check_teamtag = 0;
$error_teamtag = "";

?>

<div id="content">

<?php
$single = false;
$get_game = 0;

if (isset($_GET["gpage"]))
{
	$get_game = intval($_GET["gpage"]);
	if (in_array($get_game, $games))
	{
		$single = true;

		echo '<div class="top_ban" style="background-image: url(\'./style/img/ban/top_'.$games_short[$get_game-1].'.png\');"></div>';
	}
}

?>
	<div class="container">
		<h1><i class="fa fa-angle-right" aria-hidden="true"></i> Tournoi <?=$single?$games_name[$get_game-1]:''?></h1>
		<div class="quote">
			<span class="qcontent">
				<i>&ldquo;</i>
<?php
if ($single)
{
	echo $games_quote[$get_game-1];
}
else
{
	echo 'Keep calm and blame it on the lag';
}
?>
				<i>&rdquo;</i>
			</span>
			<span class="qauthor">
				- Un joueur de la SGL 2017
			</span>
		</div>
		<br />
<?php


for ($i=0; $i<count($games); $i++)
{

	if ($single)
	{
		$i = $get_game-1;
		$break_flag = true;
		$url_game = "&amp;gpage=".$get_game;
	}

	echo '<p id="'.$games_short[$i].'"><table class="line_table"><tr><td><hr class="line" /></td><td><img src="./style/img/games/'.$games_short[$i].'.png" alt="'.$games_name[$i].'" /></td><td><hr class="line" /></td></tr></table></p>';

	echo $games_content[$i];

	if ($games_in[$games[$i]])
	{
		echo '<p style="text-align:center; font-weight: bold">Yay ! <b>Vous êtes inscrit</b> à ce tournoi ! Un premier pas vers la victoire...</p>';
		echo '<p style="text-align: center;" class="smallquote">Plus qu\'à hard train jusqu\'à fin Février. [ <a href="index.php?page=games'.$url_game.'&amp;game='.$games[$i].'&amp;del=1">Se désinscrire du tournoi</a> ]</p><br />';
		//echo '<p style="text-align: center;" class="smallquote">Le tournoi a commencé... Bon courage !</p><br />';

		$gameidType = "battletag";
		if ($get_game == 2)
		{
			$gameidType = "summoner";
		}
		else if ($get_game == 3)
		{
			$gameidType = "steamid";
		}

		$temp = $database->req('SELECT sgl_users.login, sgl_users.mail, sgl_users.'.$gameidType.', sgl_teams.type, sgl_teams.register, sgl_teams.user, sgl_teams.name, sgl_teams.tag
			FROM sgl_users, sgl_teams LEFT JOIN sgl_teams AS my_team ON sgl_teams.lead = my_team.lead AND sgl_teams.game = my_team.game
			WHERE my_team.user="'.$_SESSION["sgl_id"].'" AND my_team.game="'.$games[$i].'" AND sgl_teams.user = sgl_users.id ORDER BY type ASC');

		$type = array("Aucun", "Capitaine", "Joueur", "Remplaçant");

		$nplayer = 0;
		$nreps = 0;

		echo '<div style="text-align: center">';

		$lasttype = 1;
		$lead = false;

		while($data = $temp->fetch())
		{
			if ($data["type"] == 1)
			{
				if ($_SESSION["sgl_id"] == $data["user"])
				{
					$lead = true;

					if ($games_team[$i] > 1)
					{
						echo '<div class="form"><form action="index.php?page=games'.$url_game.'&amp;game='.$games[$i].'" method="post">
						<table class="form_table">
							<tr><td><h3>Nom d\'équipe :</h3></td><td><input disabled="disabled" value="'.htmlspecialchars($data["name"]).'" name="teamname" type="text"><br />
							<div class="smallquote">Le nom de votre équipe, genre "Télécom Bretagne Gaming"</div></td></tr>
							<tr><td><h3>TAG d\'équipe :</h3></td><td><input disabled="disabled" value="'.htmlspecialchars($data["tag"]).'" name="teamtag" type="text"><br />
							'.$error_teamtag.'
							<div class="smallquote">Votre tag en 3 ou 4 caractères, genre "TBG" ou "TBG2" (que des lettres et des chiffres par contre !)</div></td></tr>
						</table><br /><br />
						<input type="hidden" name="sent" value="sent">
						'./*<button type="submit" value="Submit">Mettre à jour</button>*/'
						</form></div><br /><br /><br />';

						echo '<p id="'.$games_short[$i].'"><table class="line_table"><tr><td><hr class="line" /></td><td>Votre équipe</td><td><hr class="line" /></td></tr></table></p><br />';
					}
				}
				else
				{
					echo "<h1>".htmlspecialchars($data["name"])." [".htmlspecialchars($data["tag"])."]</h1><br />";
				}
			}

			if ($data["type"] != $lasttype)
			{
				if ($lasttype == 2)
				{
					for ($j=0; $j<($games_team[$i]-$nplayer); $j++)
					{
						if ($lead)
						{
							echo '<span class="buttoncard" onclick="morphIntoTextField(this, '.$games[$i].')()" data-type="2" data-game="'.$games[$i].'">Ajouter un joueur</span><br />';
						}
						else
						{
							echo '<span class="playercard"></span><br />';
						}
					}
					echo "<br /><br/>";
				}
			}

			if ($data["type"] < 3)
			{
				$nplayer++;
			}
			else if ($data["type"] == 3)
			{
				$nreps++;
			}

			if ($lead && ($_SESSION["sgl_id"] != $data["user"]))
			{
				$dlstr = '';
				//$dlstr = '<span class="cardoption"><a href="index.php?page=games'.$url_game.'&amp;game='.$games[$i].'&remove='.$data["user"].'"><i class="fa fa-times" aria-hidden="true"></i></a></span>';
			}
			else
			{
				$dlstr = '';
			}

			if ($data["register"] == 0)
			{
				echo '<span class="playercard" style="opacity:0.5;"><span class="playername">'.htmlspecialchars(($data["login"] == "")?$data["mail"]:$data["login"]).' <span class="mintext">(Invitation envoyée)</span></span><span class="playertype">('.$type[$data["type"]].')</span>'.$dlstr.'</span><br />';
			}
			else
			{
				if($data[$gameidType] != "")
				{
					$gameTag = ' <span class="mintext">('.$data[$gameidType].')</span>';
				}
				else
				{
					$gameTag = ' <span class="mintext" style="color:#ff0000;text-decoration:underline">(Gametag manquant)</span>';
				}

				echo '<span class="playercard"><span class="playername">'.htmlspecialchars($data["login"]).$gameTag.'</span><span class="playertype">('.$type[$data["type"]].')</span>'.$dlstr.'</span><br />';
			}

			$lasttype = $data["type"];
		}

		if ($lasttype <= 2)
		{
			for ($j=0; $j<($games_team[$i]-$nplayer); $j++)
			{
				if ($lead)
				{
					//echo '<span class="buttoncard" onclick="morphIntoTextField(this, '.$games[$i].')()" data-type="2" data-game="'.$games[$i].'">Ajouter un joueur</span><br />';
					echo '<span class="playercard"></span><br />';
				}
				else
				{
					echo '<span class="playercard"></span><br />';
				}
			}
			echo "<br /><br />";
			$lasttype = 2;
		}

		for ($j=0; $j<($games_reps[$i]-$nreps); $j++)
		{
			if ($lead)
			{
				//echo '<span class="buttoncard" onclick="morphIntoTextField(this, '.$games[$i].')()" data-type="3" data-game="'.$games[$i].'">Ajouter un remplaçant</span><br />';
				echo '<span class="playercard"></span><br />';
			}
			else
			{
				echo '<span class="playercard"></span><br />';
			}
		}

		echo '</div>';

// TODO : confirm delete participation
	}
	else
	{
		
		if (isset($_SESSION["sgl_id"]))
		{
			if ($games_team[$i] > 1)
			{
				//echo '<p style="text-align: center;" class="smallquote">Si vous souhaitez <span style="font-weight:bold;">rejoindre une équipe</span>,<br /><u>votre chef d\'équipe doit d\'abord vous inviter</u>.</p><br /<br />';

				$temp = $database->req('SELECT sgl_users.login, sgl_users.id FROM sgl_teams, sgl_users WHERE sgl_teams.user="'.$_SESSION["sgl_id"].'" AND sgl_teams.lead = sgl_users.id AND game="'.$games[$i].'" AND sgl_teams.register = 0');

				while($data = $temp->fetch())
				{
					//echo '<p style="text-align: center;"><a href="index.php?page=games'.$url_game.'&amp;game='.$games[$i].'&accept='.$data["id"].'" class="button">Accepter l\'invitation de '.htmlspecialchars($data["login"]).'</a></p><br />';
				}
			}
			if ($games[$i] == 4)
			{
				//echo '<p style="text-align: center;"><a href="index.php?page=games'.$url_game.'&amp;game='.$games[$i].'" class="button">S\'inscrire à la compétition</a></p>';
			}
			else
			{
				//echo '<p style="text-align: center;"><a href="index.php?page=games'.$url_game.'&amp;game='.$games[$i].'" class="button">Inscrire son équipe</a></p>';
			}
		}
		else
		{
			/*echo '<p style="text-align: center;">Vous devez d\'abord vous inscrire sur le site pour pouvoir participer...<br /><br />
			<a href="index.php?page=register" class="button">S\'inscrire à la SGL</a></p>';*/
		}

		//echo '<p style="text-align: center;"><a href="#" class="button">Le tournoi a déjà commencé...</a></p>';
	}
	
	echo '<br /><br />';

	echo '<p style="text-align:center;"><b><i class="fa fa-question-circle" aria-hidden="true" style="padding-right: 5px;"></i></b> Des questions ? Besoin d\'aide ? A le recherche de joueurs ?<br />Venez nous rejoindre sur <a target="_blank" href="https://discord.gg/sgnw">Discord</a> :D !</p>';

	if ($break_flag)
	{
		break;
	}
}
?>
		<br />
	</div>
</div>
