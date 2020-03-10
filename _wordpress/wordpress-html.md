---
layout: page
title: WordPress HTML
feature-img: "assets/img/pexels/book-glass.jpeg"
# tags: [About, Archive]
comments: true
bootstrap: true
description: WordPress HTML allows you to add custom HTML to both the post/page body and the head.
---

<p style="text-align: center;" class="lead">
	{{ page.description }}
</p>
<p style="text-align: center;">
	<a href="https://wordpress.org/plugins/custom-html-bodyhead/" class="btn btn-primary btn-lg"
		target="blank">Download: wordpress.org/plugins/custom-html-bodyhead/</a>
</p>

<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<p style="text-align: center;">
				<img src="/assets/img/wordpress/wordpress-html/screenshot-1.png" alt="Custom Fields"
					class="img-fluid img-thumbnail" />
			</p>
		</div>
	</div>
</div>

Also available on [GitHub](https://github.com/stanton119/wordpress-html-plugin)

When copying HTML into the WordPress editor it adds spurious tags which break various elements and corrupt the HTML. By
saving the HTML in the custom fields dialogue the exact HTML will be output to your post/page.

Also if you have a single page which requires an extra javascript library or style sheet you normally have to add it
through your themes php files. Updating the theme files can be a pain; we normally have to set up an exception for that
individual page and load it there. As this information is not available when we are editing the actual pages in the
WordPress editor it is quite obstructive.

With WordPress HTML, we can add the library or stylesheet directly to the post/page head without the need to change the
theme files. And importantly, all from within the WordPress editor for that page.

---

## Setup
To install:
1. Download the ZIP file and upload to the `wp-content/plugins` directory
1. Navigate to the _Plugins_ panel of the admin panel
1. Activate the plugin!

---

## Adding HTML to the post/page body
1. In the post/page which needs HTML add a custom field with name: "body"
2. Paste the HTML into the accompanying value box
3. Insert the shortcode `[body][/body]` where it should appear in the page

<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<p style="text-align: center;">
				<img src="/assets/img/wordpress/wordpress-html/screenshot-2.png" alt="Body tags" class="img-fluid img-thumbnail" />
			</p>
		</div>
	</div>
</div>

You can insert multiple body tags with the syntax: `[body id=”element1″][/body]`, where _element1_ is the name of a
custom field to insert.

---

## Adding HTML to the head tag
* Add a custom field with name: "head"
* Paste the HTML into the value box

A completed post will have custom fields similar to those shown in the image at the top.

---

## Adding a Custom Field

To add a custom field, scroll down in the editor to <em>Custom Fields</em>.&nbsp;There is an option underneath the
dropdown to "Enter New". Click that, type in "head", and then click "Add Custom Field". This is shown in the screenshot
below:

<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<p style="text-align: center;">
				<img src="/assets/img/wordpress/wordpress-html/screenshot-3.png" alt="Custom fields"
		class="img-fluid img-thumbnail" />
			</p>
		</div>
	</div>
</div>

---

If you have any feature requests, problems or questions please use the comments section at the bottom of the page.