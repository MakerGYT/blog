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

[1]:https:://github.com/younghz/Markdown
[2]:https:://github.com/younghz/Markdown

![图5-1 i_am_svg_20191024083453.svg](https://my-wechat.mdnice.com/mdnice/i_am_svg_20191024083453.svg)
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

## 8.2 有误
### 8.2.1 等式未断行:

$$
  \begin{equation} \label{eq2}
  \begin{aligned}
  a &= b + c \\
    &= d + e + f + g \\
    &= h + i
  \end{aligned}
  \end{equation}
$$

### 8.2.2 方程不显示: 

$$
  \begin{align}
  a &= b + c \label{eq3} \\
  x &= yz \label{eq4}\\
  l &= m - n \label{eq5}
  \end{align}
$$

### 8.2.3 多列式未断行不编号:

$$
  \begin{align}
  -4 + 5x &= 2+y \nonumber  \\
  w+2 &= -1+w \\
  ab &= cb
  \end{align}
$$

### 8.2.4 矩阵未断行：

$$
  \begin{pmatrix}
  1 & a_1 & a_1^2 & \cdots & a_1^n \\
  1 & a_2 & a_2^2 & \cdots & a_2^n \\
  \vdots & \vdots & \vdots & \ddots & \vdots \\
  1 & a_m & a_m^2 & \cdots & a_m^n \\
  \end{pmatrix}
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

# 11 限定hexo-next可用
## 11.1 Centered Quote

{% cq %}任何困难都难不倒英雄的中国人民{% endcq %}
## 11.2 note

{% note default %}
### 11.2.1 Default Header
Welcome to [Hexo!](https://hexo.io)
{% endnote %}

{% note primary %}
### 11.2.2 Primary Header
**Welcome** to [Hexo!](https://hexo.io)
{% endnote %}

{% note info %}
### 11.2.3 Info Header
**Welcome** to [Hexo!](https://hexo.io)
{% endnote %}

{% note warning %}
### 11.2.4 Warning Header
**Welcome** to [Hexo!](https://hexo.io)
{% endnote %}

{% note danger %}
### 11.2.5 Danger Header
**Welcome** to [Hexo!](https://hexo.io)
{% endnote %}

{% note info no-icon %}
### 11.2.6 No icon note
Note **without** icon: `note info no-icon`
{% endnote %}

{% note success %}
### 11.2.7 Success Header
**Welcome** to [Hexo!](https://hexo.io)
{% endnote %}

## 11.3 Tabs

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

## 11.4 PDF

{% pdf https://cdn.blog.makergyt.com/doc/Markdown-written_by_typora.pdf %}
## 11.5 mermaid

{% mermaid graph TD %}
A[Christmas] -->|Get money| B(Go shopping)
B --> C{Let me thinksssss<br>ssssssssssssssssssssss<br>sssssssssssssssssssssssssss}
C -->|One| D[Laptop]
C -->|Two| E[iPhone]
C -->|Three| F[Car]
{% endmermaid %}
{% mermaid graph LR %}
47(SAM.CommonFA.FMESummary)-->48(SAM.CommonFA.CommonFAFinanceBudget)
37(SAM.CommonFA.BudgetSubserviceLineVolume)-->48(SAM.CommonFA.CommonFAFinanceBudget)
35(SAM.CommonFA.PopulationFME)-->47(SAM.CommonFA.FMESummary)
41(SAM.CommonFA.MetricCost)-->47(SAM.CommonFA.FMESummary)
44(SAM.CommonFA.MetricOutliers)-->47(SAM.CommonFA.FMESummary)
46(SAM.CommonFA.MetricOpportunity)-->47(SAM.CommonFA.FMESummary)
40(SAM.CommonFA.OPVisits)-->47(SAM.CommonFA.FMESummary)
38(SAM.CommonFA.CommonFAFinanceRefund)-->47(SAM.CommonFA.FMESummary)
43(SAM.CommonFA.CommonFAFinancePicuDays)-->47(SAM.CommonFA.FMESummary)
42(SAM.CommonFA.CommonFAFinanceNurseryDays)-->47(SAM.CommonFA.FMESummary)
45(SAM.CommonFA.MetricPreOpportunity)-->46(SAM.CommonFA.MetricOpportunity)
35(SAM.CommonFA.PopulationFME)-->45(SAM.CommonFA.MetricPreOpportunity)
41(SAM.CommonFA.MetricCost)-->45(SAM.CommonFA.MetricPreOpportunity)
41(SAM.CommonFA.MetricCost)-->44(SAM.CommonFA.MetricOutliers)
39(SAM.CommonFA.ChargeDetails)-->43(SAM.CommonFA.CommonFAFinancePicuDays)
39(SAM.CommonFA.ChargeDetails)-->42(SAM.CommonFA.CommonFAFinanceNurseryDays)
39(SAM.CommonFA.ChargeDetails)-->41(SAM.CommonFA.MetricCost)
39(SAM.CommonFA.ChargeDetails)-->40(SAM.CommonFA.OPVisits)
35(SAM.CommonFA.PopulationFME)-->39(SAM.CommonFA.ChargeDetails)
36(SAM.CommonFA.PremetricCost)-->39(SAM.CommonFA.ChargeDetails)
{% endmermaid %}
{% mermaid graph TD %}
9e122290_1ec3_e711_8c5a_005056ad0002("fa:fa-creative-commons My System | Test Environment")
82072290_1ec3_e711_8c5a_005056ad0002("fa:fa-cogs Shared Business Logic Server:Service 1")
db052290_1ec3_e711_8c5a_005056ad0002("fa:fa-cogs Shared Business Logic Server:Service 2")
4e112290_1ec3_e711_8c5a_005056ad0002("fa:fa-cogs Shared Report Server:Service 1")
30122290_1ec3_e711_8c5a_005056ad0002("fa:fa-cogs Shared Report Server:Service 2")
5e112290_1ec3_e711_8c5a_005056ad0002("fa:fa-cogs Dedicated Test Business Logic Server:Service 1")
c1112290_1ec3_e711_8c5a_005056ad0002("fa:fa-cogs Dedicated Test Business Logic Server:Service 2")
b7042290_1ec3_e711_8c5a_005056ad0002("fa:fa-circle [DBServer\SharedDbInstance].[SupportDb]")
8f102290_1ec3_e711_8c5a_005056ad0002("fa:fa-circle [DBServer\SharedDbInstance].[DevelopmentDb]")
0e102290_1ec3_e711_8c5a_005056ad0002("fa:fa-circle [DBServer\SharedDbInstance].[TestDb]")
07132290_1ec3_e711_8c5a_005056ad0002("fa:fa-circle [DBServer\SharedDbInstance].[SharedReportingDb]")
c7072290_1ec3_e711_8c5a_005056ad0002("fa:fa-server Shared Business Logic Server")
ca122290_1ec3_e711_8c5a_005056ad0002("fa:fa-server Shared Report Server")
68102290_1ec3_e711_8c5a_005056ad0002("fa:fa-server Dedicated Test Business Logic Server")
f4112290_1ec3_e711_8c5a_005056ad0002("fa:fa-database [DBServer\SharedDbInstance]")
d6072290_1ec3_e711_8c5a_005056ad0002("fa:fa-server DBServer")
71082290_1ec3_e711_8c5a_005056ad0002("fa:fa-cogs DBServer\:MSSQLSERVER")
c0102290_1ec3_e711_8c5a_005056ad0002("fa:fa-cogs DBServer\:SQLAgent")
9a072290_1ec3_e711_8c5a_005056ad0002("fa:fa-cogs DBServer\:SQLBrowser")
1d0a2290_1ec3_e711_8c5a_005056ad0002("fa:fa-server VmHost1")
200a2290_1ec3_e711_8c5a_005056ad0002("fa:fa-server VmHost2")
1c0a2290_1ec3_e711_8c5a_005056ad0002("fa:fa-server VmHost3")
9e122290_1ec3_e711_8c5a_005056ad0002-->82072290_1ec3_e711_8c5a_005056ad0002
9e122290_1ec3_e711_8c5a_005056ad0002-->db052290_1ec3_e711_8c5a_005056ad0002
9e122290_1ec3_e711_8c5a_005056ad0002-->4e112290_1ec3_e711_8c5a_005056ad0002
9e122290_1ec3_e711_8c5a_005056ad0002-->30122290_1ec3_e711_8c5a_005056ad0002
9e122290_1ec3_e711_8c5a_005056ad0002-->5e112290_1ec3_e711_8c5a_005056ad0002
9e122290_1ec3_e711_8c5a_005056ad0002-->c1112290_1ec3_e711_8c5a_005056ad0002
82072290_1ec3_e711_8c5a_005056ad0002-->b7042290_1ec3_e711_8c5a_005056ad0002
82072290_1ec3_e711_8c5a_005056ad0002-->8f102290_1ec3_e711_8c5a_005056ad0002
82072290_1ec3_e711_8c5a_005056ad0002-->0e102290_1ec3_e711_8c5a_005056ad0002
82072290_1ec3_e711_8c5a_005056ad0002-->c7072290_1ec3_e711_8c5a_005056ad0002
db052290_1ec3_e711_8c5a_005056ad0002-->c7072290_1ec3_e711_8c5a_005056ad0002
db052290_1ec3_e711_8c5a_005056ad0002-->82072290_1ec3_e711_8c5a_005056ad0002
4e112290_1ec3_e711_8c5a_005056ad0002-->b7042290_1ec3_e711_8c5a_005056ad0002
4e112290_1ec3_e711_8c5a_005056ad0002-->8f102290_1ec3_e711_8c5a_005056ad0002
4e112290_1ec3_e711_8c5a_005056ad0002-->0e102290_1ec3_e711_8c5a_005056ad0002
4e112290_1ec3_e711_8c5a_005056ad0002-->07132290_1ec3_e711_8c5a_005056ad0002
4e112290_1ec3_e711_8c5a_005056ad0002-->ca122290_1ec3_e711_8c5a_005056ad0002
30122290_1ec3_e711_8c5a_005056ad0002-->ca122290_1ec3_e711_8c5a_005056ad0002
30122290_1ec3_e711_8c5a_005056ad0002-->4e112290_1ec3_e711_8c5a_005056ad0002
5e112290_1ec3_e711_8c5a_005056ad0002-->8f102290_1ec3_e711_8c5a_005056ad0002
5e112290_1ec3_e711_8c5a_005056ad0002-->68102290_1ec3_e711_8c5a_005056ad0002
c1112290_1ec3_e711_8c5a_005056ad0002-->68102290_1ec3_e711_8c5a_005056ad0002
c1112290_1ec3_e711_8c5a_005056ad0002-->5e112290_1ec3_e711_8c5a_005056ad0002
b7042290_1ec3_e711_8c5a_005056ad0002-->f4112290_1ec3_e711_8c5a_005056ad0002
8f102290_1ec3_e711_8c5a_005056ad0002-->f4112290_1ec3_e711_8c5a_005056ad0002
0e102290_1ec3_e711_8c5a_005056ad0002-->f4112290_1ec3_e711_8c5a_005056ad0002
07132290_1ec3_e711_8c5a_005056ad0002-->f4112290_1ec3_e711_8c5a_005056ad0002
c7072290_1ec3_e711_8c5a_005056ad0002-->1d0a2290_1ec3_e711_8c5a_005056ad0002
ca122290_1ec3_e711_8c5a_005056ad0002-->200a2290_1ec3_e711_8c5a_005056ad0002
68102290_1ec3_e711_8c5a_005056ad0002-->1c0a2290_1ec3_e711_8c5a_005056ad0002
f4112290_1ec3_e711_8c5a_005056ad0002-->d6072290_1ec3_e711_8c5a_005056ad0002
f4112290_1ec3_e711_8c5a_005056ad0002-->71082290_1ec3_e711_8c5a_005056ad0002
f4112290_1ec3_e711_8c5a_005056ad0002-->c0102290_1ec3_e711_8c5a_005056ad0002
f4112290_1ec3_e711_8c5a_005056ad0002-->9a072290_1ec3_e711_8c5a_005056ad0002
d6072290_1ec3_e711_8c5a_005056ad0002-->1c0a2290_1ec3_e711_8c5a_005056ad0002
71082290_1ec3_e711_8c5a_005056ad0002-->d6072290_1ec3_e711_8c5a_005056ad0002
c0102290_1ec3_e711_8c5a_005056ad0002-->d6072290_1ec3_e711_8c5a_005056ad0002
c0102290_1ec3_e711_8c5a_005056ad0002-->71082290_1ec3_e711_8c5a_005056ad0002
9a072290_1ec3_e711_8c5a_005056ad0002-->d6072290_1ec3_e711_8c5a_005056ad0002
9a072290_1ec3_e711_8c5a_005056ad0002-->71082290_1ec3_e711_8c5a_005056ad0002
{% endmermaid %}
{% mermaid sequenceDiagram %}
participant Alice
participant Bob
participant John as John<br>Second Line
Alice ->> Bob: Hello Bob, how are you?
Bob-->>John: How about you John?
Bob--x Alice: I am good thanks!
Bob-x John: I am good thanks!
Note right of John: Bob thinks a long<br>long time, so long<br>that the text does<br>not fit on a row.
Bob-->Alice: Checking with John...
alt either this
Alice->>John: Yes
else or this
Alice->>John: No
else or this will happen
Alice->John: Maybe
end
par this happens in parallel
Alice -->> Bob: Parallel message 1
and
Alice -->> John: Parallel message 2
end
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

## 11.6 Video

{% video https://static.smartisanos.cn/common/video/production/ocean/os-1-1710.mp4 %}

## 11.7 Group picture

{% grouppicture 2-3 %}
  ![图10-1 两行三列第一张](https://d33wubrfki0l68.cloudfront.net/e2ecd9e90ca2a56af8d7be434b7fdc39cbd454c9/da9b7/images/docs/github.png)
  ![图10-2 两行三列第二张](https://d33wubrfki0l68.cloudfront.net/e2ecd9e90ca2a56af8d7be434b7fdc39cbd454c9/da9b7/images/docs/github.png)
  ![图10-3 两行三列第三张](https://d33wubrfki0l68.cloudfront.net/e2ecd9e90ca2a56af8d7be434b7fdc39cbd454c9/da9b7/images/docs/github.png)
  ![图10-4 两行三列第四张](https://d33wubrfki0l68.cloudfront.net/e2ecd9e90ca2a56af8d7be434b7fdc39cbd454c9/da9b7/images/docs/github.png)
  ![图10-5 两行三列第五张](https://d33wubrfki0l68.cloudfront.net/e2ecd9e90ca2a56af8d7be434b7fdc39cbd454c9/da9b7/images/docs/github.png)
  ![图10-6 两行三列第六张](https://d33wubrfki0l68.cloudfront.net/e2ecd9e90ca2a56af8d7be434b7fdc39cbd454c9/da9b7/images/docs/github.png)
{% endgrouppicture %}

[^1]:是指掌握多种技能，并能利用多种技能独立完成产品的人