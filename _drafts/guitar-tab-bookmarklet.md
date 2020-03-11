---
layout: post
title: "Markup: Syntax Highlighting"
author: mmistakes
tags: [code]
---

## Following YouTube?
Check out <strong><a title="Guitar Tabs for YouTube™" href="http://www.richard-stanton.com/itab/guitar-tabs-for-youtube/">Guitar Tabs for YouTube™</a>,</strong> a <strong>Chrome</strong> extension which finds the current tab for the currently playing YouTube video and displays it right there in the video!

Alternatively, in your web browser, install the bookmarklet below, by dragging the button into your favourites menu.
<p style="text-align: center;">[button link="#" type="primary" size="large"]YouTube Tab Search[/button]</p>
<p style="text-align: left;">Then change the address of the bookmark to the following:</p>

```js
javascript:(function()%7Bvar%20span%20%3D%20document.getElementById('eow-title').innerText.trim()%3Bwindow.open('http%3A%2F%2Fwww.911tabs.com%2Fsearch.php%3Fsearch%3D'%2BencodeURIComponent(span))%7D)()
```
Now every time you want to get the tab for the current YouTube Video, simply click the new bookmark! A new web tab will appear with the search results for that video from 911Tabs.