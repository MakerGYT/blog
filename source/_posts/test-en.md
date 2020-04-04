---
title: Typography convention
date: 2020-02-16 20:03:32
tags:
  - test
  - markdown
  - webhook
description: Abstract is a concise abstract of the specification of an invention or utility model. The subject matter and substance of the invention or utility model should be described concisely. The important purpose of this paper is to facilitate people's literature retrieval and preliminary classification.
categories: test
mathjax: true
cover: https://670133.s90i.faiusr.com/4/102/AFwIABAEGAAgpOWk8gUosoebpgMwhAc4-wI!1000x1000.png?v=1584188956724&_tm=3
language: en
---
## 1 h1
Chapter title centered,number three in bold,used `##`.
### 1.1 h2
The chapter is a section, and the section title is in bold type,used `###`.
#### 1.1.1 h3
The section is under the section, and the section title is a small quad,used `####`.
##### 1.1.1.1 h4
###### 1.1.1.1.1 h5
Usually only use headlines one, two and three.
## 2 List
### 2.1 Unordered list
For the use of unordered lists, use spaces after the symbols`-`. As follows:
- Unordered list 1
- Unordered list 2
- Unordered list 3

If you want to control the level of the list, you need to use spaces before the symbols`-`. As follows:
- Unordered list 1
- Unordered list 2
  - Unordered list 2.1
  - Unordered list 2.2

Use branches and narratives for the content of the article, or the structure has a hierarchical relationship.
Line must end at the end of the enumeration.
### 2.2 Ordered list
For the use of an ordered list, enter the contents after adding spaces after the numbers and symbols, as follows:
1. Ordered list 1
2. Ordered list 2
3. Ordered list 3

The following headings in the section, or express a synchronous order relationship.
**If a new paragraph begins with the number and its content, a new line is required, and the end of the enumeration must be a new line.**
## 3 Quote
The format of the reference is to write after the symbol. As follows:
> Epidemic is order, prevention and control is responsibility.  ——leader

Used for large text quotes,**End of quote must wrap**
## 4 Font
### 4.1 Bold and italics
**This is bold**,*Italics are generally only used in English*,***This is bold & italics***.

If the correlation between information is higher, the distance between them should be closer and more like a visual unit; otherwise, the distance between them should be farther and more like multiple visual units. The basic purpose of intimacy is to achieve organization, so that users can see the page structure and information hierarchy at a glance.

As described by the Law of Continuity in the Gestalt School, in the process of perception, people tend to make the straight line of the subject of perception continue to be a straight line, and the curve continues to be a curve. In the interface design, the elements are aligned, which not only conforms to the user's cognitive characteristics, but also guides the visual flow, allowing the user to receive information more smoothly[^1].
### 4.2 Dividing line
You can use more than three minus signs in a row to create a separator line. At the same time, you need to empty a row above the separator line. As follows:

---

### 4.3 Delete line
Use two `~` before and after the text to be deleted, as follows:

