---
title: 建立个人网站
date: 2017-09-21 04:04:51
tags:
	- github
	- centos
categories: config
description: Preliminary learning to establish personal website
---
{% note info %}
本文概念性内容可能表述不严谨，但不必吹毛求疵，主要以实际操作为主，一些下载资料已附带链接。
{% endnote %}
# 1 前言
首先，我们为什么要用到服务器。刚开始入门web的同学可能一直沉浸于使用自己的电脑本地调试出各种奇技淫巧而兴奋不已，然而当你想向他人炫耀一番时，你的方式是什么？打个包发过去，她/他可能还在用IE6，然后你的花哨的页面就没有然后了，当然这也得基于知道你网页入口在哪里。这时，服务器会派上用场，它就相当于一个寄存在遥远天边的电脑，与你桌上那台不同的是，每个人只要可以上网就能访问到里面的内容（当然深入了解还需要端口等知识）。那么，怎么访问呢？我们知道，每个网络上的机器都有一个IP地址，就像这样，127.0.0.1（这是电脑本地的IP），我们可以通过浏览器键入IP访问到它的内容。如果它那台主机配置了域名，你现在暂且可以这样理解，域名与IP是一一对应的关系，域名只是为了便于你记忆，就像baidu.com,大多数人肯定不会记住它的IP。不过作为我们这类人来说，IP就可以了，我相信你是可以记住的。域名的话，毕竟考虑国情，你还得经过备案，上传各种资料以及自拍，在你不准备正式对外发布使用之前是没什么必要的。

