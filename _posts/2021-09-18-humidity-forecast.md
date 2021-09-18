---
layout: post
title: "Humidity forecast"
tags: []
color: blue
comments: true
---

I've built a new page for forecasting indoor humidity:

[https://www.richard-stanton.com/humidity-forecast](https://www.richard-stanton.com/humidity-forecast)

This is similar in concept to the [Humidity Calculator](https://www.richard-stanton.com/humidity-calculator/).

![png](/assets/img/posts/humidity_forecast.png)

We use a UK postcode to make a request to the BBC's weather forecast.
We then use the same maths as the previous humidity calculator to get the inside humidity.
We assume the inside temperature is a constant 21C.
This allows us to see how the absolute humidity is changing throughout the coming days. As such it can help to keep indoor humidity to a minimum.

It's built in javascript and uses jQuery/AJAX to do the requesting of data.
The plot is built with plotly.js.