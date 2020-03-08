---
title: 换个标题
date: 2020-02-16 20:03:32
tags:
  - test
  - markdown
  - webhook
description: test markdown
---
![](https://cdn.blog.makergyt.com/images/news-week_bulletin-cover.png)

# 1 一级标题
## 1.2 二级标题
### 1.3 三级标题
# 2 列表
## 2.1 无序列表
无序列表的使用，在符号`-`后加空格使用。如下：
- 无序列表 1
- 无序列表 2
- 无序列表 3

如果要控制列表的层级，则需要在符号`-`前使用空格。如下：
- 无序列表 1
- 无序列表 2
  - 无序列表 2.1
  - 无序列表 2.2

## 2.2 有序列表
有序列表的使用，在数字及符号`.`后加空格后输入内容，如下：
1. 有序列表 1
2. 有序列表 2
3. 有序列表 3

# 3 引用
引用的格式是在符号`>`后面书写文字。如下：
> 读一本好书，就是在和高尚的人谈话。 ——歌德

# 4 字体
## 4.1 粗体和斜体
**这个是粗体**

*这个是斜体*

***这个是粗体加斜体***

## 4.2 分割线
可以在一行中用三个以上的减号来建立一个分隔线，同时需要在分隔线的上面空一行。如下：

---

## 4.3 删除线
删除线的使用，在需要删除的文字前后各使用两个`~`，如下：

~~这是要被删除的内容。~~
## 4.4 注音符号

Markdown Nice 这么好用，简直是{喜大普奔|hē hē hē hē}呀！
# 5 插入
## 5.1 链接
公众号文章链接[标题](https://mp.weixin.qq.com/s/s5IhxV2ooX3JN_X416nidA)

外部链接[博客](https://blog.makergyt.com)
## 5.2 图片
![这里写图片描述](https://cdn.blog.makergyt.com/images/book-Cries_in_the_Drizzle-cover.jpg)
支持 jpg、png、gif、svg 等图片格式，**其中 svg 文件仅可在微信公众平台中使用**，svg 文件示例如下：

![](https://my-wechat.mdnice.com/mdnice/i_am_svg_20191024083453.svg)
## 5.3 脚注
[全栈工程师](是指掌握多种技能，并能利用多种技能独立完成产品的人。 "什么是全栈工程师")在业务开发流程中起到了至关重要的作用。

## 5.4 引用
Here's a footnote [^1]. Here's a horizontal rule:

# 6 表格
可以使用冒号来定义表格的对齐方式，如下：

| 姓名   | 年龄 |     工作 |
| :----- | :--: | -------: |
| 小可爱 |  18  | 吃可爱多 |
| 小小勇敢 |  20  | 爬棵勇敢树 |
| 小小小机智 |  22  | 看一本机智书 |

# 7 代码块
如果在一个行内需要引用代码，只要用反引号引起来就好，如下：

Use the `printf()` function.

在需要高亮的代码块的前一行及后一行使用三个反引号，同时**第一行反引号后面表示代码块所使用的语言**，如下：

```java
// FileName: HelloWorld.java
public class HelloWorld {
  // Java 入口程序，程序从此入口
  public static void main(String[] args) {
    System.out.println("Hello,World!"); // 向控制台打印一条语句
  }
}
```

diff 不能同时和其他语言的高亮同时显示，且需要调整代码主题为微信代码主题以外的代码主题才能看到 diff 效果，使用效果如下:

```diff
+ 新增项
- 删除项
```

# 8 数学公式
行内公式使用方法，比如这个化学公式：$\ce{Hg^2+ ->[I-] HgI2 ->[I-] [Hg^{II}I4]^2-}$

块公式使用方法如下：

$$H(D_2) = -\left(\frac{2}{4}\log_2 \frac{2}{4} + \frac{2}{4}\log_2 \frac{2}{4}\right) = 1$$

矩阵：

$$
  \begin{pmatrix}
  1 & a_1 & a_1^2 & \cdots & a_1^n \\
  1 & a_2 & a_2^2 & \cdots & a_2^n \\
  \vdots & \vdots & \vdots & \ddots & \vdots \\
  1 & a_m & a_m^2 & \cdots & a_m^n \\
  \end{pmatrix}
$$

# 9 特殊

## 9.1 HTML

<span style="display:block;text-align:right;color:orangered;">橙色居右</span>
<span style="display:block;text-align:center;color:orangered;">橙色居中</span>

## 9.2 Reference
<small>
[1] Github.Websites for you and your projects.[EB/OL].https://pages.github.com .2017
</small>

## 9.3 注释
[tags]: <> (['node','js','java',])

[description]: # (This may be the most platform independent comment)

[^1]: Jeremy Howard.Your own hosted blog[EB/OL].https://www.fast.ai/2020/01/16/fast_template/ .2020.