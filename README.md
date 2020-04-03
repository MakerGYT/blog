# my blog
[![Build Status](https://makergyt.coding.net/badges/blog/job/187329/master/build.svg)](https://makergyt.coding.net/p/blog/ci/job)
[![gh-pages](https://badgen.net/github/status/makergyt/blog/gh-pages)](https://github.blog.makergyt.com)
[![](https://badgen.net/travis/makergyt/blog)](https://travis-ci.com/MakerGYT/blog)
![license](https://badgen.net/github/license/makergyt/blog)
![last-commit](https://badgen.net/github/last-commit/makergyt/blog)
[![hexo](https://badgen.net/npm/v/hexo)](https://www.npmjs.com/package/hexo)
![](https://img.shields.io/badge/Generator-Hexo-0e83cd?&logo=hexo)
![](https://img.shields.io/badge/Theme-NexT-181717.svg)


warning: deprecated key `skip_cleanup` deploy (not supported in dpl v2, use cleanup), 但是修改后
```sh
Untracked files:
  (use "git add <file>..." to include in what will be committed)
	package-lock.json
nothing added to commit but untracked files present (use "git add" to track)
```


若以`<name>.github.io`访问，需要设置repos名为`<name>.github.io`,即个人主页面,User pages must be built from the master branch.
若以`<name>.github.io/<project>`访问，支持选择branch: gh-pages,master,master /docs, 但是hexo会无样式，需要配置url和root为`/<project>/`,若配置了自定义域名到`<name>.github.io`,则不需要, 但是需要在source下写一个CNAME文件，写入自定义域名（每次重新部署后管理页会清空）  

在[hexo deploy to github pages](https://hexo.io/docs/github-pages)中提到，`without the .gitmodules file.`。往往是themes库，比较大，直接clone都需要较长时间。好处在于方便管理嵌套git库，例如通过`git submodule update`来拉取其更新。但这样的话在push后显示灰色，CI中需要重新clone，耗费构建时间，除非将其视为普通文件即删除.git并add。或者使用github actions。
```yml
# Change headers hierarchy on site-subtitle (will be main site description) and on all post / page titles for better SEO-optimization.
seo: true
{%- if theme.seo %}h2{% else %}h1{%- endif %}
```
anchors level h2

```html
<div class="site-overview-wrap sidebar-panel">
  {{ partial('_partials/sidebar/site-overview.swig', {}, {cache: theme.cache.enable}) }}

  {{- next_inject('sidebar') }}
</div>
```
在display_toc时，由于nav的存在，大小会被挤压变形，故在非主页模式下取消显示。

`hexo-tag-aplayer`读取配置
```js
// lib/config.js
hexo.config.aplayer
```
且有时在已配置
```yml
# config.yml
aplayer:
  meting: true
```
报错`Error: [hexo-tag-aplayer] Meting support is disabled, cannot resolve the meting tags properly.`而不配置并不报错，只是不显示。

```css
.posts-expand .post-meta .post-description {
  font-size: /* 1em !=16px, 16px小于常规*/
  letter-spacing: /* 比常规窄，需要定义*/
}
```

~~未知定义~~
```html
<!-- next/scripts/filters/comment/valine.js -->
<span class="post-meta-item"><span class="post-meta-item-icon"><i class="fa fa-comment-o"></i> </span><span class="post-meta-item-text">Valine：</span> <a title="valine" href="/test/#valine-comments" itemprop="discussionUrl"><span class="post-comments-count valine-comment-count" data-xid="/test/" itemprop="commentCount">1</span></a></span>
```

tags无法插入到description下面


head.swig无法获取post变量

keywords配置响应未知

不做缩进，也便需要段后１行

counters(sectioncounter, lower-alpha)". ";不支持，故不做级联序号
font
- https://fonts.lug.ustc.edu.cn
- https://fonts.loli.net
- https://fonts.font.im
- https://fonts.gstatic.font.im
- fonts.useso.com

chrome有效, qq browser中英文均无效，微信内置浏览器中文无效，开发者工具均有效
```html
<!-- 有效　-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Serif+SC:wght@400;500;700&family=Source+Code+Pro:ital,wght@0,400;0,700;1,400;1,700&family=Cinzel+Decorative:wght@700&display=swap">
<!-- 无效，　但单独样例有效-->
<link rel="stylesheet" href="https://fonts.googleapis.cnpmjs.org/css?family=Lato:300,300italic,400,400italic,700,700italic|SimHei:300,300italic,400,400italic,700,700italic|Noto Serif SC:300,300italic,400,400italic,700,700italic&display=swap&subset=latin,latin-ext">
```


```sh
https://fonts.googleapis.com/css2?family=Noto%20Serif%20SC:wght@400;500;700&display=swap&subset=latin,latin-ext&family=Times%20New%20Roman:wght@400;500;700&display=swap&subset=latin,latin-ext  #无效
https://fonts.googleapis.com/css2?family=Noto%20Serif%20SC:wght@400;500;700&display=swap&subset=latin,latin-ext　#有效
```
后者缺少font-weight 500,而已经指定其为500

- 如果没有文章,会404,index.html都没有
- 深色模式未响应

主题色`#027AFF`,沾点财气:
- tag meting.theme
- android_chrome_color,reading_progress.color
- varible $primary-color

通过github pages搭建博客最简单的便是直接存放md文件，便可自动解析，但是
- 支持的语法有限，不支持的会提交失败
- 样式固定
- 无法生成目录

需求
- 简洁，样式依赖少
- 可配置
- 支持通用md语法，包含数学公式，保持独立性
- 响应式设计

error:
- 换用markdown-it后，一级标题失去锚点
- `\\`被转义成`\`,需使用`\\\\` =>http://qwqbear.coding.me/article/mathjax-problem/

- [中文字体压缩器](https://github.com/aui/gulp-font-spider)

*About the configuration of this website*
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
  "version": "0.0.0",
  "private": true,
  "hexo": {
    "version": ""
  },
  "dependencies": {
    "hexo": "^3.8.0",
    "hexo-generator-archive": "^0.1.5",
    "hexo-generator-category": "^0.1.3",
    "hexo-generator-index": "^0.2.1",
    "hexo-generator-tag": "^0.2.0",
    "hexo-renderer-ejs": "^0.3.1",
    "hexo-renderer-stylus": "^0.3.3",
    "hexo-renderer-marked": "^0.3.2",
    "hexo-server": "^0.3.3"
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
author: Gao Yuting
language:
  - zh-CN
  - en
  
timezone: Asia/Shanghai
# URL
url: https://blog.makergyt.com
permalink: :lang/:title/
permalink_defaults:
  lang: zh-CN
root: /
# Deployment
deploy:
  - type: git
    repo: git@github.com:MakerGYT/makergyt.github.io.git
    branch: master
  - type: git
    repo: git@git.dev.tencent.com:memakergytcom/blog.git
    branch: master
# Writing
new_post_name: :lang/:title.md
```

### 2.1.1 deployment

```sh
cnpm install hexo-deployer-git --save
# deploy on coding pages `Error`: no styles
# next/_config.yml
- type: git
    - repo: git@git.dev.tencent.com:memakergytcom/blog.git
    + repo: git@git.dev.tencent.com:memakergytcom/memakergytcom.git
    # The authorities did not say,project name must be user name when coding pages is used (similar to github pages).This is a bug:
    - url:memakergytcom.coding.me/blog
    + url:memakergytcom.coding.me
    # my url: blog-cn.makergyt.com
```

~~### 2.1.2 hexo-qiniu-sync~~

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

### 2.2.4 Languages
```sh
# /themes/next/languages/en.yml
menu: 
  photos: Photos
  notebook: Notebook
# /themes/next/languages/zh-CN.yml
menu:
  photos: 影像
  notebook: 笔记
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
<small>[2] 程序鱼.nodejs前端模板引擎swig入门[EB/OL].https://www.jianshu.com/p/f0bffc42c1ce</small>