~~2019-nCoV~~
## 5 Insert
### 5.1 Link
A tag to display the information of Douban books in hexo post/page.[npm](https://github.com/makergyt/hexo-tag-book-douban)

### 5.2 Footnote
To use before punctuation[^2],used for remarks or conclusions from the original text.**Annotations are automatically generated at the end, but should also be written at the end**.
## 6 Table
You can use colons to define the alignment of tables as follows:

| Center  |Left  | Right | Remarks |
| :--: | :-- | -------: | :--: |
| Shanxi |  133  | 133 |2|
| Hubei |  67790  | 52960 |2895|
| Italy |  17660  | 1439 |80539|

## 7 Code
### 7.1 Inline
If you need to refer to code in a line, just use backquotes to cause it, as follows:

Use the `printf()` function.
### 7.2 Block
Use three quotes before and after the block you want to highlight, and**The first line, followed by the back quotes, indicates the language of the code block**，as follows：

```java
//To write file location information
public class HelloWorld {
  public static void main(String[] args) {
    System.out.println("Hello,World!"); // comment
  }
}
```

diff:

```diff
+ New item
- Delete item
```

## 8 Latex
### 8.1 Available
#### 8.1.1 Equation

$$
  \begin{equation}
  e=mc^2
  \end{equation}
$$

#### 8.1.2 Fraction
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
#### 8.1.3 Chemical formula

$$
  \ce{Hg^2+ ->[I-] HgI2 ->[I-] [Hg^{II}I4]^2-}
$$

#### 8.1.4 Block formula

$$
  H(D_2) = -\left(\frac{2}{4}\log_2 \frac{2}{4} + \frac{2}{4}\log_2 \frac{2}{4}\right) = 1
$$

$$ 
  \sum_{i=0}^n = \frac{(n^2+n)(2n+1)}{6}
$$

#### 8.1.5 Inline formula
$ \sum_{i=0}^n $ 和 $ \frac{1}{2} $ 

#### 8.1.6 Greek alphabet

For Greek letters，$ \alpha \beta,...,\omega $。

$\phi \varphi$ and $\ell$

#### 8.1.7 Sub and sup

Separate use `^` and `_` ，for example：$x_i^{10}$ = ; ${x^y}^z$ = ; $x_{i^{10}}$ = 

Root number$\sqrt[4] {x_3}$

Letter top
- $\hat x$, $\widehat{xy}$
- $\bar x$, $\overline {xyz}$
- $\overrightarrow {xy}$, $\overleftrightarrow {xy}$
- $\dot x$

#### 8.1.8 Brackets
Parentheses and square brackets $(2+2)[4-4]$ = 
Curly braces need to be represented by \ {and \}，such as$\{x| x>0\}$ = 
When encountering higher scores, the brackets will become smaller, such as $(\frac{\sqrt x}{y^3})$ = ，`\left(…\right)`Can automatically adjust the line height of parentheses, such as $\left(\frac{\sqrt x}{y^3}\right)$ = 

#### 8.1.9 Sum, Limit, and Integral
$\sum_1^n$ = ，$\int$= ，$\prod$ = 
$\bigcup$ = ，$\bigcap$ = ，$\iint$ = 

$$
\lim_{k\to\infty}k^{-1} = 0
$$

$$
\sum_{k=1}^{n}f(k)
$$

#### 8.1.10 Function
Elementary function
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

#### 8.1.12 Plain Text
$$\{x\in s | \text{x is extra large}\}$$
Single space$a \ b$， double space$a \quad b$

### 8.2 May be wrong
Wrap four backslashes
#### 8.2.1 Unbroken equation:

$$
  \begin{equation} \label{eq2}
  \begin{aligned}
  a &= b + c  \\\\
    &= d + e + f + g \\\\
    &= h + i \\\\
  \end{aligned}
  \end{equation}
$$

#### 8.2.2 Equation does not break lines and does not support multi-line numbering: 

$$
  \begin{align}
  a &= b + c \label{eq3} \\\\
  x &= yz \\\\
  l &= m - n \\\\
  \end{align}
$$

#### 8.2.3 Multi-column unbroken rows are not numbered:

$$
  \begin{align}
  -4 + 5x &= 2+y \\\\
  w+2 &= -1+w \\\\
  ab &= cb \\\\
  \end{align} 
$$

#### 8.2.4 Matrix is not broken：

$$
  \begin{pmatrix}
  1 & a_1 & a_1^2 & \cdots & a_1^n \\\\
  1 & a_2 & a_2^2 & \cdots & a_2^n \\\\
  \vdots & \vdots & \vdots & \ddots & \vdots \\\\
  1 & a_m & a_m^2 & \cdots & a_m^n \\\\
  \end{pmatrix}
$$

#### 8.2.5 Branching equations do not wrap
$$
f(n)=
\begin{cases}
n/2,& \text{if $n$ is even}\\\\
3n+1,& \text{if $n$ is odd}
\end{cases}
$$

#### 8.2.6 Tabular array
$$
\begin{array}{c|lcr}
n & \text{Left} & \text{Center} & \text{Right} \\\\
\hline
1 & 0.24 & 1 & 125 \\\\
2 & -1 & 189 & -8 \\\\
3 & -20 & 2000 & 1+10i
\end{array}
$$

### 9 Media
#### 9.1  Images
![Caption 5-1 Write picture description here](https://1.s91i.faiusr.com/4/AFsIABAEGAAgztrP8QUohNjw0AYwhAc4-wI!800x800.png?v=1580461392155)
Supports jpg, png, gif, svg and other image formats, examples of svg files are as follows：
![Caption 5-2 i_am_svg_20191024083453](https://my-wechat.mdnice.com/mdnice/i_am_svg_20191024083453.svg)

### 10 Special
**Generally not used unless absolutely necessary**
#### 10.1 HTML
<span style="display:block;text-align:left;color:rgb(255, 0, 54);">Tmall Red Home Left</span>
<span style="display:block;text-align:right;color:#ff6a00;">Ali Orange Right</span>
<span style="display:block;text-align:center;color:#019fe8;">Alipay Centered</span>

### 10.2 Comments (not parsed)
[tags]: <> (['node','js','java',])

[description]: # (This may be the most platform independent comment)

[^1]: Ant design.设计模式.[EB/OL].https://ant.design/docs/spec/introduce-cn .2020
[^2]: Github.Mastering Markdown.[EB/OL].https://guides.github.com/features/mastering-markdown/ .2014