还有一种可以实现访问的方式是github,io，这是github推出 的一项免费服务，可以使用例如[https://makergyt.github.io](https://makergyt.github.io)的域名访问到你的内容，网页可以通过它的桌面软件上传，屏蔽了服务器端的那些操作，比较简单。当然这是对于前端同学来讲适用。下面将分别开始这两种方式的实际操作。

# 2 开工
## 2.1 服务器
### 2.1.1 准备
1. 先拥有，确切的说是租用一台云服务器(或者虚拟主机)，网络上有很多服务商，五花八门，国内的有腾讯云，百度云(不是百度网盘！)，国外的有godady，区别是国外的不需要备案，但是速度可能会慢，国内的相反。这里推荐[阿里云](https://www.aliyun.com/minisite/goods?userCode=89lfnf3q)（点击获取代金券），还有[学生优惠](https://promotion.aliyun.com/ntms/act/campus2018.html)，并且持续，关键是服务好。你可以选择时长，环境系统就选``centos7``（linux的一个发行版），不要用winserver,linux操作基础的都可以百度到,地域目前无所谓,时长看自身情况。

2. 完成学生认证后，是直接获取支付宝认证信息，一步完成，就能使用这种优惠，购买时记得选择设置密码而先不是密钥，牢记你的密码。然后你进入管理控制台，就能看到你的服务器信息。

![点击左侧云服务器ECS实例，进入操作。](https://upload-images.jianshu.io/upload_images/3234038-89e0ec0aeb204589.JPG?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

![启动你服务器，运行中](https://upload-images.jianshu.io/upload_images/3234038-c92de9e9d0f7238c.JPG?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

3. 配置安全组,左侧安全组->配置规则->公网入方向->快速创建规则,端口就先全开了，自定义端口因为我们这里推荐linux系统，填22/22（winserver填3389/3389），授权对象填``0.0.0.0/0``，表示允许任何地方连接你的服务器，先这样设置（一般没人闲的黑学生机）。
然后就开始ssh配置，这里使用阿里云的[一键部署web环境包](https://pan.baidu.com/s/1geUK7wJ)（密码：h1ac），包含php环境,包含了官方参考文档。

### 2.1.2 安装
#### 2.1.2.1 材料工具
[xshell](https://www.netsarang.com/download/down_xfp.html)(一个与linux通信的软件)和[xftp](https://www.netsarang.com/download/down_xfp.html)(一个与服务器进行文件操作的软件)，然后其他的操作文档写的很详细，也可以参照[最新官网文档](https://source.docs.cloudcare.cn/support/tool/web/web_1/)。

#### 2.1.2.2 开始
{% note info %}
web服务器选择Apache就行，因为桌面调试一般也是这样的，免去兼容的操作。Nginx虽然性能好，总有一些新操作，对开发形成难度，建议以后再使用。其他的版本根据你桌面使用的环境，就高不就低。我们的原则是快速入门配置，搭好工具把时间留给学习开发，不要被这些门槛绊住。那些命令行操作慢慢就熟悉了，其实后面使用时只需要知道怎么连接，怎么上传文件即可。
{% endnote %}
#### 2.1.2.3 配置web服务器
如果你是安装了php环境，它会默认安装phpwind(一个开源论坛)和phpmyadmin（一个可以在线访问数据库的工具，留着）,因为访问服务器外网IP时，它是指向phpwind的，所以可以先卸载掉这个东西，直接指向到你的网站根目录alidata/www/,这样以后就很方便的能访问到下面的不同文件夹内容。这里的操作就需要[参考官网文档](http://source.docs.cloudcare.cn/support/tool/web/web_1/)了，也一样很详细。，在修改conf那一步，可参考这里已经测试过的[配置文件](https://pan.baidu.com/s/1skXirtr)（密码a3f1）替换掉``phpwind.conf``
```js
<DirectoryMatch "/alidata/www/(attachment|html|data)">
<Files ~ ".php">
Order allow,deny
Deny from all
</Files>
</DirectoryMatch>

<VirtualHost *:80>
	DocumentRoot /alidata/www
	ServerName localhost
	ServerAlias localhost
	<Directory "/alidata/www">
	    Options Indexes FollowSymLinks
	    AllowOverride all
	    Order allow,deny
	    Allow from all
	</Directory>
	ErrorLog "/alidata/log/httpd/dx-error.log"
	CustomLog "/alidata/log/httpd/dx.log" common
</VirtualHost>
```
### 2.1.3 测试
好了，现在可以上传几个文件进行测试，浏览器键入IP时如果下面没有index的引导文件，是这样直接显示的，可以写一个简单的index.html上传看下效果，然后使用手机浏览器，QQ/微信内部打开（发个链接给别人，会自动识别）再访问下，保证正常访问到就说明基本的配置已经成功了。由于微信的安全保护，如果是IP或者没有被他收录的域名，是会跳出提示框，不过也不影响继续能访问到。解决这个的方法就是备案，https认证等等一系列证明网站是良好文明的。

![](https://upload-images.jianshu.io/upload_images/3234038-a6dae4a27308a323.JPG?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)


## 2.2 github.io

先注册一个自己的账号，用户名很重要，因为稍后生成的链接就是像[makergyt.github.io](https://makergyt.github.io)（makergyt是一个用户名），后期也可以修改，但对应的链接就会失效，需要再次配置。
有三种方式，使用桌面软件快速构建，使用git命令，使用已经创建好的仓库，这里我们使用第一种。

### 2.2.1 开始

![1.Create a new repository](https://upload-images.jianshu.io/upload_images/3234038-2341fe768acb5fab.JPG?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

安装软件，复制.git路径
![2.克隆github上的仓库到本地](https://upload-images.jianshu.io/upload_images/3234038-94900541e70371a6.JPG?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

![3.项目内容放到该路径下](https://upload-images.jianshu.io/upload_images/3234038-72eb180da889081c.JPG?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

![4.每次改动后，备注修改内容，然后就可以pull origin](https://upload-images.jianshu.io/upload_images/3234038-372aaf03ea4ece35.JPG?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

### 2.2.2 测试
现在可以试着访问github.io了，``用户名.github.io``，因为github托管在国外，可能会比较慢。上述两种建站方式，建议前端开发静态页面可以先使用github.io。

{% note info %}
实现建站的路有很多条，服务也很多种，但是一路畅通的很少，常常看似简单实际需要别的技术栈。去粗取精，权衡利弊，以上这两种是较为基础的。
{% endnote %}

# Reference

<small>[1] Github.Websites for you and your projects.[EB/OL].https://pages.github.com .2017.</small>

