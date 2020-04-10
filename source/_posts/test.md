---
title: 排版规约
date: 2020-04-01 20:03:32
tags:
  - 测试
  - 排版
  - 标记
description: 摘要是发明或者实用新型说明书的简明摘要。应当对发明或者实用新型的主题和实质内容作简要说明。本文的主要目的是方便人们进行文献检索和初步分类。
categories: test
mathjax: true
cover: https://670133.s90i.faiusr.com/4/102/AFwIABAEGAAgpOWk8gUosoebpgMwhAc4-wI!1000x1000.png?v=1584188956724&_tm=3
language: zh-CN
---
## 1 一级标题
章标题居中，三号黑体，使用`##`。
### 1.1 二级标题
章下为节，节标题四号黑体，使用`###`。
#### 1.1.1 三级标题
节下为小节，小节标题小四黑体，使用`####`。
##### 1.1.1.1 四级标题
###### 1.1.1.1.1 五级标题
一般只使用一二三级标题。
## 2 列表
### 2.1 无序列表
无序列表在符号`-`后加空格使用：
- 无序列表 1
- 无序列表 2
- 无序列表 3

如果要控制列表的层级，则需要在符号`-`前使用空格：
- 无序列表 1
- 无序列表 2
  - 无序列表 2.1
  - 无序列表 2.2

对条文内容采用分行并叙, 或结构有层级关系。**列举结束必须换行**。
### 2.2 有序列表
有序列表的使用，在数字及符号`.`后加空格后输入内容，如下：
1. 有序列表 1
2. 有序列表 2
3. 有序列表 3

小节以下标题, 或表达同步顺序关系。**如果编号及其后内容新起一个段落，则需要换行,列举结束必须换行**
## 3 引用
引用的格式是在符号`>`后面书写文字。如下：
> 疫情就是命令，防控就是责任。 ——领袖

用于大段原文引用，**引用结束必须换行**。

## 4 文本
### 4.1 粗体和斜体
**用粗体标识段落内强调项**，*一般只在英文中使用斜体*，***用粗体加斜体标识注意项***。
如果信息之间关联性越高，它们之间的距离就应该越接近，也越像一个视觉单元；反之，则它们的距离就应该越远，也越像多个视觉单元。亲密性的根本目的是实现组织性，让用户对页面结构和信息层次一目了然。

正如「格式塔学派」中的连续律（Law of Continuity）所描述的，在知觉过程中人们往往倾向于使知觉对象的直线继续成为直线，使曲线继续成为曲线。在界面设计中，将元素进行对齐，既符合用户的认知特性，也能引导视觉流向，让用户更流畅地接收信息[^1]。

### 4.2 分割线
可以在一行中用三个以上的减号来建立一个分隔线，同时需要在分隔线的上面空一行。如下：

---

### 4.3 删除线
删除线的使用，在需要删除的文字前后各使用两个`~`，如下：

