---
title: 微信小程序资料库需求的实现
date: 2019-04-13 17:14:48
tags:
- wechat

categories: record
description: 仅作记录
---

# 1 云存储
只提供了上传、下载、删除、临时链接简单的针对性接口，如果实现文件管理，还需要借助云数据库。  

# 2 腾讯云COS对象存储
## 2.1 基本过程
### 2.1.1 初始化

前端（小程序端）通过wx.reauest向后端(php)发起请求计算签名，后端(php)携带SecretId和SecretKey向官方发起请求获取临时密钥计算出签名返回给前端（小程序端）。小程序端初始化一个cos实例，可以通过getBucket接口获取bucket内的资源信息。
### 2.1.2 接口调用
#### 2.1.2.1 调用一次getBucket，获取当前全部object信息（Key,LastModified）
然而实际并不是这样，接口对单次请求返回的最大条目数量有限制（1000），意味着如果bucket内对象上升到一定数量，需要多次调用此接口，那么就需要判断出何时结束调用，可以通过计数如果本次返回数目小于1000，即可结束。
这样做后，需要手动对返回对象列表进行处理，因为既包含了所有文件的路径信息，也包含了所有文件夹的信息，需求是按照树型的文件结构展示，就需要将这些条目信息按照多维的数组存储（列表标准化），目前并没有设计出高效的算法。
##### 优点
- 减少网络请求
- 每个对象具有唯一的标志（Key）以及时间信息

##### 缺点
- 对象数目上升时获取到大量信息（相对当前属于多余信息），不能实现按需加载
- 数据可能不实时同步

#### 2.1.2.2 按需调用getBucket(通过前缀匹配prefix和定界符delimiter)
这样做会使请求结果越来越趋近于实际需求，而后一次请求是前一次请求的子集，请求过程中需要记录当前的访问路径信息，以便在下次请求时作为前缀匹配。需要获取到当前对象列表后进行剔除下一级及之后的条目（列表标准化）。最终通过getObjectUrl获取对象信息，目前的API只能获取到文件URL,且此URL由于自带临时签名不能作为唯一标志，除非在上一级getBucket信息时保存下来。
##### 优点
- 实现逻辑简单
- 具备实时性

##### 缺点
- 多次网络请求，依赖网络环境
- 请求结果重叠，请求后的数据没有及时利用

为了加强体验，在获取到对象列表后，根据条目的特征匹配对应的图标。
## 2.2 封装组件
### 2.2.1 树型组件
#### 2.2.1.1 过程
- 参照windows文件管理器，分为顶部地址栏和下方目录栏。组件对外的属性为入口地址，便于实现从特定页到对应资料页。
- 对属性添加监听器ininView，实现调用组件时即进行首次请求接口事件。
- 点击栏目后，触发请求接口事件，分别更新地址和目录信息。
- 由于地址栏目需要支持路径选择，则其字段为数组类型，点击后触发新的请求接口事件。
- 为了防止快点击和重复点击，添加了事件锁。
- 顶部地址栏由于无法预计的补充长度，换用scrollView，并设置scroll-into-view为当前地址的最后一项

