---
layout: layout
title: jrobb's blog
---

#{{page.title}}
<font size=-1><a href="/feed/">rss feed</a><a href="/feed/"><img src="/images/feed-icon-14x14.png"></a></font>


{% for post in site.posts %}

*<font size=+1>{{ post.date | date: "%Y, %B %e" }}</font> // <font size=+1><b><a href="{{ post.url }}">{{ post.title }}</a></b></font> //<font size=-1> Tags: {% for tag in post.tags %} <em> <a href="/tag/{{ tag }}"> {{ tag }} </a> </em>{% endfor %} </font>//

{% endfor %}

