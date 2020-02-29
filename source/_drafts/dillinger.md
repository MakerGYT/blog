---
title: Dillinger Deploy Record
date: 2019-01-17 20:39:40
tags: markdown
categories: config
---
```js
// package-lock.json 
// line 15310 
"phantomjs": "~1.9.7" ->         "phantomjs": "~2.1.16"
// line 15380
"version": "1.9.20" ->"version": "2.1.16"
```
<!-- more -->

```js
// app.js line 46 ?
//May not need to use favicon if using nginx for serving
//static assets. Just comment it out below.
app.use(favicon(path.join(__dirname, 'public/favicon.ico')))
// app.js line 79 ?
//Let's 301 redirect to simply dillinger.io
```
The above problems have not been solved yet,but the main problem is the inability to modify the template file "readme.md" that was initially loaded.The location of this configuration cannot be located at this time.

So I started generating my own build editor.
Requirements are summarized as follows:

<center>markdown online</center>
>- editor
 - [x] real-time preview
 - [x] automatically save
 - [x] math expressions
 advanced:
 - [ ] syntax hint
 - [ ] double bar rolling(change working-mode)
 - [ ] save to cloud such as github repositories
 - [ ] image cdn
- file
 - [x] import .md file
 - [x] export .md,html(style),PDF
- hexo admin
 - [x] bind with github,generate and deploy?
   install the hexo blog and hexo editor at the same host 
- requirements:
 - [x] open source
 - [ ] design for public 
   All files are temporarily stored
   but also for private use:
   Bind account and login by authorization
- reference:
 - [dillinger](https://github.com/joemccann/dillinger)
 - [hexo editor](https://github.com/tajpure/hexo-editor)
 
 
 So it looks like we're going to have to use VPS，so here comes the question:
 
 Why not just deploy hexo directly on top of it when you have VPS?
 
 Does extending so much functionality violate hexo's simplicity?
 
 It's going to look more and more like a CMS,
 
 So if this goes on, what's the point of hexo versus wordpress？
 
 I'm starting to get lost...

 
