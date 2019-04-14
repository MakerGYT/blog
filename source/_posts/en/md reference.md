---
title: markdown reference
date: 2019/3/31 20:46:25
categories: reference
tags: markdown
comments: false
mathjax: true
---

### math

$$x+1\over\sqrt{1-x^2} \tag{i}\label{eq_tag}$$

<!-- more -->

$$\begin{align}
-4 + 5x &= 2+y \nonumber  \\
 w+2 &= -1+w \\
 ab &= cb
\end{align}$$

$$\begin{equation}
\begin{aligned}
a &= b + c \\
  &= d + e + f + g \\
  &= h + i
\end{aligned}
\end{equation}\label{eq2}$$

$$\begin{equation}
e=mc^2
\end{equation}\label{eq1}$$

### reference

<small>[1] samypesse.how-to-create-an-operating-system[EB/OL].https://samypesse.gitbooks.io/how-to-create-an-operating-system .2015.</small> 

### Centered Quote

{% cq %}Elegant in code, simple in core{% endcq %}

### note

{% note default %}
#### Default Header
Welcome to [Hexo!](https://hexo.io)
{% endnote %}

{% note primary %}
#### Primary Header
**Welcome** to [Hexo!](https://hexo.io)
{% endnote %}

{% note info %}
### Info Header
**Welcome** to [Hexo!](https://hexo.io)
{% endnote %}

{% note warning %}
#### Warning Header
**Welcome** to [Hexo!](https://hexo.io)
{% endnote %}

{% note danger %}
#### Danger Header
**Welcome** to [Hexo!](https://hexo.io)
{% endnote %}

{% note info no-icon %}
#### No icon note
Note **without** icon: `note info no-icon`
{% code %}
code block in note tag
code block in note tag
code block in note tag
{% endcode %}
{% endnote %}

{% note success %}
#### Success Header
**Welcome** to [Hexo!](https://hexo.io)
{% endnote %}

### Tab

{% tabs First unique name %}
<!-- tab Solution 1-->
**This is Tab 1.**
<!-- endtab -->

<!-- tab @amazon-->
{% code %}
code tag
code tag
code tag
{% endcode %}
<!-- endtab -->

<!-- tab -->
{% note default %}
Note default tag.
{% endnote %}
<!-- endtab -->
{% endtabs %}

### Video
{% youtube Kt7u5kr_P5o %}

### Group picture

{% grouppicture 5-2 %}
  ![](https://d33wubrfki0l68.cloudfront.net/e2ecd9e90ca2a56af8d7be434b7fdc39cbd454c9/da9b7/images/docs/github.png)
  ![](https://d33wubrfki0l68.cloudfront.net/e2ecd9e90ca2a56af8d7be434b7fdc39cbd454c9/da9b7/images/docs/github.png)
  ![](https://d33wubrfki0l68.cloudfront.net/e2ecd9e90ca2a56af8d7be434b7fdc39cbd454c9/da9b7/images/docs/github.png)
{% endgrouppicture %}

### PDF

{% pdf https://alicdn.makergyt.com/blog/document.pdf %}

### mermaid

{% mermaid graph TD %}
A[Christmas] -->|Get money| B(Go shopping)
B --> C{Let me thinksssss<br/>ssssssssssssssssssssss<br/>sssssssssssssssssssssssssss}
C -->|One| D[Laptop]
C -->|Two| E[iPhone]
C -->|Three| F[Car]
{% endmermaid %}

{% mermaid gantt %}
dateFormat  YYYY-MM-DD
axisFormat  %d/%m
title Adding GANTT diagram to mermaid

section A section
Completed task            :done,    des1, 2014-01-06,2014-01-08
Active task               :active,  des2, 2014-01-09, 3d
Future task               :         des3, after des2, 5d
Future task2               :         des4, after des3, 5d

section Critical tasks
Completed task in the critical line :crit, done, 2014-01-06,24h
Implement parser and jison          :crit, done, after des1, 2d
Create tests for parser             :crit, active, 3d
Future task in critical line        :crit, 5d
Create tests for renderer           :2d
Add to mermaid                      :1d

section Documentation
Describe gantt syntax               :active, a1, after des1, 3d
Add gantt diagram to demo page      :after a1  , 20h
Add another diagram to demo page    :doc1, after a1  , 48h

section Last section
Describe gantt syntax               :after doc1, 3d
Add gantt diagram to demo page      : 20h
Add another diagram to demo page    : 48h
{% endmermaid %}

{% mermaid gitGraph: %}
options
{
    "nodeSpacing": 150,
    "nodeRadius": 10
}
end
commit
branch newbranch
checkout newbranch
commit
commit
checkout master
commit
commit
merge newbranch
{% endmermaid %}

{% qnimg book.jpg title:图片标题 alt:图片说明  extend:?imageView2/2/w/600 %}

basic footnote[^1]
here is an inline footnote[^2](inline footnote)
and another one[^3]
and another one[^4]

[^1]: basic footnote content
[^3]: paragraph
footnote
content
[^4]: footnote content with some [markdown](https://en.wikipedia.org/wiki/Markdown)

{% pdf https://blog-cdn.makergyt.com/progit.pdf %}