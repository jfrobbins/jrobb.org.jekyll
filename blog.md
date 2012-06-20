---
layout: layout
title: jrobb's blog
---

#{{page.title}}

<div class="content">
  <div class="related">
      {% for post in site.posts limit:15 %}
	<font size=+2><b><a href="{{ post.url }}">{{ post.title }}</a></b></font> // {{ post.date | date: "%B %e, %Y" }}</font>
	{{ post.content }}
	

    	-----

      {% endfor %}
  </div>
</div>
