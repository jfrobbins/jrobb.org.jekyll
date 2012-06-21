---
layout: layout
title: jrobb.org
---

#{{page.title}}

This is a static page which serves as a hub for a lot of things that I work on. 
For more up-to-date content, see my [blog](/blog.html). 
There is also [factorQ.net wordpress](http://factorq.wordpress.com), which is now just an archive of what it WAS--all of the actual content has been merged/absorbed into this site.

I've started using Jekyll for the blog, which so far it is pretty awesome.  Static HTML FTW.

		 -Jon  

2012.06.19

----------
## Recent Blog Posts:


{% for post in site.posts limit:7 %}
* <b><a href="{{ post.url }}">{{ post.title }}</a></b></font> // {{ post.date | date: "%B %e, %Y" }}

{% endfor %}
