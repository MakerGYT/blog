---
title: About the configuration of this website
date: 2019-12-27 10:17:14
comments: false
---
# 1 Init
## 1.1 Download

### 1.1.1 hexo

```sh
hexo init makergyt.github.io
cd makergyt.github.io
cnpm install
# package.json
{
  "name": "hexo-site",
  "version": "0.3.1",
  "private": true,
  "hexo": {
    "version": "4.2.0"
  },
  "dependencies": {
    "hexo": "^4.2.0",
    "hexo-generator-archive": "^1.0.0",
    "hexo-generator-category": "^1.0.0",
    "hexo-generator-index": "^1.0.0",
    "hexo-generator-tag": "^1.0.0",
    "hexo-renderer-ejs": "^1.0.0",
    "hexo-renderer-marked": "^2.0.0",
    "hexo-renderer-stylus": "^1.1.0",
    "hexo-server": "^1.0.0",
  }
}
```

### 1.1.2 next

```sh
cd makergyt.github.io
git clone https://github.com/theme-next/hexo-theme-next themes/next
```

# 2 user-defined

## 2.1 hexo

```yml
# ./_config.yml
# Site
title: MakerGYT
subtitle: Technology returns to art
description: 
keywords: blog makergyt
author: Gao Yuting
language:
  - en
  
timezone: Asia/Shanghai
# URL
url: https://blog.makergyt.com
```
file define:
`categories`+`title`+`type`~~
### 2.1.2 hexo-reference
```sh
cnpm install hexo-reference --save
# ./_config.yml
Plugins:
  - hexo-reference
```
## 2.2 next

```yml
# next/_config.yml
menu:
  home: / || chrome
  about: /about/ || address-card
  categories: /categories/ || th
  archives: /archives/ || archive
favicon: # makergyt.github.io/source/images/
  small: /images/favicon-16x16.png
  medium: /images/favicon-32x32.png
  apple_touch_icon: /images/apple-touch-icon.png
  safari_pinned_tab: /images/safari-pinned-tab.svg
  ms_browserconfig: /images/browserconfig.xml
  # need to transparent
footer:
  since: 2018
  icon:
    name: heart
    animated: true
    color: "#ff0000"
  powered:
    enable: false
  beian:
    enable: true
    icp: 陕ICP备16017712号-1
creative_commons:
  license: by-nc-sa
  sidebar: true
  post: false
  language: deed.zh
github_banner:
  enable: true
  permalink: https://github.com/makergyt
  title: GitHub
mobile_layout_economy: true
custom_logo:
  enable: true
  image: /images/favicon-32x32.png
font:
  enable: true
  global:
    family: Monda
motion:
  enable: true
  transition:
    post_block: shrinkIn
seo: true
cheers: false
scroll_to_more: true
save_scroll: true
codeblock:
  copy_button:
    enable: true
    show_result: true
    style: flat
highlight_theme: normal
wechat_subscriber:
  enable: true
  qcode: /images/wechat-qcode.jpg
  description: scan to see the vaster world
reward_settings:
  enable: true
  animation: false
  comment: Add chicken leg
reward:
  wechat: /images/wechatpay.png
related_posts:
  enable: true
social:
  E-Mail: mailto:me@makergyt.com || envelope
  Weibo: https://weibo.com/u/5165628041 || weibo
  Twitter: https://twitter.com/makergyt || twitter
  FB Page: https://www.facebook.com/makergyt || facebook
  500PX: https://500px.com || 500px
  Telegram: https://t.me/makergyt || telegram
social_icons:
  enable: true
  icons_only: true
links_icon: anchor
links:
  Main site: https://makergyt.com
back2top:
  enable: true
  sidebar: true
  scrollpercent: true
gitalk:
  enable: true
  github_id: makergyt
  repo: makergyt.github.io
  client_id: 64a9c28ff540acfb8d4b
  client_secret: 647cb5af47a926a76f6eb1d1001fe8a5230dd0b0
  admin_user: makergyt
baidu_analytics: 3af747eaf2360bbaf46d8aa9f5b62d22
reading_progress:
  enable: true
reading_progress: //cdn.jsdelivr.net/gh/theme-next/
theme-next-reading-progress@1.1/reading_progress.min.js
canvas_nest: true
canvas_nest: //cdn.jsdelivr.net/npm/canvas-nest.js@1.0.1/dist/canvas-nest.min.js
math:
  enable: true
  per_page: true
  engine: mathjax
  mathjax:
    cdn: //cdn.jsdelivr.net/npm/mathjax@2/MathJax.js?config=TeX-AMS-MML_HTMLorMML
note:
  style: flat
pdf:
  enable: true
google_site_verification: XAprdFd37bx8X8i-_S77-8ArPy8hkI5RCtKym1Z52rY
bing_site_verification: E14AC9D3BA8CE3C20D05F77EE7BC738F
mermaid:
  enable: true
  theme: default
  cdn: //cdn.jsdelivr.net/npm/mermaid@8.0.0/dist/mermaid.min.js
```

