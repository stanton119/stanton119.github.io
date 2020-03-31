---
layout: post
title: Premier League Tracker 2014/15
bootstrap: true
feature-img: "assets/sportstracker/img/NBAScreenshot.png"
thumbnail: "assets/sportstracker/img/NBAScreenshot.png"
tags: [projects, sports]
comments: true
---

<meta http-Equiv="Cache-Control" Content="no-cache">
<meta http-Equiv="Pragma" Content="no-cache">
<meta http-Equiv="Expires" Content="0">
<link rel="stylesheet" id="tracker-css" href="/assets/sportstracker/css/style.css" type="text/css" media="all">
<script src="/assets/sportstracker/js/c3.js"></script>
<script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>
<!-- Load c3.css -->
<link href="/assets/sportstracker/css/c3.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

Points against games played.

<div id="myChart"></div>

<div class="container-fluid">
    <div class="row" id="teamtable">
    </div>
    <div class="row justify-content-center">
        <div class="col-4">
            <p style="text-align: center;">
                <button id="showall" type="button" class="btn btn-outline-primary">Show all</button>
                <button id="hideall" type="button" class="btn btn-outline-primary">Hide all</button>
            </p>
        </div>
    </div>
</div>

<br>
<div class="card">
    <div class="card-header">
        Info
    </div>
    <div class="card-body">
        <p>Images from: <a href="http://teamcolors.arc90.com" target="_blank">http://teamcolors.arc90.com</a></p>
        <p>Data from: <a href="https://www.football-data.org"
                target="_blank">https://www.football-data.org</a></p>
    </div>
</div>

<script>
    // team filtering
    var filter = [];
    var teams = [];

    // load json objects
    var gameData, colourData, conferenceData;
    $.when(
        $.getJSON("/assets/sportstracker/EPL/resultsEPL2014.json", function (data) {
            gameData = data;
        }),
        $.getJSON("/assets/sportstracker/team-data.json", function (data) {
            colourData = data;
        })
    ).then(function() {
		// when both available
	    if (colourData) {
			// create teams table
			constructTeamTable(colourData["EPL"]);
	    }
	    else {
	        // Request for web data didn't work, handle it
	    }
	    if (gameData) {
			// display data in chart
			constructData(gameData);
	    }
	    else {
	        // Request for graphic data didn't work, handle it
	    }
    });

    // convert name to ID/filename
    function convertNameToID(name) {
        name = name.replace(/ /g, "-");
        name = name.toLowerCase();
        return name;
    }

    // enable show/hide all buttons
    $('#showall').click(function () {
        toggleAll(1);
    });
    $('#hideall').click(function () {
        toggleAll(0);
    });
    function toggleAll(onOff) {
        // change class, change chart
        if (onOff) {
            $('div#teamtable').find("img").attr('class', 'img-thumbnail iconOn');
            chart.show(teams);
            for (i = 0; i < teams.length; i++)
                filter[teams[i]] = 1;
        } else {
            $('div#teamtable').find("img").attr('class', 'img-thumbnail iconOff');
            chart.hide(teams);
            for (i = 0; i < teams.length; i++)
                filter[teams[i]] = 0;
        }
    }

    // chart colours
    var teamColours = [];
    // create team table
    function constructTeamTable(data) {

        // construct selection table + callbacks
        var rowsize = 10;
        var row = 0;
        var col = 0;
        var content = "";

        // for each row
        $.each(data, function (key, val) {
            // on by default
            filter[key] = 1;

            // append team and colours
            teamColours[key] = val[0];

            // add to team names
            teams.push(key);

            // generate table
			if (col==0) {
				// alternate row backgrounds
				if (row%2==0) {
					content += '<div class="row rowEven justify-content-center">';
				} else {
					content += '<div class="row rowOdd justify-content-center">';
				}
			}

            content += '<div class="col-sm-1" id="Div' + convertNameToID(key) + '"><img src="/assets/sportstracker/img/epl/' + convertNameToID(key) + '.svg" class="img-thumbnail iconOn">'
            // content += key
            content += '</div>';

			// next row?
			col++;
			if (col>rowsize-1) {
				content += '</div>';
				col=0;
				row++;
			}
        });
        $("#teamtable").append(content);

        // add callback for each diff
        $.each(data, function (key, val) {
            // add callback functions
            $('#Div' + convertNameToID(key)).click(function () {
                filter[key] = 1 - filter[key];
                //change class to off/on, toggle display
                if (filter[key]) {
                    $('#Div' + convertNameToID(key)).find("img:first").attr('class', 'img-thumbnail iconOn');
                    chart.show(key);
                } else {
                    $('#Div' + convertNameToID(key)).find("img:first").attr('class', 'img-thumbnail iconOff');
                    chart.hide(key);
                }
            });

            // add focusing
            $('#Div' + convertNameToID(key)).mouseover(function () {
                chart.focus(key);
            });
            $('#Div' + convertNameToID(key)).mouseout(function () {
                chart.revert();
            });
        });
    }


    // chart object
    var chart;
    // append chart data
    var chartData = [];
    var chartColours = [];
    function constructData(data) {
        if (!data)
            return 0;

        // for each row - prepare data + colours
        var row = 0;
        $.each(data, function (key, val) {
            // format data
            // make into single array
            var chartDataTemp = [];
            chartDataTemp.push(val.team);
            for (i = 0; i < val.value.length; i++)
                chartDataTemp.push(val.value[i]);
            // add to chart data
            chartData.push(chartDataTemp);

            // make colours array
            chartColours.push('#' + teamColours[val.team]);
            row++;
        });

        // display chart + options
        chart = c3.generate({
            bindto: '#myChart',
            size: {
                height: 500
            },
            data: {
                columns: chartData,
                type: 'spline'
            },
            color: {
                pattern: chartColours
            },
            axis: {
                x: {
                    label: {
                        text: 'Games played',
                        position: 'outer-center'
                    }
                },
                y: {
                    min: 0,
                    padding: { bottom: 3 },
                    label: {
                        text: 'Points',
                        position: 'outer-middle'
                    }
                }
            },
            grid: {
                x: {
                    // number of games in season
                    lines: [{ value: 38 }],
                    show: true
                },
                y: {
                    show: true
                }
            },
            legend: {
                show: false
            },
            tooltip: {
                format: {
                    title: function (d) { return 'Games played: ' + d; }
                }
            }
        });
    }
</script>