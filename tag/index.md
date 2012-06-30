---
layout: layout
title: Tags (WIP)
---
<h2 class="post_title">{{page.title}}</h2>
<ul>
  {% for post in site.posts %}
  {% for tag in post.tags %}
  <li class="archive_list">
    <time style="color:#000006;font-size:12px;" datetime='{{ post.date | date: "%Y-%m-%d"}}'>{{post.date | date: "%m/%d/%y"}}</time> <a class="archive_list_article_link" href='{{ post.url }}'>{{ post.title }}</a>
    <p class="summary">{{ post.summary }}
     {% for tag in post.tags %}
     |<font size=-1><a class="tag_list_link" href="/tag/{{ tag }}">{{ tag }}</a></font>|
     {% endfor %}
  </li>
  {% endfor %}
  {% endfor %}
</ul>


{{ tag_cloud }}
