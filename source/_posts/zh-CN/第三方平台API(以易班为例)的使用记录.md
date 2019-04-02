---
title: 第三方平台API(以易班为例)的使用记录
date: 2017-06-16 04:14:42
tags: 

categories: record
---
# 1. 前言
服务商提供给第三方网站的API使用原理基本相似，使用说明都可以在相应开发平台查看wiki文档。以[易班开放平台](https://open.yiban.cn)为例:

鉴于易班API使用目前最主要的用户身份验证和授权方式——[oauth2.0](https://oauth.net/2/)，先了解下它的[授权机制](http://www.cnblogs.com/neutra/archive/2012/07/26/2609300.html)

当然，易班开放平台也给出了[授权概述](https://open.yiban.cn/wiki/index.php?page=%E6%8E%88%E6%9D%83%E6%9C%BA%E5%88%B6%E8%AF%B4%E6%98%8E)

<!-- more -->
# 2. 开始

将以网站接入SDK为例，javaSDK的使用可以[参考](http://blog.csdn.net/u010513756/article/details/50535657)（这应该是目前能百度到的唯一的文章）

.netSDK的使用[参考](https://github.com/eightHundreds/YbSDK),资料不多，不过是矿大学生开发的。

下面是phpSDK的（这个琢磨了些日子，容易上手）

## 2.1.php环境

{% note warning %}
php需要开启CURL，这是文档要求，如果没有启用这个扩展，会报错！
{% endnote %}

当然也有其他的要求，不过后两个一般来说应该都会满足的

那么如果不支持curl扩展该怎么办呢？当然，你可以参照网上[资料](http://blog.163.com/ymboy@126/blog/static/2871108420108253201587/)。不过经过测试，无论是改php.ini还是copy那些.dll文件到system32，均无效！那么简单粗暴的方式是重新配置升级php服务器（5.6就行），然后就OK了。

## 2.2 注册开放平台账号

[易班开放平台](https://open.yiban.cn/)：可以直接申请（也不费事）。

申请后就获得了[测试权限](https://o.yiban.cn/debug/apitest)（就是可以体验接口作用的权限），至于要上线的网站，肯定会用到一些实名认证信息，就需要跟管理员[申请更多权限](https://open.yiban.cn/wiki/index.php?page=%E6%9D%83%E9%99%90%E7%94%B3%E8%AF%B7%E6%B5%81%E7%A8%8B)

其他：
[QQ互联平台](http://wiki.connect.qq.com/)：首先个人开发者需要完成[认证](https://connect.qq.com/),用QQ登录后创建网站应用，然后就耐心等待吧(此平台体验并不完善，可能已经逐步放弃维护)

[微信开放平台](https://open.weixin.qq.com)：当然也可以申请，不过是需要认证费用以及企业信息的。

其他还有类似百度、微博开发者平台/开放平台。

## 2.3 下载SDK

[易班phpSDK](https://open.yiban.cn/wiki/download/YBApi_sdk_php.zip)

## 2.4 认真阅读wiki后找一些demo下载

- 易班php：SDK里面有个demo文件夹
- github：[yibanSDK](https://github.com/search?utf8=%E2%9C%93&amp;q=yibanSDK&amp;type=)
- 玉林师范学院： 链接：http://pan.baidu.com/s/1o7RcYwi 密码：5who 

## 依照原理重写了易班PHP SDK
主要用于实现过程，不可用于生产环境
[https://github.com/MakerGYT/dx/blob/master/extend/ThinkSDK/Yiban.php](https://github.com/MakerGYT/dx/blob/master/extend/ThinkSDK/Yiban.php)