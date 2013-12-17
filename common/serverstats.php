<?php
// server stats server info page by Ty_ger07 at http://open-web-community.com/

// DON'T EDIT ANYTHING BELOW UNLESS YOU KNOW WHAT YOU ARE DOING

echo '
<div class="middlecontent">
<table width="100%" border="0">
<tr><td  class="headline">
<br/><center><b>Server Info</b></center><br/>
</td></tr>
</table>
</div>
<br/><br/>
<div class="middlecontent">
<table width="100%" border="0">
<tr>
<th class="headline"><b>Server Stats</b></th>
</tr>
<tr>
<td>
<div class="innercontent"><br/>
<table width="95%" align="center" border="0">
<tr>
<td>
';
// query server stats
$Server_q = @mysqli_query($BF4stats,"
	SELECT `CountPlayers`, `SumKills`, (SumHeadshots/SumKills) AS AvgHSR, (SumKills/SumDeaths) AS AvgKDR, SumRounds, `SumDeaths`, `AvgScore`, `AvgKills`, `AvgHeadshots`, `AvgDeaths`, `AvgSuicide`, `AvgTKs`
	FROM tbl_server_stats
	WHERE ServerID = {$ServerID}
");
if(@mysqli_num_rows($Server_q) != 0)
{
	$Server_r = @mysqli_fetch_assoc($Server_q);
	$players = round($Server_r['CountPlayers'],2);
	$kills = round($Server_r['SumKills'],2);
	$deaths = round($Server_r['SumDeaths'],2);
	$avgscore = round($Server_r['AvgScore'],2);
	$avgkills = round($Server_r['AvgKills'],2);
	$avgheadshots = round($Server_r['AvgHeadshots'],2);
	$avgdeaths = round($Server_r['AvgDeaths'],2);
	$avgsuicide = round($Server_r['AvgSuicide'],2);
	$avgtks = round($Server_r['AvgTKs'],2);
	$avghsr = round($Server_r['AvgHSR'],2);
	$avgkdr = round($Server_r['AvgKDR'],2);
	$rounds = $Server_r['SumRounds'];
	// include players.php contents
	echo '<center><img src="pchart/players.php?server=' . $ServerID . '" alt="Minimum, maximum and average players" title="Minimum, maximum and average players" height="300" width="600" /></center>';
	// include joinsleaves.php contents
	echo '<center><img src="pchart/joinsleaves.php?server=' . $ServerID . '" alt="Joins and leaves from server" title="Joins and leaves from server" height="300" width="600" /></center>';
	echo '
	<table width="90%" align="center" border="0"><tr>
	<td style="text-align: left;" width="10%">&nbsp;<br/><br/></td>
	<td style="text-align: left;" width="30%"><font class="information">Total Players: </font>' . $players . '<br/><br/></td>
	<td style="text-align: left;" width="30%"><font class="information">Total Kills: </font>' . $kills . '<br/><br/></td>
	<td style="text-align: left;" width="30%"><font class="information">Total Deaths: </font>' . $deaths . '<br/><br/></td>
	</tr><tr>
	<td style="text-align: left;" width="10%">&nbsp;<br/><br/></td>
	<td style="text-align: left;" width="30%"><font class="information">Total Rounds: </font>' . $rounds . '<br/><br/></td>
	<td style="text-align: left;" width="30%"><font class="information">Average Team Kills: </font>' . $avgtks . '<br/><br/></td>
	<td style="text-align: left;" width="30%"><font class="information">Average Suicides: </font>' . $avgsuicide . '<br/><br/></td>
	</tr><tr>
	<td style="text-align: left;" width="10%">&nbsp;<br/><br/></td>
	<td style="text-align: left;" width="30%"><font class="information">Average Score: </font>' . $avgscore . '<br/><br/></td>
	<td style="text-align: left;" width="30%"><font class="information">Average Kills: </font>' . $avgkills . '<br/><br/></td>
	<td style="text-align: left;" width="30%"><font class="information">Average Deaths: </font>' . $avgdeaths . '<br/><br/></td>
	</tr><tr>
	<td style="text-align: left;" width="10%">&nbsp;<br/><br/></td>
	<td style="text-align: left;" width="30%"><font class="information">Average Headshots: </font>' . $avgheadshots . '<br/><br/></td>
	<td style="text-align: left;" width="30%"><font class="information">Average Kill/Death Ratio: </font>' . $avgkdr . '<br/><br/></td>
	<td style="text-align: left;" width="30%"><font class="information">Average Headshot Ratio: </font>' . $avghsr . '<br/><br/></td>
	</tr></table>
	';
}
else
{
	echo '<center><font class="information">No server stats found for this server.</font></center><br/>';
}
// free up server stats query memory
@mysqli_free_result($Server_q);
echo '
</td>
</tr>
</table>
</div>
</td>
</tr>
</table>
</div>
<br/><br/>
';
// show scoreboard from functions file
// input as: server id, server name, array of game modes, array of map names, array of squad names, array of country names, db
scoreboard($ServerID, $ServerName, $mode_array, $map_array, $squad_array, $country_array, $BF4stats);
?>