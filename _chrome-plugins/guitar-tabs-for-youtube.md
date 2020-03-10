---
layout: chrome-plugin
title: Guitar Tabs for YouTube™
feature-img: "assets/img/pexels/guitar2.jpeg"
comments: true
bootstrap: true
icon: "assets/img/chrome-plugins/youtube-guitar-tab/LargeIcon.png"
description: A simple Chrome plug-in that attempts to find the guitar tab for the current YouTube video.
taken_down: true
link: "https://chrome.google.com/webstore/detail/guitar-tabs-for-youtube/mjkcmmckommjkjgeghochanacldlipnc"
---

Also available on [GitHub](https://github.com/stanton119/YouTube-Guitar-Tab)

Get your tabs delivered to you YouTube with no effort!

Ever wanted to see the guitar tab for the current song? Simply click the guitar tab icon, and the tab will appear
underneath. __Guitar Tabs for YouTube™__ lets you find the tab for the currently playing video directly in the same
window.

* This requires the HTML5 YouTube Player. Protected flash videos will unfortunately not work.
* Some times, it won't be able to find the correct tab...sorry.
* If the tabs don't appear, try refreshing the page.

---

## Setup

1. Click on the guitar icon to find the tab for the video
2. The tab will appear above the comments section

<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<img src="/assets/img/chrome-plugins/youtube-guitar-tab/GuitarInstall1.png" alt="Guitar Tab 1"
				class="img-fluid img-thumbnail" />
		</div>
		<div class="col-md-6">
			<img src="/assets/img/chrome-plugins/youtube-guitar-tab/GuitarInstall2.png" alt="Guitar Tab 2"
				class="img-fluid img-thumbnail" />
		</div>
	</div>
</div>

---

## Bookmarklet

Alternatively, you can find tabs using any browser using a simple bookmarklet. In your web browser, install the
bookmarklet below, by dragging the button into your favourites menu.
<p style="text-align: center;">
	<a href="" class="btn btn-primary btn-lg" target="blank">YouTube Guitar Tab Search</a>
</p>

Then change the address of the bookmark to the following:
```javascript
javascript:(function()%7Bvar%20span%20%3D%20document.getElementById('eow-title').innerText.trim()%3Bwindow.open('http%3A%2F%2Fwww.911tabs.com%2Fsearch.php%3Fsearch%3D'%2BencodeURIComponent(span))%7D)()
```
Now every time you want to get the tab for the current YouTube Video, simply click the new bookmark! A new web tab will
appear with the search results for that video from 911Tabs.
