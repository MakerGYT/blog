---
title: Test Markdown
date: 2020-02-16 20:03:32
tags:
  - test
  - markdown
  - webhook
description: Abstract is a concise abstract of the specification of an invention or utility model. The subject matter and substance of the invention or utility model should be described concisely. The important purpose of this paper is to facilitate people's literature retrieval and preliminary classification.
categories: test
mathjax: true
cover: https://670133.s90i.faiusr.com/4/102/AFwIABAEGAAgpOWk8gUosoebpgMwhAc4-wI!1000x1000.png?v=1584188956724&_tm=3
---
# 1 h1
## 1.1 h2
### 1.1.1 h3
#### 1.1.1.1 h4
##### 1.1.1.1.1 h5
# 2 List
## 2.1 Unordered list
For the use of unordered lists, use spaces after the symbols`-`. As follows:
- Unordered list 1
-Unordered list 2
-Unordered list 3

If you want to control the level of the list, you need to use spaces before the symbols`-`. As follows:
- Unordered list 1
- Unordered list 2
  - Unordered list 2.1
  - Unordered list 2.2

## 2.2 Ordered list
For the use of an ordered list, enter the contents after adding spaces after the numbers and symbols, as follows:
1. Ordered list 1
2. Ordered list 2
3. Ordered list 3

# 3 Quote
The format of the reference is to write after the symbol. As follows:
> Epidemic is order, prevention and control is responsibility  ——leader

# 4 Font
## 4.1 Bold and italics
**This is bold**

*This is italics*

***This is bold & italics***

## 4.2 Dividing line
You can use more than three minus signs in a row to create a separator line. At the same time, you need to empty a row above the separator line. As follows:

---

## 4.3 Delete line
Use two `~` before and after the text to be deleted, as follows:

~~2019-nCoV~~
# 5 Insert
## 5.1 Link
### 5.1.1 Inline
公众号文章链接[标题](https://mp.weixin.qq.com/s/s5IhxV2ooX3JN_X416nidA)
### 5.1.2 Reference
[younghz的Markdown库1][1]
[younghz的Markdown库2][2]

[1]:https://github.com/younghz/Markdown
[2]:https://github.com/younghz/Markdown

## 5.2 Footnote
Full stack engineer[^1] plays an important role in business development process.

# 6 Table
You can use colons to define the alignment of tables as follows:

| Center  |Left  | Right | Remarks |
| :--: | :-- | -------: | :--: |
| Shanxi |  133  | 133 |2|
| Hubei |  67790  | 52960 |2895|
| Italy |  17660  | 1439 |80539|

# 7 Code
## 7.1 Inline
If you need to refer to code in a line, just use backquotes to cause it, as follows:

Use the `printf()` function.
## 7.2 Block
Use three quotes before and after the block you want to highlight, and**The first line, followed by the back quotes, indicates the language of the code block**，as follows：

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

# 8 Latex
## 8.1 Available
### 8.1.1 Equation

$$
  \begin{equation}
  e=mc^2
  \end{equation}
$$

### 8.1.2 Fraction
$\frac {a+1}{b+2}$ 和 $x={a+1 \\over b+1}$

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
### 8.1.3 Chemical formula

$$
  \ce{Hg^2+ ->[I-] HgI2 ->[I-] [Hg^{II}I4]^2-}
$$

### 8.1.4 Block formula

$$
  H(D_2) = -\left(\frac{2}{4}\log_2 \frac{2}{4} + \frac{2}{4}\log_2 \frac{2}{4}\right) = 1
$$

$$ 
  \sum_{i=0}^n = \frac{(n^2+n)(2n+1)}{6}
$$

### 8.1.5 Inline formula
$ \sum_{i=0}^n $ 和 $ \frac{1}{2} $ 

### 8.1.6 Greek alphabet

For Greek letters，$ \alpha \beta,...,\omega $。

$\phi \varphi$ and $\ell$

### 8.1.7 Sub and sup

Separate use `^` and `_` ，for example：$x_i^{10}$ = ; ${x^y}^z$ = ; $x_{i^{10}}$ = 

Root number$\sqrt[4] {x_3}$

Letter top
- $\hat x$, $\widehat{xy}$
- $\bar x$, $\overline {xyz}$
- $\overrightarrow {xy}$, $\overleftrightarrow {xy}$
- $\dot x$

### 8.1.8 括号
圆括号和方括号 $(2+2)[4-4]$ = 
花括号需要用\{和\}表示，比如$\{x| x>0\}$ = 
遇到高度较高的分数，括号会变小，如 $(\frac{\sqrt x}{y^3})$ = ，可以使用`\left(…\right)`可以自动调整括号的行高，比如 $\left(\frac{\sqrt x}{y^3}\right)$ = 

### 8.1.9 求和、极限与积分
$\sum_1^n$ = ，$\int$= ，$\prod$ = 
$\bigcup$ = ，$\bigcap$ = ，$\iint$ = 

$$
\lim_{k\to\infty}k^{-1} = 0
$$

$$
\sum_{k=1}^{n}f(k)
$$

### 8.1.10 特殊函数
初等函数
$\log_a b$， $\ln b$， $\sin x$ ，$\max x$ 
### 8.1.11 特殊符号
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

### 8.1.12 纯文本
$$\{x\in s | \text{x is extra large}\}$$
单空格$a \ b$， 多空格$a \quad b$

## 8.2 有误

### 8.2.1 等式未断行:

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

### 10.1 HTML
<span style="display:block;text-align:left;color:rgb(255, 0, 54);">天猫红居左</span>
<span style="display:block;text-align:right;color:#ff6a00;">阿里橙居右</span>
<span style="display:block;text-align:center;color:#019fe8;">支付宝蓝居中</span>

### 10.2 注释(不被解析)
[tags]: <> (['node','js','java',])

[description]: # (This may be the most platform independent comment)


[^1]: Github.Websites for you and your projects.[EB/OL].https://pages.github.com .2017