#### 2.2.1.2 样式问题
微信对自定义组件有一个特殊要求
{% note warning %}
注意：在组件wxss中不应使用ID选择器、属性选择器和标签名选择器。
{% endnote %}
这样的要求当然是基于隔离样式、使组件更独立的考虑。于是不能再使用原有页面样式，开发中断，转去调样式。
### 2.2.2 图标组件
#### 2.2.2.1 图标来源
使用[阿里巴巴矢量图标库](https://www.iconfont.cn),图标使用font class方式引入。
1. 直接挑选合适的图标svg（也可自行设计svg）下载，导入到图标项目内；
2. 构建完成后下载，使用其中的iconfont.css放入组件的样式文件中

#### 2.2.2.2 图标匹配
在对列表标准化时直接判断当前类型并写入Type值。
判断当前类型由于目前图标库覆盖面小，大致是模糊匹配，后续图标库完整后将图标与文件后缀一致化直接匹配。

#### 2.2.2.3 图标色彩问题
由于使用font class方式，图标默认为黑色，需要按需手动在组件引用处写入color属性内，也可直接固定补充在组件样式内。
### 2.2.3 组件通信
#### 2.2.3.1 组件内数据传入页面
组件获取到文件地址信息后，需要传入页面以进行后续操作（wx.openDocument）。
在自定义组件的内部添加事件，在事件函数内使用triggerEvent，将需要传出的数据与页面事件bind:event绑定，在页面调用组件时绑定该组件事件，页面事件内即可通过组件事件的触发获取到数据。
### 2.2.4 文件详情页
需求：
- 上传者
- 修改时间
- 下载量
- 大小
- 评价
- 下载 :小文件支持下载预览，大文件返回临时外部下载链接
- 预览打开

## 2.3 总结
- cos不适合作为当前资料库需求的解决方案，目前github上关于高校课程的资料分享关注度持续上升，正在考虑此方式。
- 微信小程序原生开发的痛点在于，官方在设计时并没有通盘考虑，而总感觉是打补丁，让本身就需要并行关注多个文件的开发增添了很多考虑。且文档缺乏系统整理，内容详略欠妥，概念缺乏区分，目录内容重复不易查阅，文档系统加载体验也较差。于是便随之衍生多种多样的库，多种多样的商业模式和生态链上下游，当初微信公众号便是如此，似乎有意不去做完善功能，有意在拓展更多业务。孰优孰劣？

# 3 github
此方式API丰富(官网文档加载龟速)，操作简便且多样化。由于公开，可能面临莫须有的教学资料版权和使用问题。
对接口调用有限制
{% note warning %}
For unauthenticated requests, the rate limit allows for up to 60 requests per hour. Unauthenticated requests are associated with the originating IP address, and not the user making requests.
{% endnote %}
而微信对页面栈也有限制
{% note warning %} 
The current page path can only have a maximum of 10 layers.
{% endnote %}
这样的话就不便于采用每次根据目录访问接口并navigateTo，解决方案是获取github授权，在小程序端数据直接覆盖更新，设置路径栏，方便自由选择。
## 3.0 文档加载过慢
既然
{% note info no-icon%}
We have recently completed a milestone where we were able to drop jQuery as a dependency of the frontend code for GitHub.com. This marks the end of a gradual, years-long transition of increasingly decoupling from jQuery until we were able to completely remove the library. In this post, we will explain a bit of history of how we started depending on jQuery in the first place, how we realized when it was no longer needed, and point out that—instead of replacing it with another library or framework—we were able to achieve everything that we needed using standard browser APIs.
{% endnote%}
那么
![](https://cdn.blog.makergyt.com/images/record-fetch_github-network.png)
如何解释，这也正是迟迟无法加载的原因之一。
## 3.1 授权
github大致有三种授权方式，
- Basic authoriazition
直接授权，传入base64编码的账号和密码(登录成功后缓存到本地)参数，下次请求API在header中携带此参数
- token
由用户自发生成，同样缓存到本地，下次请求携带
- oauth2.0
由于小程序处于较为封闭的环境，而个人账号又不支持webView，因此无法引导用户授权

授权完成后，每小时请求API的次数限制由60升级为5000
## 3.2 限制
在所有功能开发完成后，突然发现无法将github的域名加到小程序后台(调试时跳过了域名检查)
{% note warning %}
域名必须经过 ICP 备案；
{% endnote %}
那么，如果将api接口做转发，这种方式将进一步拉低访问速度，当然可以做缓存，这必然又导致实时性的问题。这样看来，采用本方案优势显得并不大，如果选用国内的码云(coding没有开放接口)，将进一步缩小影响力与使用受众范围。如果用云函数去请求api再下发数据，
*未完待续*

# Reference
<small>
[1] 微信公众平台.小程序开发-云开发-存储API[EB/OL].https://dwz.cn/LAhpCnIf .2019
[2] 腾讯云.对象存储接口文档[EB/OL].https://cloud.tencent.com/document/product/436/12260 .2019
[3] 前端[色色].微信小程序——自定义图标组件[EB/OL].https://www.cnblogs.com/sese/p/9765344.html .2018
[4] Engineering.Removing jQuery from GitHub.com frontend[EB/OL].https://github.blog/2018-09-06-removing-jquery-from-github-frontend/ .2018
</small>