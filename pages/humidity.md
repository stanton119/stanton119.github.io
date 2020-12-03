---
layout: page
title: Humidity Calculator
permalink: /humidity-calculator/
feature-img: "assets/img/pexels/rain.jpeg"
# tags: [About, Archive]
bootstrap: true
comments: true
disqus_identifier: https://www.richard-stanton.com/humidity-calculator/
---

<script type="text/javascript">
    $(document).ready(function () {
        var pastValue, pastSelectionStart, pastSelectionEnd;

        $("input").on("keydown", function () {
            pastValue = this.value;
            pastSelectionStart = this.selectionStart;
            pastSelectionEnd = this.selectionEnd;
        }).on("input propertychange", function () {
            var regex = /^-?[0-9]*\.?[0-9]*$/;

            if (this.value.length > 0 && !regex.test(this.value)) {
                this.value = pastValue;
                this.selectionStart = pastSelectionStart;
                this.selectionEnd = pastSelectionEnd;
            }


            computeHumidity();
        });
    });

    function computeHumidity() {
        // get all variables
        var outsideTemp, insideTemp, outsideHumid;

        outsideTemp = parseFloat($('#outsideTemp').val());
        outsideHumid = parseFloat($('#outsideHumid').val());
        insideTemp = parseFloat($('#insideTemp').val());

        if (!isNaN(outsideTemp) && !isNaN(outsideHumid) && !isNaN(insideTemp)) {
            var insideHumid, satVarPOut, satVarPIn;
            satVarPIn = 6.122 * Math.exp(17.62 * insideTemp / (243.12 + insideTemp));
            satVarPOut = 6.122 * Math.exp(17.62 * outsideTemp / (243.12 + outsideTemp));
            insideHumid = (insideTemp + 273) * outsideHumid * satVarPOut / ((outsideTemp + 273) * satVarPIn);

            $('#insideHumid').val(Math.round(insideHumid));
        }
    }
</script>



Should you open the windows or not?

Will opening the windows help reduce the humidity in my home today?

Heating the air from outside reduces its relative humidity, what is the resulting humidity?

When the outside humidity is very high most would assume that opening the window will not help to reduce the humidity inside your home. Humidity is affected by temperature. As the temperature of the air rises, the relative humidity falls. So if you open your window the cold humid air from outside will enter inside, but when it comes back up to temperature it may be less humid than the air was inside.

Try to keep inside humidity in the range of 40-60%.

The following calculator will work out the humidity of the outside air when it has been warmed up to the temperature of your home:


<div class="container">
    <form id="formdata">
        <!-- outside -->
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="form-group form-group-lg">
                    <label class="sr-only" for="exampleInputAmount">Outside Temperature (&deg;C)</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="outsideTemp" placeholder="Outside Temperature">
                          <div class="input-group-append">
                            <span class="input-group-text">&deg;C</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group form-group-lg">
                    <label class="sr-only" for="exampleInputAmount">Outside Humidity (%)</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="outsideHumid" placeholder="Outside Humidity">
                        <div class="input-group-append">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- inside -->
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="form-group form-group-lg">
                    <label class="sr-only" for="exampleInputAmount">Inside Temperature (&deg;C)</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="insideTemp" placeholder="Inside Temperature">
                        <div class="input-group-append">
                            <span class="input-group-text">&deg;C</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group form-group-lg">
                    <label class="sr-only" for="exampleInputAmount">Inside Humidity (%)</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="insideHumid" placeholder="Inside Humidity" readonly>
                        <div class="input-group-append">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
