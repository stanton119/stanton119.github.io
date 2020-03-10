---
layout: page
title : BPM Tracker
# permalink: /chrome-plugins/
# subtitle: "Projects I am working on"
feature-img: "assets/img/pexels/computer.jpeg"
# tags: [Archive]
bootstrap: true
comments: true
---

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"
    charset="utf-8"></script>
<script src="/assets/js/bpm-tracker/bpm.js" type="text/javascript" charset="utf-8"></script>

<script src="/assets/js/bpm-tracker/c3.js" type="text/javascript" charset="utf-8"></script>
<script src="http://d3js.org/d3.v3.min.js" type="text/javascript" charset="utf-8"></script>
<!-- Load c3.css -->
<link href="/assets/css/bpm-tracker/c3.css" rel="stylesheet" type="text/css">


How good is your timing?

Can you reach the maximum score of 1000? The better you can keep time, the less your tapping will vary with time, so the
flatter the green line the better. For a harder challenge, try tapping and looking away from the screen for two minutes.

To reset, just wait 4 beats or a couple seconds.


<div class="container-fluid" id="clickBox" style="position: relative">
    <div class="row justify-content-center">
        <h1><span class="badge badge-success">bpm: <span id="bpm_display">Calc</span></span>
            <span class="badge badge-info">Score: <span id="score_display">Calc</span></span></h1>
    </div>
    <div id="overlayText" style="width: 100%; z-index: 10; position: absolute; top: 300px" class="text-center">
        <h1><span class="badge badge-warning">Click here, or tap any key to start!</span></h1>
    </div>

    <div id="myChart" class="row" style="position: absolute">
    </div>
</div>

<script type="text/javascript" charset="utf-8">
    construct_graph();
    // event handlers
    $(document).keydown(function (e) {
        // fade info message
        $('#overlayText').fadeOut(500, function () { $(this).remove(); });
        get_beat();
    });
    // replace with main div click function
    jQuery('#clickBox').click(function (event) {
        // fade info message
        $('#overlayText').fadeOut(500, function () { $(this).remove(); });
        get_beat();
    });
</script>
