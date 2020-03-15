<?php
echo "Running tracker.php<br>";

// load team list (csv)
// create array for each team name (use dictionary to store team names)
echo "<br>Getting team names<br>";
$teams = array();
$row = 0;
if (($handle = fopen("Teams.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		// ignore first header row ("Teams")
		if ($row) {
			// append to team list, 2nd column
			$teams[] = $data[1];
		}
		$row++;
    }
    fclose($handle);
}

// write out list
echo "<br>Team list: size(" . count($teams) . ")<br />\n";
for ($i=0; $i < count($teams); $i++) {
    echo $teams[$i] . "<br />\n";
}

// csv games list
// function array_delete($array, $row) {
// 	// unset element, reindex array and return
// 	$array2 = array();
// 	unset($array[$row]);
// 	for ($i=0; $i < count($array); $i++) {
// 	    if(isset($array[$i])) $array2[] = $array[$i];
// 	}
//     return $array2;
// }
//
// // load score list
// $scores2 = array_map('str_getcsv', file('NBA.csv'));
// // remove header row ("Teams")
// $scores2 = array_delete($scores2, 0);
// echo "<br>\n";
// echo count($scores2) . "<br>";

echo "<br>Getting games list<br>";
// source http://www.basketball-reference.com/leagues/NBA_2015_games.html
// $games table.tbody
// $html = file_get_html('http://www.basketball-reference.com/leagues/NBA_2015_games.html');
$html = file_get_contents('http://www.basketball-reference.com/leagues/NBA_2016_games.html');

$dom = new DOMDocument;
$dom->loadHTML($html);
echo "<br>Received HTML<br>";
$xpath = new DOMXpath($dom);
$trs = $xpath->query("//*[@id='games']/tbody/tr");

echo "<br>Building scores array<br>";
$scores = array();
$row = 0;
foreach ($trs as $tr)
{
	$col = 0;
	foreach ($tr->childNodes as $td)
	{
		if ($td->nodeName == "td") {
			$scores[$row][$col] = $td->nodeValue;
			$col++;
		}
	}
	$row++;
}
echo "<br>Array finished, length: ".count($scores)."<br>";

// iterate through scores
echo "<br>Building win/loss matrix<br>";
// append to team vector (array) 0/1 for result
// team matrix
$winloss = array();
// for each team
for ($t=0; $t < count($teams); $t++) {
    // iterate all scores
	$g = 0;	// game counter
	for ($m=0; $m < count($scores); $m++) {
		// if team was in game
		if ($teams[$t]==$scores[$m][3] && $scores[$m][4]) {
			if ($scores[$m][4]>$scores[$m][6]) {
				// won, append 1
				$winloss[$t][$g] = 1;
			} else {
				//lost, append 0
				$winloss[$t][$g] = 0;
			}
			// iterate game count
			$g++;
		} elseif ($teams[$t]==$scores[$m][5] && $scores[$m][4]) {
			if ($scores[$m][4]<$scores[$m][6]) {
				// won
				$winloss[$t][$g] = 1;
			} else {
				//lost
				$winloss[$t][$g] = 0;
			}
			// iterate game count
			$g++;
		}
	}
}

// // generate cumulative scores
// echo "Building cumulative scores array<br>";
// $cumwin = array();
// // for each team
// for ($t=0; $t < count($teams); $t++) {
// 	// first game
// 	$cumwin[$t][0] = $winloss[$t][0];
//
//     // iterate all games
// 	for ($g=1; $g<count($winloss[$t]); $g++) {
// 		// add to previous total
// 		$cumwin[$t][$g] = $cumwin[$t][$g-1] + $winloss[$t][$g];
// 	}
//
// 	// echo "Record for the " . $teams[$t] . ", " . count($winloss[$t]) . " games played<br>\n";
// 	echo $teams[$t] . ":<br />\n";
// 	for ($ga=0; $ga<count($cumwin[$t]); $ga++) {
// 		echo $cumwin[$t][$ga] . " \t";
// 	}
// 	echo "<br>";
// }

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
	echo $teams[$t] . ":<br />\n";
	for ($ga=0; $ga<count($cumwin); $ga++) {
		echo $cumwin[$ga] . " \t";
	}
	echo "<br>";
	
	// put into json object
	$jsonObj[$t]['team'] = $teams[$t];
	$jsonObj[$t]['value'] = $cumwin;
	$jsonObj[$t]['wins'] = $cumwin[count($cumwin)-1];
}

// order by wins total
echo "<br>Sorting scores<br>";
usort($jsonObj, function($a, $b) {
    return $b['wins'] - $a['wins'];
});


// save results to a file for loading from static page
echo "<br>Saving results: results.json<br>";
file_put_contents("results.json",json_encode($jsonObj));

echo "<br>Complete.<br>";
?>