~~新冠肺炎~~
## 5 插入
### 5.1 链接
一个在hexo博客中插入豆瓣读书的[npm包](https://github.com/makergyt/hexo-tag-book-douban)。
### 5.2 脚注
要在标点符号之前使用[^2]，用于备注，或综合原文得到的结论。**注解自动生成在最后，但还应该写在最后**。
## 6 表格
可以使用冒号来定义表格的对齐方式，如下：

| 居中  |左对齐  | 右对齐 | 备注 |
| :--: | :-- | -------: | :--: |
| 山西 |  133  | 133 |2|
| 湖北 |  67790  | 52960 |2895|
| 意大利 |  17660  | 1439 |80539|

## 7 代码块
如果在一个行内需要引用代码，只要用反引号引起来就好，如下：

Use the `printf()` function.

在需要高亮的代码块的前一行及后一行使用三个反引号，同时**第一行反引号后面表示代码块所使用的语言**，如下：

```java
//要写清文件位置信息
public class HelloWorld {
  public static void main(String[] args) {
    System.out.println("Hello,World!"); // 评论
  }
}
```

diff:

```diff
+ 新增项
- 删除项
```

## 8 数学公式
### 8.1 可用
#### 8.1.1 公式:

$$
  \begin{equation}
  e=mc^2
  \end{equation}
$$

#### 8.1.2 分式:
$\frac {a+1}{b+2}$ 和 $x={a+1 \over b+1}$

$$
{
  x+1\over\sqrt{1-x^2} 
}  \qquad(1)
$$

$$
{
e^x=\lim_{n\to\infty} \left( 1+\frac{x}{n} \right)^n
\qquad (2) 
}
$$
#### 8.1.3 化学公式：

$$
  \ce{Hg^2+ ->[I-] HgI2 ->[I-] [Hg^{II}I4]^2-}
$$

#### 8.1.4 块公式：

$$
  H(D_2) = -\left(\frac{2}{4}\log_2 \frac{2}{4} + \frac{2}{4}\log_2 \frac{2}{4}\right) = 1
$$

$$ 
  \sum_{i=0}^n = \frac{(n^2+n)(2n+1)}{6}
$$

#### 8.1.5 内联公式
$\sum_{i=0}^n$ 和 $\frac{1}{2}$ 

**开头的`$`必须在其右边紧跟一个非空格字符，而结尾的`$`必须在其左边紧接一个非空格字符，并且不能紧跟一个数字。**
#### 8.1.6 希腊字母

对于希腊字母，用 $\alpha \beta,...,\omega$来表示。

$\phi \varphi$ 和 $\ell$

#### 8.1.7 上下标

分别使用 ^ 和 _ 实现，比如：$x_i^{10}$ = ; ${x^y}^z$ = ; $x_{i^{10}}$ = 

开根号$\sqrt[4] {x_3}$

字母顶部
- $\hat x$, $\widehat{xy}$
- $\bar x$, $\overline {xyz}$
- $\overrightarrow {xy}$, $\overleftrightarrow {xy}$
- $\dot x$

#### 8.1.8 括号
圆括号和方括号 $(2+2)[4-4]$ = 
花括号需要用\{和\}表示，比如$\{x| x>0\}$ = 
遇到高度较高的分数，括号会变小，如 $(\frac{\sqrt x}{y^3})$ = ，可以使用`\left(…\right)`可以自动调整括号的行高，比如 $\left(\frac{\sqrt x}{y^3}\right)$ = 

#### 8.1.9 求和、极限与积分
$\sum_1^n$ = ，$\int$= ，$\prod$ = 
$\bigcup$ = ，$\bigcap$ = ，$\iint$ = 

$$
\lim_{k\to\infty}k^{-1} = 0
$$

$$
\sum_{k=1}^{n}f(k)
$$

#### 8.1.10 特殊函数
初等函数
$\log_a b$， $\ln b$， $\sin x$ ，$\max x$ 
#### 8.1.11 特殊符号
- $\lt \gt \le \ge \neq$
- $\times \div \pm \mp$
- $\cup \cap \setminus \subset \subseteq \subsetneq \supset \in \notin \emptyset \varnothing$
- ${n+1 \choose 2k}$ or $\binom{n+1}{2k}$
- $\to \rightarrow \leftarrow \Rightarrow \Leftarrow \mapsto$
- $\land \lor \lnot \forall \exists \top \bot \vdash \vDash$
- $\approx \sim \simeq \cong \equiv \prec$
- $a\equiv b\pmod n$
- $a_1,a_2,\ldots,a_n$
- $a_1+a_2+\cdots+a_n$
- $\infty \aleph_0$，$\nabla \partial$，$\Im \Re IR$

#### 8.1.12 纯文本
$$\\{x\in s | \text{x is extra large}\\}$$
单空格$a \ b$， 多空格$a \quad b$。

### 8.2 可能有误

#### 8.2.1 等式未断行:

$$
  \begin{equation} \label{eq2}
  \begin{aligned}
  a &= b + c  \\\\
    &= d + e + f + g \\\\
    &= h + i \\\\
  \end{aligned}
  \end{equation}
$$

#### 8.2.2 方程未断行不支持多行编号: 

$$
  \begin{align}
  a &= b + c \label{eq3} \\\\
  x &= yz \\\\
  l &= m - n \\\\
  \end{align}
$$

#### 8.2.3 多列式未断行不编号:

$$
  \begin{align}
  -4 + 5x &= 2+y \\\\
  w+2 &= -1+w \\\\
  ab &= cb \\\\
  \end{align} 
$$

#### 8.2.4 矩阵未断行：

$$
  \begin{pmatrix}
  1 & a_1 & a_1^2 & \cdots & a_1^n \\\\
  1 & a_2 & a_2^2 & \cdots & a_2^n \\\\
  \vdots & \vdots & \vdots & \ddots & \vdots \\\\
  1 & a_m & a_m^2 & \cdots & a_m^n \\\\
  \end{pmatrix}
$$

#### 8.2.5 分支等式未换行
$$
f(n)=
\begin{cases}
n/2,& \text{if $n$ is even}\\\\
3n+1,& \text{if $n$ is odd}
\end{cases}
$$

#### 8.2.6 表格式数组
$$
\begin{array}{c|lcr}
n & \text{Left} & \text{Center} & \text{Right} \\\\
\hline
1 & 0.24 & 1 & 125 \\\\
2 & -1 & 189 & -8 \\\\
3 & -20 & 2000 & 1+10i
\end{array}
$$

## 9 媒体
### 9.1  图片
![图5-1 这里写图片描述](https://1.s91i.faiusr.com/4/AFsIABAEGAAgztrP8QUohNjw0AYwhAc4-wI!800x800.png?v=1580461392155)
支持 jpg、png、gif、svg 等图片格式，svg 文件示例如下：
![图5-2 i_am_svg_20191024083453](https://my-wechat.mdnice.com/mdnice/i_am_svg_20191024083453.svg)

## 10 特殊
**一般不使用，除非万不得已**
### 10.1 HTML
<span style="display:block;text-align:left;color:rgb(255, 0, 54);">天猫红居左</span>
<span style="display:block;text-align:right;color:#ff6a00;">阿里橙居右</span>
<span style="display:block;text-align:center;color:#019fe8;">支付宝蓝居中</span>

### 10.2 注释(不被解析)
[tags]: <> (['node','js','java',])

[description]: # (This may be the most platform independent comment)

[^1]: Ant design.设计模式.[EB/OL].https://ant.design/docs/spec/introduce-cn .2020
[^2]: Github.Mastering Markdown.[EB/OL].https://guides.github.com/features/mastering-markdown/ .2014