---
title: 测试markdown
date: 2020-02-16 20:03:32
tags:
  - test
  - markdown
  - webhook
description: test markdown
categories: test
mathjax: true
---
![封面](https://670133.s90i.faiusr.com/4/102/AFwIABAEGAAgpOWk8gUosoebpgMwhAc4-wI!1000x1000.png?v=1584188956724&_tm=3)
# 1 一级标题
## 1.1 二级标题
### 1.1 三级标题
#### 1.1.1 四级标题
##### 1.1.1.1 五级标题
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
> 疫情就是命令，防控就是责任。。 ——领袖

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

~~新冠肺炎~~
# 5 插入
## 5.1 链接
### 5.1.1 行内式
公众号文章链接[标题](https://mp.weixin.qq.com/s/s5IhxV2ooX3JN_X416nidA)
### 5.1.2 参考式不生效
[younghz的Markdown库1][1]
[younghz的Markdown库2][2]

[1]:https://github.com/younghz/Markdown
[2]:https://github.com/younghz/Markdown

## 5.2 脚注
全栈工程师[^1]在业务开发流程中起到了至关重要的作用。

# 6 表格
可以使用冒号来定义表格的对齐方式，如下：

| 左对齐   | 居中 |     右对齐 |
| :----- | :--: | -------: |
| 山西 |  133  | 133 |
| 湖北 |  67790  | 52960 |
| 意大利 |  17660  | 1439 |

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

diff:

```diff
+ 新增项
- 删除项
```

# 8 数学公式
## 8.1 可用
### 8.1.1 公式:

$$
  \begin{equation} \label{eq1}
  e=mc^2
  \end{equation}
$$

### 8.1.2 分式:

$$
  x+1\over\sqrt{1-x^2} \tag{i}\label{eq_tag}
$$

### 8.1.3 化学公式：

$$
  \ce{Hg^2+ ->[I-] HgI2 ->[I-] [Hg^{II}I4]^2-}
$$

### 8.1.4 块公式：

$$
  H(D_2) = -\left(\frac{2}{4}\log_2 \frac{2}{4} + \frac{2}{4}\log_2 \frac{2}{4}\right) = 1
$$



# 9 媒体
## 9.1  图片
![图5-1 这里写图片描述](https://1.s91i.faiusr.com/4/AFsIABAEGAAgztrP8QUohNjw0AYwhAc4-wI!800x800.png?v=1580461392155)
支持 jpg、png、gif、svg 等图片格式，**其中 svg 文件仅可在微信公众平台中使用**，svg 文件示例如下：
![图5-2 i_am_svg_20191024083453](https://my-wechat.mdnice.com/mdnice/i_am_svg_20191024083453.svg)

# 10 特殊

## 10.1 HTML
<span style="display:block;text-align:left;color:rgb(255, 0, 54);">天猫红居左</span>
<span style="display:block;text-align:right;color:#ff6a00;">阿里橙居右</span>
<span style="display:block;text-align:center;color:#019fe8;">支付宝蓝居中</span>

## 10.2 Reference
<small>
[1] Github.Websites for you and your projects.[EB/OL].https://pages.github.com .2017
</small>

## 10.3 注释
[tags]: <> (['node','js','java',])

[description]: # (This may be the most platform independent comment)


[^1]:是指掌握多种技能，并能利用多种技能独立完成产品的人