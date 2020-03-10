---
layout: chrome-plugin
title: Radio Mode for YouTube™
feature-img: "assets/img/pexels/radio.jpg"
comments: true
bootstrap: true
icon: "assets/img/chrome-plugins/youtube-radio/LargeIcon.png"
description: A simple Chrome plug-in that replaces YouTube videos with just the audio to save CPU.
taken_down: false
link: "https://chrome.google.com/webstore/detail/hhbjppdghagniamelnodbhnlbnpmipnm/"
---

Also available on [GitHub](https://github.com/stanton119/YouTube-Radio)

__Radio Mode for YouTube™__ removes the video from the page, leaving just the audio.

Ever listen to music on YouTube in the background? Ever see your computer slow down or hear the fans start spinning?

Simply click the Radio extension icon in the top bar to remove the video. If you are playing a playlist, every video will be blanked out automatically.

Usage based on a single video playing. CPU usage reduced by ~50%

* This requires the HTML5 YouTube Player. If a flash video is detected, the plug-in will attempt to switch to the HTML5 version.

---

## Setup

1. Click on the radio icon to enable Radio Mode for the video
2. The video will disappear

<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<img src="/assets/img/chrome-plugins/youtube-radio/Chrome-Off.png" alt="Radio Mode 1"
				class="img-fluid img-thumbnail" />
		</div>
		<div class="col-md-6">
			<img src="/assets/img/chrome-plugins/youtube-radio/Chrome-On.png" alt="Radio Mode 2"
				class="img-fluid img-thumbnail" />
		</div>
	</div>
</div>

---

## Bookmarklet

If you don't use Chrome you can use this helpful little bookmarklet instead! In your web browser, install the bookmarklet below, by dragging the button into your favourites menu.
<p style="text-align: center;">
	<a href="" class="btn btn-primary btn-lg" target="blank">Radio Mode for YouTube™</a>
</p>

Then change the address of the bookmark to the following:
```javascript
javascript:(function()%7Bvar%20mediaElement%20%3D%20document.getElementsByClassName('html5-main-video')%5B0%5D%3Bif%20(typeof%20mediaElement%20!%3D%3D%20%22undefined%22)%20%7Bvar%20paused%20%3D%20mediaElement.paused%3BmediaElement.parentNode.removeChild(mediaElement)%3Bif%20(!paused)%20%7BmediaElement.play()%3B%7D%7D%7D)()
```
Now everytime you want to strip out the YouTube video and save some of your processing power, simply click the new bookmark! The video will be blanked out and the audio will continue playing.
