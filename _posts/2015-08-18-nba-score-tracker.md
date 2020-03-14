---
layout: post
title: NBA Tracker 2014/15
# tags: [Test, Ipsum, Markdown, Portfolio]
---

<meta http-Equiv="Cache-Control" Content="no-cache">
<meta http-Equiv="Pragma" Content="no-cache">
<meta http-Equiv="Expires" Content="0">
<link rel="stylesheet" id="tracker-css" href="https://www.richard-stanton.com/files/sportstracker/css/style.css" type="text/css" media="all">
<script src="https://www.richard-stanton.com/files/sportstracker/js/c3.js"></script>
<script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
<!-- Load c3.css -->
<link href="https://www.richard-stanton.com/files/sportstracker/css/c3.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

# NBA Tracker 2014/15

Wins against games played.

<div id="myChart"></div>
<div class="container-fluid">
    <div class="row" id="teamtable">
        <div class="col-md-6" id="westTable">
        </div>
        <div class="col-md-6" id="eastTable">
        </div>
    </div>
    <div class="row">
        <div class="col-xs-2 col-xs-offset-2">
            <div class="text-center">
                <div class="btn-group btn-group-lg" role="group" aria-label="...">
                    <button id="western" type="button" class="btn btn-default">West</button>
                </div>
            </div>
        </div>
        <div class="col-xs-4">
            <div class="text-center">
                <div class="btn-group btn-group-lg" role="group" aria-label="...">
                    <button id="showall" type="button" class="btn btn-default">Show all</button>
                    <button id="hideall" type="button" class="btn btn-default">Hide all</button>
                </div>
            </div>
        </div>
        <div class="col-xs-2">
            <div class="text-center">
                <div class="btn-group btn-group-lg" role="group" aria-label="...">
                    <button id="eastern" type="button" class="btn btn-default">East</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // team filtering
    var filter = [];
    var teams = [];
    var eastTeams = [];
    var isEastTeam = [];
    var westTeams = [];

    // load json objects
    var gameData, colourData, conferenceData;
    $.when(
        $.getJSON("https://www.richard-stanton.com/files/sportstracker/NBA/results2015.json", function (data) {
            gameData = data;
        }),
        $.getJSON("https://www.richard-stanton.com/files/sportstracker/team-data.json", function (data) {
            colourData = data;
        }),
        $.getJSON("https://www.richard-stanton.com/files/sportstracker/NBA/conference.json", function (data) {
            conferenceData = data;
        })
    ).then(function () {
        // when both available
        if (conferenceData) {
            splitConferences(conferenceData);
        }
        if (colourData) {
            // create teams table
            constructTeamTable(colourData["NBA"]);
            // split conferences
            // splitTeams();
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

    // conference buttons
    $('#eastern').click(function () {
        // hide all
        toggleAll(0);
        // show just east
        chart.show(eastTeams);
        for (i = 0; i < eastTeams.length; i++) {
            $('#Div' + convertNameToID(eastTeams[i])).find("img").attr('class', 'img-thumbnail iconOn');
            filter[eastTeams[i]] = 1;
        }
    });
    $('#western').click(function () {
        toggleAll(0);
        chart.show(westTeams);
        for (i = 0; i < westTeams.length; i++) {
            $('#Div' + convertNameToID(westTeams[i])).find("img").attr('class', 'img-thumbnail iconOn');
            filter[westTeams[i]] = 1;
        }
    });

    function splitConferences(data) {
        // populate east/west conference
        $.each(data, function (key, val) {
            if (val) {
                isEastTeam[key] = 1;
                // isEastTeam.push(1);
                eastTeams.push(key);
            } else {
                isEastTeam[key] = 0;
                westTeams.push(key);
            }
        });
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
            addToTable(isEastTeam[key], convertNameToID(key));
        });
        $("#eastTable").append(eastTable);
        $("#westTable").append(westTable);

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

    var eastRow = 0;
    var eastCol = 0;
    var eastTable = "";
    var westRow = 0;
    var westCol = 0;
    var westTable = "";
    var rowsize = 5;

    function addToTable(isEast, teamID) {
        if (isEast) {
            // generate table
            if (eastCol == 0) {
                // alternate row backgrounds
                if (eastRow % 2 == 0) {
                    eastTable += '<div class="row rowEven">';
                } else {
                    eastTable += '<div class="row rowOdd">';
                }
                // off set first column
                eastTable += '<div class="col-xs-2 col-xs-offset-1"';
            } else {
                // output all table elements
                eastTable += '<div class="col-xs-2"';
            }

            eastTable += ' id="Div' + teamID + '"><img src="https://www.richard-stanton.com/files/sportstracker/img/nba/' + teamID + '.svg" class="img-thumbnail iconOn"></div>';

            // next row?
            eastCol++;
            if (eastCol > rowsize - 1) {
                eastTable += '</div>';
                eastCol = 0;
                eastRow++;
            }
        } else {
            // generate table
            if (westCol == 0) {
                // alternate row backgrounds
                if (westRow % 2 == 0) {
                    westTable += '<div class="row rowEven">';
                } else {
                    westTable += '<div class="row rowOdd">';
                }
                // off set first column
                westTable += '<div class="col-xs-2 col-xs-offset-1"';
            } else {
                // output all table elements
                westTable += '<div class="col-xs-2"';
            }

            westTable += ' id="Div' + teamID + '"><img src="https://www.richard-stanton.com/files/sportstracker/img/nba/' + teamID + '.svg" class="img-thumbnail iconOn"></div>';

            // next row?
            westCol++;
            if (westCol > rowsize - 1) {
                westTable += '</div>';
                westCol = 0;
                westRow++;
            }
        }
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
                        text: 'Wins',
                        position: 'outer-middle'
                    }
                }
            },
            grid: {
                x: {
                    // number of games in season
                    lines: [{ value: 82 }],
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

[panel type="info" heading="Info"]
Updated daily

Images from: <a href="http://teamcolors.arc90.com" target="_blank">http://teamcolors.arc90.com</a>

Data from: <a href="http://www.basketball-reference.com" target="_blank">http://www.basketball-reference.com</a>[/panel]