### 2.2.1 404

```sh
# source/404/404.md
---
title: 404
date: 1970-01-01 00:00:00
---

<script src="//qzonestyle.gtimg.cn/qzone/hybrid/app/404/search_children.js" charset="utf-8" homePageUrl="/" homePageName="Back to home"></script>

```

### 2.2.2 Post Wordcount

```sh
cnpm install hexo-symbols-count-time --save
# ./_config.yml
symbols_count_time:
  symbols: true
  time: true
  total_symbols: false
  total_time: false
# next/_config.yml
symbols_count_time:
  separated_meta: true
  item_text_post: true
  item_text_total: false
  awl: 4
  wpm: 275
```

### 2.2.3 Local Search

```sh
cnpm install hexo-generator-searchdb --save
# ./_config.yml
search:
  path: search.xml
  field: post
  format: html
  limit: 10000
# next/_config.yml
local_search:
  enable: true
fancybox: true
fancybox: //cdn.jsdelivr.net/gh/fancyapps/fancybox@3/dist/jquery.fancybox.min.js
fancybox_css: //cdn.jsdelivr.net/gh/fancyapps/fancybox@3/dist/jquery.fancybox.min.css
```
### 2.2.5 encrypt
```sh
cnpm install --save hexo-blog-encrypt
# ./_config.yml
# Security
encrypt:
    enable: true
```
### 2.2.6 music
#### 2.2.6.1 sidebar
```sh
# /themes/next/layout/_partials_/siderbar/site-overview.swig
{% if theme.music.enabled %}
  <iframe frameborder="no" border="0" marginwidth="0" marginheight="0" width=330 height=86 src="{{ theme.music.song }}"></iframe>
{% endif %}
# next/_config.yml
music: 
  enabled: true
  song: https://music.163.com/outchain/player?type=2&id=28692687&auto=0&height=66
```
#### 2.2.6.2 page
```sh
cnpm install --save hexo-tag-aplayer
# ./_config.xml
aplayer:
  meting: true
# ./about/index.md
{% meting "2526283537" "netease" "playlist" "mutex:false" "listmaxheight:340px" "preload:none" "theme:#FC6423"%}
```
### 2.2.7 Valine
#### 2.2.7.1 部署
#### 2.2.7.2 设置
#### 2.2.7.3 定时任务
https://github.com/zhaojun1998/Valine-Admin
https://github.com/DesertsP/Valine-Admin
https://deserts.io/valine-admin-document/#%E9%98%B2%E6%AD%A2%E4%BA%91%E5%BC%95%E6%93%8E%E4%BC%91%E7%9C%A0
# Reference
<small>[1] NexT.Gemini.Documentation[EB/OL].https://theme-next.org/docs/ .2019.</small>