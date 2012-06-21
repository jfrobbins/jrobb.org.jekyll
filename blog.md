---
layout: layout
title: jrobb's blog
---

#{{page.title}}

{% for post in site.posts %}

* <font size=+1><b><a href="{{ post.url }}">{{ post.title }}</a></b></font> // {{ post.date | date: "%B %e, %Y" }}</font>

{% endfor %}
