---
title: 易班API的使用
date: 2017-06-16 04:14:42
tags:
---

服务商提供给第三方网站的API使用原理基本相似，使用说明都可以在相应开发平台查看wiki文档。下面以<a href="https://open.yiban.cn/">易班开放平台</a>为例。

鉴于易班API使用目前最主要的用户身份验证和授权方式——oauth2.0，建议先了解下它的授权机制：<a href="http://www.cnblogs.com/neutra/archive/2012/07/26/2609300.html">http://www.cnblogs.com/neutra/archive/2012/07/26/2609300.html</a>

当然，易班开放平台也给出了授权概述：<a href="https://open.yiban.cn/wiki/index.php?page=%E6%8E%88%E6%9D%83%E6%9C%BA%E5%88%B6%E8%AF%B4%E6%98%8E">https://open.yiban.cn/wiki/index.php?page=%E6%8E%88%E6%9D%83%E6%9C%BA%E5%88%B6%E8%AF%B4%E6%98%8E</a>

<!-- more -->
更多深入了解可以访问官网：<a href="https://oauth.net/2/">https://oauth.net/2/</a>

<hr />

我将以网站接入SDK为例，javaSDK的使用可以参考<a href="http://blog.csdn.net/u010513756/article/details/50535657">http://blog.csdn.net/u010513756/article/details/50535657</a>（这应该是你能百度到的唯一一份资料）

.netSDK的使用参考<a href="https://github.com/eightHundreds/YbSDK">https://github.com/eightHundreds/YbSDK</a>（资料不多，不过是矿大学生开发的，应该已经意识到差距了吧）

下面是phpSDK的（这个琢磨了些日子，容易上手）

1.php环境

php需要开启CURL，这是文档要求，如果没有启用这个扩展，会报错！

当然也有其他的要求，不过j后两个一般来说应该都会满足的

<img class="size-medium wp-image-122 alignnone" src="http://gaoyuting.org/wp-content/uploads/2017/06/Capture-300x95.jpg" alt="" width="300" height="95" />。

那么如果不支持curl扩展该怎么办呢？当然，你可以参照网上那堆资料<a href="http://blog.163.com/ymboy@126/blog/static/2871108420108253201587/">http://blog.163.com/ymboy@126/blog/static/2871108420108253201587/</a>，不过我的经验是，可能是机子的特色，无论是改php.ini还是copy那些.dll文件到system32，亲测无效！那么简单粗暴的方式是重新配置升级php服务器（也别太高了，5.6就行），然后就OK了。

2.注册开放平台账号

<strong>易班</strong>：可以直接申请<a href="https://open.yiban.cn/">https://open.yiban.cn/</a>（也不费事）。

申请后就获得了<a href="https://o.yiban.cn/debug/apitest">测试权限</a>（就是可以体验接口是个啥的权限），至于要上线的网站，肯定会用到一些实名认证信息，就需要跟管理员申请更多权限<a href="https://open.yiban.cn/wiki/index.php?page=%E6%9D%83%E9%99%90%E7%94%B3%E8%AF%B7%E6%B5%81%E7%A8%8B">https://open.yiban.cn/wiki/index.php?page=%E6%9D%83%E9%99%90%E7%94%B3%E8%AF%B7%E6%B5%81%E7%A8%8B</a>

<strong>QQ</strong>：文档在<a href="http://wiki.connect.qq.com/">http://wiki.connect.qq.com/</a>

首先个人开发者需要完成认证：<a href="https://connect.qq.com/">https://connect.qq.com/</a>，用QQ登录后<img class="alignnone size-medium wp-image-123" src="http://gaoyuting.org/wp-content/uploads/2017/06/2e-300x169.jpg" alt="" width="300" height="169" /><img class="alignnone size-medium wp-image-124" src="http://gaoyuting.org/wp-content/uploads/2017/06/5-300x170.jpg" alt="" width="300" height="170" />

然后就耐心等待吧

<strong>微信</strong>：<a href="https://open.weixin.qq.com">https://open.weixin.qq.com</a>当然你也可以申请，不过

<img class="alignnone size-medium wp-image-125" src="http://gaoyuting.org/wp-content/uploads/2017/06/7-300x123.jpg" alt="" width="300" height="123" />

（看你情况吧）

其他的百度、微博之类的找相应开发者平台/开放平台。

3.下载SDK

<a href="https://open.yiban.cn/wiki/download/YBApi_sdk_php.zip">易班phpSDK</a>

4.认真阅读wiki后找一些demo下载

易班php：SDK里面有个demo文件夹

或者github上也有几个：<a href="https://github.com/search?utf8=%E2%9C%93&amp;q=yibanSDK&amp;type=">https://github.com/search?utf8=%E2%9C%93&amp;q=yibanSDK&amp;type=</a>

还有这个： 链接：http://pan.baidu.com/s/1o7RcYwi 密码：5who （玉林师范学院）

先读demo，也不难。先写到这，吃个饭。


<!--more-->

补充，我依照原理重写了易班PHP SDK，主要用于初学者学习，放到生产环境还得修一修
[https://github.com/dxstudio/dx/blob/master/extend/ThinkSDK/Yiban.php][1]


  [1]: https://github.com/dxstudio/dx/blob/master/extend/ThinkSDK/Yiban.php
  
  *本文仅作为过程性记录，不具有一般适用性，本文采用https://makergyt.com/md 构建*

