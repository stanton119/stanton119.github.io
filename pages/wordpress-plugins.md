---
layout: page
title : WordPress
permalink: /wordpress/
# subtitle: "Projects I am working on"
feature-img: "assets/img/pexels/computer.jpeg"
# tags: [Archive]
bootstrap: true
---

<div class="container-fluid">
    {% for item in site.wordpress %}
    <div class="row justify-content-center align-items-center">
        <!-- <div class="col-md-3">
            <a href="{{ item.url | relative_url }}">
                <img src="{{ item.icon | relative_url }}" alt="Icon" class="img-fluid" />
            </a>
        </div> -->
        <div class="col-md-4">
            <a href="{{ item.url | relative_url }}">
                <h4 style="text-align: left;">
                    {{ item.title }}
                </h4>
            </a>
            <p style="text-align: left;">
                {{ item.description }}
            </p>
        </div>
    </div>
    <hr>
    {% endfor %}
</div>