---
layout: page
title: WordPress HTML
feature-img: "assets/img/pexels/book-glass.jpeg"
# tags: [About, Archive]
comments: true
---

[row]
<p style="text-align: left;">[column md="6"]<img class="alignleft wp-image-727 size-large" src="http://www.richard-stanton.com/wp-content/uploads/2015/02/Custom-Fields-1024x424.png" alt="Custom Fields" width="580" height="240"></p>
&nbsp;

[/column]

[column md="6"]Wordpress&nbsp;HTML allows you to add custom HTML to both the post/page body and the head.
<p style="text-align: center;">[button link="https://downloads.wordpress.org/plugin/custom-html-bodyhead.zip" size="lg" target="blank" type="primary"]Download: Version 0.5 -&nbsp;0.1MB[/button]</p>
<p style="text-align: center;">[alert type="info"]Also available on&nbsp;<strong><a href="https://wordpress.org/plugins/custom-html-bodyhead/" target="_blank">WordPress.org</a></strong>&nbsp;and<strong>&nbsp;<a href="https://github.com/stanton119/wordpress-html-plugin" target="_blank">GitHub</a></strong>[/alert]</p>
When copying HTML into the WordPress editor it adds spurious tags which break various elements and corrupt the HTML. By saving the HTML in the custom fields dialogue the exact HTML will be output to your post/page.

Also if you have a single page which requires an extra javascript library or style sheet you normally have to add it through your themes php files. Updating the theme files can be a pain; we normally have to set up an exception for that individual page and load it there. As this information is not available when we are editing the actual pages in the WordPress editor it is quite obstructive.

With WordPress HTML, we can add the library or stylesheet directly to the post/page head without the need to change the theme files. And importantly, all from within the WordPress editor for that page.

[/column]

[/row]
<h4>Setup</h4>
To install:
<ol>
 	<li>Download the ZIP file and upload to the&nbsp;wp-content/plugins directory</li>
 	<li>Navigate to the&nbsp;<em>Plugins&nbsp;</em>panel of the admin panel</li>
 	<li>Activate the plugin!</li>
</ol>
&nbsp;
<h4></h4>
[row][column md="6"]
<h4>Adding HTML to the post/page&nbsp;body</h4>
<ol>
 	<li>In the post/page which needs HTML add a custom field with name: "body"</li>
 	<li>Paste the HTML into the accompanying value box</li>
 	<li>Insert the shortcode [code inline="true"][ body][/body][/code] where it should appear in the page
<ol>
 	<li>You can insert multiple body tags with the syntax: [code inline="true"][ body id=”element1″][/body][/code], where "element1" is the name of a custom field to insert.</li>
</ol>
</li>
</ol>
<h4>Adding HTML to the head tag</h4>
<ol>
 	<li>Add a custom field with name: "head"</li>
 	<li>Paste the HTML into the value box</li>
</ol>
A completed post will have custom fields similar to those shown at the top.
<h4>Adding a Custom Field</h4>
To add a custom field, scroll down in the editor to <em>Custom Fields</em>.&nbsp;There is an option underneath the dropdown to "Enter New". Click that, type in "head", and then click "Add Custom Field". This is shown in the screenshot below:

<img class="alignleft size-full wp-image-842" src="http://www.richard-stanton.com/wp-content/uploads/2015/02/AddCustomField.png" alt="AddCustomField">

[/column][column md="6"]<img class=" wp-image-728 size-large alignright" src="http://www.richard-stanton.com/wp-content/uploads/2015/02/Editor-1024x496.png" alt="Editor" width="580" height="281">[/column][/row]
<h4></h4>
If you have any feature requests, problems or questions please use the comments section at the bottom of the page.