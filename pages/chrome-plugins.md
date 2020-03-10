---
layout: page
title : Chrome Plugins
permalink: /chrome-plugins/
# subtitle: "Projects I am working on"
feature-img: "assets/img/pexels/computer.jpeg"
# tags: [Archive]
bootstrap: true
---

<div class="container-fluid">
    <div class="row justify-content-center">
        {% for item in site.chrome-plugins %}
        <div class="col-6">
            <div class="row">
                <div class="col-4">
                    <a href="{{ item.url | relative_url }}">
                        <img src="{{ item.icon | relative_url }}" alt="Icon" class="img-fluid" />
                    </a>
                </div>
                <div class="col-8">
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
        </div>
        {% endfor %}
    </div>
</div>