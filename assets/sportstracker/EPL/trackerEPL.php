<?php
echo "Running trackerEPL.php<br>";

// // http://www.premierleague.com/en-gb/matchday/results.html?paramClubId=ALL&paramComp_8=true&paramSeason=2014-2015&view=.dateSeason
// http://api.football-data.org/alpha/soccerseasons/354/fixtures
//
// // load team list (csv)
// http://api.football-data.org/alpha/soccerseasons/354/teams
// file_put_contents("resultsEPL.json",json_encode($jsonObj));


// create array for each team name (use dictionary to store team names)
echo "<br>Getting team names<br>";
$teamsFile = file_get_contents("http://api.football-data.org/alpha/soccerseasons/354/teams");
$json_teams=json_decode($teamsFile,true);
// links, count, "teams"
// ["name"] // second field, first is links
// $json_teams['teams'];	// returns array of teams, each row is a team, third element is name

$teams = array();
echo count($json_teams['teams']) . " teams found:<br>";
foreach ($json_teams['teams'] as $key => $val) {
	$teams[] = $val['name'];
}

// write out list
echo "<br>Team list: size(" . count($teams) . ")<br />\n";
for ($i=0; $i < count($teams); $i++) {
    echo $teams[$i] . "<br />\n";
}

echo "<br>Getting games list<br>";
// source http://api.football-data.org/alpha/soccerseasons/354/fixtures
$gamesFile = file_get_contents("http://api.football-data.org/alpha/soccerseasons/398/fixtures");
$json_games=json_decode($gamesFile,true);

// each row is a game, columns: [team1][score1][team2][score2]
echo count($json_games['fixtures']) . " games found:<br>";

echo "<br>Building scores array";
$row = 0;
$scores = array();
foreach ($json_games['fixtures'] as $key => $val) {
	$scores[$row][0] = $val['homeTeamName'];
	$scores[$row][1] = $val['result']['goalsHomeTeam'];
	$scores[$row][2] = $val['awayTeamName'];
	$scores[$row][3] = $val['result']['goalsAwayTeam'];
	$row++;
}
echo "<br>Array finished, length: ".count($scores)."<br>";

// iterate through scores
echo "<br>Building win/loss matrix<br>";
// count points not wins, win=3, draw=1, have cummulative points tally
// append to team vector (array) 3/1 for result
// if not played result=-1
// team matrix
$winloss = array();
// for each team
for ($t=0; $t < count($teams); $t++) {
    // iterate all scores
	$g = 0;	// game counter
	for ($m=0; $m < count($scores); $m++) {
		// if team was in game
		if ($teams[$t]==$scores[$m][0] && $scores[$m][1]!=-1) {
			if ($scores[$m][1]>$scores[$m][3]) {
				// won, append 3
				$winloss[$t][$g] = 3;
			} elseif ($scores[$m][1]==$scores[$m][3]){
				//draw, append 1
				$winloss[$t][$g] = 1;
			} else {
				//lost, append 0
				$winloss[$t][$g] = 0;
			}
			// iterate game count
			$g++;
		} elseif ($teams[$t]==$scores[$m][2] && $scores[$m][3]!=-1) {
			if ($scores[$m][1]<$scores[$m][3]) {
				// won, append 3
				$winloss[$t][$g] = 3;
			} elseif ($scores[$m][1]==$scores[$m][3]){
				//draw, append 1
				$winloss[$t][$g] = 1;
			} else {
				//lost, append 0
				$winloss[$t][$g] = 0;
			}
			// iterate game count
			$g++;
		}
	}
}

// put into json object
echo "<br>Building cumulative scores array<br>";
echo "<br>Building JSON object<br>";
$jsonObj = array();
// $cumwin = array();
// for each team
for ($t=0; $t < count($teams); $t++) {
	$cumwin = array();
	$cumwin[] = 0;
	// first game
	$cumwin[1] = $winloss[$t][0];
		
    // iterate all games
	for ($g=1; $g<count($winloss[$t]); $g++) {
		// add to previous total
		$cumwin[$g+1] = $cumwin[$g] + $winloss[$t][$g];
	}
	
	// echo "Record for the " . $teams[$t] . ", " . count($winloss[$t]) . " games played<br>\n";
	echo $teams[$t] . ", games(".count($cumwin)."):<br />\n";
	for ($ga=0; $ga<count($cumwin); $ga++) {
		echo $cumwin[$ga] . " \t";
	}
	echo "<br>";
	
	// put into json object
	$jsonObj[$t]['team'] = $teams[$t];
	$jsonObj[$t]['value'] = $cumwin;
	$jsonObj[$t]['points'] = $cumwin[count($cumwin)-1];
}

// order by wins total
echo "<br>Sorting scores<br>";
usort($jsonObj, function($a, $b) {
    return $b['points'] - $a['points'];
});

// translate names
echo "<br>Translating names list<br>";
$namesTranslateFile = file_get_contents("nameTranslate.json");
$json_names = json_decode($namesTranslateFile,true);
// for each row, change team field to new name
for ($t=0; $t < count($teams); $t++) {
	$jsonObj[$t]['team'] = $json_names[$jsonObj[$t]['team']];
}
echo "<br>Finished translating<br>";


// save results to a file for loading from static page
echo "<br>Saving results: resultsEPL.json<br>";
file_put_contents("resultsEPL.json",json_encode($jsonObj));

echo "<br>Complete.<br>";
?>