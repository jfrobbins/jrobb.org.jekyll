---
layout: layout
title: tags
tags: tag
---

#{{page.title}}

<ul>
{% for post in page.posts %}
  <li><a href="{{ post.url }}">{{ post.title }}</a> ({{ post.date | date_to_string }} | Tags: {{ post | tags }})</li>
{% endfor %}
</ul>

<div id="tag-cloud">
  {{ site | tag_cloud }}
</div>
