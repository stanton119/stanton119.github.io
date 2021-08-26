---
layout: page
title: Humidity Forecast
feature-img: "assets/img/pexels/rain.jpeg"
# tags: [About, Archive]
bootstrap: true
comments: true
---
<script src='https://cdn.plot.ly/plotly-2.3.1.min.js'></script>

<div class="container-xl">
    <form id="postCodeForm">
        <div class="row justify-content-center">
            <div class="col">
                <label for="postcodeInput" class="col-form-label col-form-label-lg">UK post code</label>
                <input type="text" class="form-control-lg" id="postcodeInput" placeholder="SW1A 2JR">
                <button type="submit" class="btn btn-primary btn-lg" onClick="submitPostcode()">Submit</button>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col">
            <div id='plotDiv'>
            </div>
        </div>
    </div>
</div>

<script src="/assets/js/humidity-forecast/main.js" type="text/javascript" charset="utf-8"></script>
