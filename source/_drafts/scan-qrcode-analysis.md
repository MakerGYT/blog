---
title: 扫描二维码分析
date: 2019-05-11 09:36:17
tags:
  - wechat
  - qrcode
  - oauth
categories: study
description: 实现扫码登录
---
{% note info %}
由于开发过程需要用到扫码登录，关键一环在于手机客户端扫码后，浏览器如何知道扫码成功并执行用户登录逻辑。首先想到的是浏览器渲染二维码后，开启监听服务端，那么基于C/S的架构和http协议，必然要求浏览器不断向服务端发起请求。而客户端扫码后，如何判断回调执行操作，如何保证二维码有效性，于是考虑先对成熟的产品进行剖析。
{% endnote%}

# 1 二维码本质
## 1.1 产生需求
二维码既然是码，就只是一种信息的编码，与条形码相同，扫码只是机器直接读取信息到机器自己，与人眼看到一串字符没有本质区别。关键在于识别到文本后的操作，这其实是替代了用户对繁琐目标信息的输入操作。这一点很容易理解，但难以认识到，因为常常会聚焦于它的业务属性，而容易忽略它只是一条文本字符串。一些二维码工具如草料二维码，除了文本和网址,其他提供的媒体类功能已经在固有文本上做了一层处理或是依赖于其自身的业务体系，并没有超出二维码的使用能力。

以网址二维码为例，在没有二维码的情况下，进入一个网址可以直接输入，当然如果要加上扫描进入，完全可以OCR直接扫描URL,但URL长度不固定，形式多样化，OCR端无法做到规范，那么条形码呢，条形码由于只能在横向方位表达信息，需要涵盖的URL越长，条码也就随之增长，不利于传播。而同样的信息编码，二维码在纵向和横向同时表达信息，信息空间利用率高，规范，容易扫描。

二维码只是表明在二维空间上用几何形体来编码信息，常见的二维码是QR Code即Quick Response Code，属于矩阵式二维码，它只是二维码的一种码制，恰如余3码、8421码在BCD码中的范畴。有的QR Code复杂，有的简单,主要是版本不同，由40种尺寸的版本。通过色块的差异，使用0-1二进制编码。
![](https://coolshell.cn/wp-content/uploads/2013/10/QR-Code-Overview.jpeg)

## 1.2 业务形态：
- 身份信息验证
  对用户而言，属于被动读取，如一些移动支付设备、票务验证设备扫描当前要进行业务处理的用户持有的二维码，主要**用户平台读取用户信息**。对用户而言基本上处于无感操作，但其实风险较高，辨识度也不一定好。因而在逐步转为生物识别方案。
- 关联信息服务
  对用户而言，属于主动读取，如一些网址类场景的进入，主要用于用户获取二维码存储内容后触发打开网址操作，在一些特定的业务场景中，**扫码后的触发操作**丰富多样。

那么综合看来，扫码登录对用户来说既是属于主动读取，但又是用于平台验证用户信息，需要进一步理清这里边的关系。扫码登录相当于在手机客户端与浏览器页面建立连接关系，这种关系是经由用户授权的。对用户而言，扫码是为了识别当前操作的web环境，而授权则是让web端去读取用户信息。这样看来，这里的扫码主要还是处于关联信息服务这一形态。
# 2 扫码实现
以下从用户角度反推技术实现，不一定正确
## 2.1 系统底层扫码能力
必然首先要调取摄像头，然后调用识别接口
## 2.2 App实现扫码
在手机操作系统之上，运行的App具有调用摄像头的功能，而相机、内置扫码功能均可以识别二维码信息，但只是文本信息，即使是url也并没有直接跳转，同一层次的app具备的扫码功能各不相同，主要集中于扫码界面的不同，扫码后的操作。相同的是，对于url的处理都是基于内置浏览器直接打开.
测试一条百度的首页二维码，用支付宝微信等业务场景丰富的APP可以直接打开，而场景特定的天猫京东则会提示是否打开，打开会使用手机默认浏览器。百度网盘则直接提示，暂不支持非网盘二维码。这说明，在扫码识别成功后（识别到的必然还是一条文本信息），APP内部的回调机制会判断文本的属性。注意到同样是文本，微信支付宝会在一个特定的页面呈现（调用内置浏览器），而天猫等则会直接在扫码后显示（调用本地页面）。于是猜想，是否前者会将扫码内容上传至服务端后再由服务端处理后后统一下发，这样做就可以实现丰富的扫码场景，这也契合这类app的功能，本地应该不可能将所有的扫码后操作写入回调，根据扫码结果打开特定网页，在该网页执行回调操作
## 2.3 小程序扫码
在app之上，小程序提供了调起客户端扫码界面的接口，这一界面与直接使用微信扫码体验一致，然而差异在于接口提供的回调函数，如同一个中间件，在扫码完成后拦截扫码结果后自行处理,而微信扫码则只能被执行其上述的处理逻辑。在实现层面，两种扫码最终都会调用客户端的扫码接口，只需提供一个场景参数来判断后续回调该如何执行即可。

# 3 扫码登录分析
在app之中，扫码后如何判断当前类型以及后续操作，如果采用本地实现，注意到几乎所有的微信二维码（个人及公众号、）都是微信的域名或者短链开头附带参数的形式，支付宝的二维码会集中到https://qr.alipay.com下
## 3.1 公众号登录:

{% note info no-icon%}
由于登录管理业务较为多样，尽量抽取必要的过程,特殊之处是由于上一步已经输入了账号密码，因此服务端知道需要什么样的微信账号扫码才是有效的，相当于做了双向验证。
{% endnote %}
### 3.1.1 入口
```json
GET https://mp.weixin.qq.com/cgi-bin/bizlogin
{
  "action": "validate",// 账号密码已校验
  "lang": "zh_CN",
  "account": "xxx",
  "token": 
}
```
由此时url可以猜测，这一步的扫码操作只是在获取后续访问用户接口的token。

cookie很长，会存放在Request Cookies中

![](https://cdn.blog.makergyt.com/images/study-login_wechat_official-cookie.png)

### 3.1.2 渲染二维码
```json
GET https://mp.weixin.qq.com/cgi-bin/loginqrcode
Content-Type: image/jpg
{
  "action": "getqrcode",
  "param": "4300",
  "rd": "309"
}
```
### 3.1.3 二维码文本内容识别：
>https://mp.weixin.qq.com/wap/loginauthqrcode?action=scan&qrticket=be0271075c87f07664f983b41a1afa

直接浏览器打开不报错，不显示任何内容，猜测做了浏览器环境检测
可以理解为随后微信调用内置浏览器向此url发送get请求，没有测试使用其他账户扫码的结果，猜测会报失败，那么不同的用户扫码扫到相同结果，但是需要向服务端发送用户信息，用户信息如何发送呢？
- 微信客户端与会话session
- 微信客户端解析url后执行补充参数操作

第一种实现的可能性大
### 3.1.4 请求
最明显的是几乎每间隔1s，会向发起xhr请求:

![](https://cdn.blog.makergyt.com/images/study-login_wechat_official-network.png)

```json
GET https://mp.weixin.qq.com/cgi-bin/loginqrcode
{
  "action": "ask",
  "token": ,
  "lang": "zh_CN",
  "f": "json",
  "ajax": 1
}
// Response
{
  "base_resp":
  {
    "err_msg":"ok",
    "ret":0
  },
  "status":0,
  "user_category":0
}
```
在请求多次后，页面提示二维码过期,status为3,停止xhr请求。猜测，在页面渲染出二维码前后,浏览器向服务端轮询，有效期应该是由服务端控制。在扫描成功后，页面提示扫描成功，status为4,继续xhr请求。猜测，此时等待用户授权，浏览器向服务端轮询，授权后的回应由于手速不快，且长时间频繁轮询，导致浏览器卡死，暂时无法看到，但可以猜测到仍然是status的改变，或许是1，再加上token的返回，使得可以进入主页获取信息。用户取消授权，页面仍然继续原先xhr请求，由获取响应猜测，取消授权并没有向服务端发送消息，在二维码有效期内，用户再次扫描授权依然可以登录。
## 3.2 网页端微信登录
{% note info no-icon%}
网页端对登录用户未知
{% endnote %}
### 3.2.1 入口
```json
GET https://wx.qq.com/
POST https://wx.qq.com/cgi-bin/mmwebwx-bin/webwxstatreport
{
  "fun": "new",
}
// Resquest payload
{
  "BaseRequest":
  {
    "Uin":"",
    "Sid":"",
    "DeviceID":"e395927229659859"
  },
  "Count":0,
  "List":[]
}
// no Response
```
加载页面会调用3次POST,不同的是Request payload里的count和List(第一次)，由于后续登录到主页时，依然会调用，猜测这只是此应用的加载框架。
### 3.2.2 渲染二维码
```json
GET https://login.weixin.qq.com/I/YblD1gWXOA==
Content-Type: image/jpg
```
可能https://login.weixin.qq.com/I是二维码接口，后边的``YblD1gWXOA==``应该是作为全局的唯一ID参数传入,但不清楚以``==``结尾的用处
### 3.2.3 扫码结果
>https://login.weixin.qq.com/I/YblD1gWXOA==

此结果即为二维码的请求接口，直接打开依然进入到登录页面，inspect提示Please visit on computer browsers，看来对微信以外的浏览器打开此类型链接就会视为电脑端。
### 3.2.4 请求
每隔一段时间，浏览器向发起script请求
```json
GET https://login.wx.qq.com/cgi-bin/mmwebwx-bin/login
Content-Type: text/javascript
{
  "loginicon": true,
  "uuid": "YblD1gWXOA",
  "tip": 0,
  "r": "1526271870", // 变化
  "_": "1557546830994" // 变化
}
// Response
window.code=408;
```
多次请求后，猜测可能服务端判定二维码过期(最后一次请求没有回应)，页面被重新加载。
扫码完成后，页面会显示出扫描者的头像，猜测扫描后已经将用户信息发至服务端。
```js
// Response
window.code = 201;
window.userAvatar = '...';
```
此时浏览器继续script请求,切换用户后，该script
```js
// Response
window.code = 400;
```
刷新二维码时，产生一个请求
```json
// GET https://login.wx.qq.com/jslogin
{
  "appid": "wx782c26e4c19acffb",
  "redirect_uri": "https://wx.qq.com/cgi-bin/mmwebwx-bin/webwxnewloginpage",
  "fun": "new",
  "lang": "en_US",
  "_": "1557547453965", // 应该是时间戳
}
```
这可能是用于登录的内部应用，层级和微信开放平台的接入app类似。
登录后没能捕捉到script请求回应，猜测应该是基于code的改变。
登录后请求
```json
// GET https://wx2.qq.com/cgi-bin/mmwebwx-bin/webwxnewloginpage
{
  "ticket":"AxzDrAIOzOY7W8YqIP3jV8au@qrticket_0
",
  "uuid":"YblD1gWXOA==",
  "lang":"en_US",
  "scan":"1557548341",  
}
```
增加cookie

![](https://cdn.blog.makergyt.com/images/study-login_wechat_official-headers.png)

没有发现登录后获取到的token之类的字段，且请求用户好友时没有携带相应参数，猜测已经直接写入cookie。

## 小结
综合看来，由于服务端只能被动接受请求后向客户端回应，为了实现向客户端推送扫码结果消息，都是分为两步，渲染出二维码后轮询，扫码后继续轮询，二维码信息有效期均由服务端维护，但未知的是有效期的计算方式：
- 按两步间隔分别计算
- 从产生二维码起

第二种的实现可能性大
## 3.3 goeasy
### 3.3.1 web待登录端
#### 3.3.1.1 产生二维码
{% tabs First unique name %}
<!-- tab Request-->
GET https://www.goeasy.io/en/demo/qrcodelogin/qrcode
{% code %}
{
  "qrCodeUrl": "https://hangzhou.goeasy.io/en/demo/qrcodelogin/mobileconfirm?key=1b8a6c12-e696-4b7f-b3e2-0d1ce1b72eb2"
}
{% endcode %}
<!-- endtab -->
<!-- tab Response-->
![](https://www.goeasy.io/en/demo/qrcodelogin/qrcode?qrCodeUrl=http%3A%2F%2Fhangzhou.goeasy.io%2Fen%2Fdemo%2Fqrcodelogin%2Fmobileconfirm%3Fkey%3D97f39297-144f-4485-9662-a163d7af42e2)
<!-- endtab -->
{% endtabs %}
经测试，此接口只是产生二维码，没有任何校验(传参)
qrCodeUrl为二维码内容，注意到key，这个二维码会将用户引导至该url,内容完全由浏览器生成
```js
1. GET https://3hangzhou.goeasy.io/socket.io/
{
  "EIO":3,
  "transport":"polling",
  "j":0,
  "t":"MgfJnEd",
  "b64":1, // base64 ?
}
Response
{
  "sid":"479511bd-59ee-4355-900d-96c0215bf5e1", // 请求连接，获取到码
  "upgrades":["websocket"],
  "pingInterval":25000,
  "pingTimeout":20000
}
2. GET http://3hangzhou.goeasy.io/socket.io/
{
  "EIO":3,
  "transport":"polling",
  "j":0,
  "t":"MgfKThp",
  "b64":1, // base64 ?,
  "sid": "479511bd-59ee-4355-900d-96c0215bf5e1" // 将码发上去，试图连接
}
Response
{
  "content":"Ok", // 连接码匹配 ，写入Response Cookies
  "sid":"73746791-614f-4242-a750-29b2e1d67952",
  "enableSubscribe":true, // 允许订阅该频道
  "enablePublish":true, // 允许发布信息
  "resultCode":200
}
3. GET http://3hangzhou.goeasy.io/socket.io/ 出现两次,位于socket建立前后
{
  "EIO":3,
  "transport":"polling",
  "j":0,
  "t":"MgfKTjs",
  "b64":1, // base64 ?,
  "sid": "479511bd-59ee-4355-900d-96c0215bf5e1" // sid与上两步相同
}

4. POST http://3hangzhou.goeasy.io/socket.io/
{
  "EIO":3,
  "transport":"polling",
  "j":0,
  "t":"MgfKThj",
  "b64":1, // base64 ?,
  "sid": "479511bd-59ee-4355-900d-96c0215bf5e1" // sid与上三步相同
}
Form Data
{
  "d": 224:420["authorize",{ // 应用层级的信息
    "appkey":"PC-3c1dfc8b03c44aa58b5b601c0fb230bc",
    "userId":"anonymous-94019",
    "username":"",
    "userData":"",
    "startMillis":1557571737428,
    "artifactVersion":"0.19.22",
    "otp":"Ulm51QzXjVYfdxyHQCFOIg==","
    manual":false
  }] 
}
Response
ok // 这一步发生于websocket之后，明显对整个流程是多余的，应该只是用来提供给中后台做数据统计的
5. socket ws://3hangzhou.goeasy.io/socket.io/
{
  "EIO":3,
  "transport":"websocket",
  "sid": "479511bd-59ee-4355-900d-96c0215bf5e1" // sid与上四步相同
}
Messages
↑[
  "subscribe",{
    "channel":"1b8a6c12-e696-4b7f-b3e2-0d1ce1b72eb2",// qrcode key
    "sid":"73746791-614f-4242-a750-29b2e1d67952" // 第2步Response中的sid
  }] // 由goeasy.subscribe发起
↓[{
    "content":"Ok",
    "channel":"1b8a6c12-e696-4b7f-b3e2-0d1ce1b72eb2", // qrcode key
    "resultCode":200
  }]
// allow
↓[
  "message",{
    "i":"9d266860744b11e9a0bf77ea08eba6fb",
    "t":1557620372490,
    "n":"1b8a6c12-e696-4b7f-b3e2-0d1ce1b72eb2", // qrcode key
    "c":"confirm",
    "a":true
  }]
↑[
  "ack",{
    "publishGuid":"9d266860744b11e9a0bf77ea08eba6fb" // i
  }] // i
// reject
↓[
  "message",{
    "i":"44914b60744c11e9b73565a64c922f3d",
    "t":1557620653375,
    "n":"1b8a6c12-e696-4b7f-b3e2-0d1ce1b72eb2", // qrcode key
    "c":"cancel",
    "a":true
  }] 
↑[
  "ack",{
    "publishGuid":"44914b60744c11e9b73565a64c922f3d" // i
  }] 
```
#### 3.3.1.2 时序
2 中enableSubscribe和enablePublish响应应该是根据4中的appKey获得的，而appkey是写在页面js中的
二维码中的key和goeasy.subscribe中的channel是由页面初次加载生成的，服务端channel建立后即返回ok，进入onSuccess

### 3.3.2 验证端
```js
1. GET http://www.goeasy.io/en/demo/qrcodelogin/mobileconfirm
{
  "key": "1b8a6c12-e696-4b7f-b3e2-0d1ce1b72eb2"
}
Response
Allow
Reject
2. GET http://4hangzhou.goeasy.io/socket.io/
{
  "EIO":3,
  "transport":"polling",
  "j":0,
  "t":"MgfSseu",
  "b64":1, 
} 
Response
{
  "sid":"4bce3017-7f51-4095-8b26-966d27f191fe",
  "upgrades":["websocket"],
  "pingInterval":25000,
  "pingTimeout":20000
}
3. GET http://4hangzhou.goeasy.io/socket.io/ //twice
{
  "EIO":3,
  "transport":"polling",
  "j":0,
  "t":"MgfU9ME",
  "b64":1, 
  "sid": "4bce3017-7f51-4095-8b26-966d27f191fe"
}
4. POST http://4hangzhou.goeasy.io/socket.io/
{
  "EIO":3,
  "transport":"polling",
  "j":0,
  "t":"MgfKThj",
  "b64":1, // base64 ?,
  "sid": "4bce3017-7f51-4095-8b26-966d27f191fe"
}
Form Data
{
  "d": 224:420["authorize",{
    "appkey":"PC-3c1dfc8b03c44aa58b5b601c0fb230bc","userId":"anonymous-76117",
    "username":"",
    "userData":"",
    "startMillis":1557618692944,
    "artifactVersion":"0.19.22",
    "otp":"Wdjj/rwWobxgJLipKAVwog==","
    manual":false}] 
}
Response
ok
5. socket ws://3hangzhou.goeasy.io/socket.io/
{
  "EIO":3,
  "transport":"websocket",
  "sid": "4bce3017-7f51-4095-8b26-966d27f191fe"
}
Messages
↓[{
    "content": "Ok"
    "enablePublish": true
    "enableSubscribe": true
    "resultCode": 200
    "sid": "1d9c09df-735c-42f7-b522-b6e37fc5a3fa"
  }]
// allow
↑[
  "publish",{
    "channel":"1b8a6c12-e696-4b7f-b3e2-0d1ce1b72eb2",
    "content": "confirm"
    "guid": "c90451e0-7450-11e9-97a1-5f37f3f5a2a1" // web端 message i
    "retried": 0
    "sid": "497dfc4a-bef2-40c5-97cf-816db52f4202"
  }]
↓[{
  "content","Ok"，
  "resultCode": 200
  }]
// reject
↑[
  "publish",{
    "channel":"1b8a6c12-e696-4b7f-b3e2-0d1ce1b72eb2",
    "content": "cancel"
    "guid": "44914b60744c11e9b73565a64c922f3d" // web端 message i
    "retried": 0
    "sid": "4a66feaf-de7c-451c-8302-552c8dba2471"
  }]
↓[{
  "content","Ok"，
  "resultCode": 200
  }]
```

### 3.3.3 综合分析

发布订阅者模式，如何共同管理一个变量，对特定事件的消息做出反馈，同样事先要知道频道名称。发布后相当于建立了一个频道，对扫码来说，
对调用者而言，只需关注channel和message，websocket如何建立以及隔离对调用者是透明的，实现即用即连。实际上调用者的客户端和服务端都在与同一个websocket server进行会话，会话之前，需要先向官方的管理平台发送建立信息。
重新加载则视为先断开后连接，关闭选项卡视为断开
### 3.3.4 缺陷
- 如果多人扫码，会将多人的授权情况都发到web端，造成混乱。
- 如果web端二维码发生重载（用户发起），原先二维码并没有马上失效
### 3.3.5 未解
key何时生成及如何生成
由于无法同时监测所有传送数据，~~大致判断后没有发现sid字段的相互联系~~，sid格式仍是uuid的格式
由于服务端只提供了java的SDK，没有按照官方的业务测试使用，不清楚之间的部署与调用关系
由于未实际测试使用socket.io的接口，现已发现以上五次请求均为默认的请求，部分参数包括sid也是socket中自带的。那么该平台又是如何将自己的参数插入的未知
通过查阅官方文档，服务端在websocket中推送数据时，

|Name|Required|Description|
|--|--|--|
|appkey	|Yes|	Your app key|
|channel|Yes|Target channel name|
|content|Yes|The message you want to publish|


![](https://www.goeasy.io/resources/www/images/part0ne2_1_en.gif)
# 4 扫码登录的解决方案
## 4.0 技术要点
扫码的过程是为了引导用户到指定的授权页面，进入这个页面要同时向服务端传送需要授权的web端环境信息（由二维码信息提供），识别当前登录用户，（等同于用户输入账号信息），验证用户权限，（等同于服务端异步处理表单数据），用户授权，（等同于用户输入密码）。服务端就可以确认验证后的用户和将此消息下发至哪个web端。
~~暂时二维码信息由服务端生成并管理，目前不知道为什么这样做，但觉得好像是对的~~
### 4.0.1 Polling、Long Polling、WebSocket
### 4.0.2 socket
#### 4.0.2.1 socket 连接身份验证
#### 4.0.2.2 namespace & room
### 4.0.3 二维码生成
#### 4.0.3.1 普通二维码
- 向某个二维码接口请求，Content-Type: image/png，获取到的内容放在``<img src="">``
- qrcode.react组件，传入参数直接渲染(cavas绘制)，参数可由客户端直接生成，也可由服务端生成，也可由客户端生成附带其他信息经服务端检测（安全性）后下发

#### 4.0.3.2 带参小程序码
## 4.1 二维码信息
由于小程序打不开网页，二维码也就无需管理URL,但为了使得小程序的扫码操作只局限于本应用，应该在二维码上加上域名信息作为判断二维码对小程序的有效性。 
### 4.1.1 小程序扫码后的回调
#### 4.1.1.1 普通二维码
需要在二维码上附加操作类型参数，以便选择回调函数
#### 4.1.1.2 小程序码
由于小程序码由页面+参数构成，扫码后直接进入到该页面，执行该页面的逻辑，因而不需要考虑回调操作的选择。
## 4.2 扫码场景
### 4.2.1 微信扫小程序码
扫码后打开小程序,进入小程序的逻辑，集成于小程序扫小程序码的内部。
### 4.2.2 小程序扫普通二维码
可以实现，并且支持不授权登录。
#### 4.2.2.1  设计
但普通二维码如何避免被使用其他工具扫描泄露key，文本不可避免要被扫描出来，只能进行一步加密操作
工具扫码大致流程：识别文本－>判别类型，如果是网址直接使用内置浏览器打开
1. 小程序端识别到UUID，并以此建立socket连接，通知已扫码，(客户端二维码失效，等待授权操作后重新更新）
2. 将身份信息发至服务端，由服务端调用用户管理接口，进行身份验证，返回登录权限
3. 根据登录权限，跳转至授权页或者错误页
   授权页提示信息


二维码被扫描的信息是否需要提交，若处在客户端有验证信息情况下需要，其他客户端扫码是无效的，不应对主逻辑产生影响
保证小程序扫码过程完成，客户端要知道当前的key已经失效（除非被授权），即key的生命期 = 从服务端生成发至客户端开始至被扫码　|| 固定时间有效期, 
扫码完成后，服务端调用用户管理接口，授权完成后，客户端将此key与用户session绑定
小程序是否有必要加入socket会话中？小程序扫码后直接向服务端发送结果，点击授权也是直接发送结果，似乎不存在从服务器主动下发消息的情况，应该是无状态的扫码，二维码在改变，但小程序只负责扫描。由于小程序打不开网页，二维码也就无需管理URL,但为了使得小程序的扫码操作只局限于本应用，应该在二维码上加上域名信息作为判断二维码对小程序的有效性。  

保证在小程序扫码，只能扫本域内的有效码；
用别处扫该码，只能扫到密钥文本，或引导到本域内某个地址，提示请使用某某某小程序扫码并附带小程序二维码，那么小程序二维码先得附带URL,扫码回调页面由服务端生成后（由客户端请求时附带操作参数）
#### 4.2.2.2 权限管理
权限应该是对接口调取的管理，而不仅是前端页面的显示与隐藏
用户扫码完成后，由于扫码操作已经产生一次数据上传，完全可以在回调中提示用户权限，但从用户角度，仅仅扫码不应该将用户数据上传，而应该在授权时获取用户同意后再上传判断权限，这样做增加了操作成本，但利于体验。
### 4.2.3 微信扫普通二维码
暂时不可实现：可识别信息，但无法携带微信账户信息
### 4.2.4 小结
综上，为了提高用户体验，使用第一种方式，微信扫描带参数小程序码，调起小程序至授权页面。当然，这也就天然支持小程序环境直接扫描小程序码，这样就对用户模糊了操作界限。
## 4.3 监听形态
### 4.3.1 web轮询
![](https://cdn.blog.makergyt.com/images/study-scan_login-polling.png)
### 4.3.2 websocket

|eventName|args|ack|remarks|
|--|--|--|--|
|listen|channel|join room|client|
|scan||join room|weapp|
|auth|userInfo|auth result|weapp|
|auth|reject|auth result|weapp|
|expired||leave|client|
|leave|user|close|client、weapp|

![](https://cdn.blog.makergyt.com/images/study-scan_login-structure.jpg)
# 未解
1. 如何保存chrome devtools 中请求response日志

    勾选preserve log后可以保存networks列表，保证页面被reload后还存在，但是过程中的response已经找不到。
2. 如何判断出真实的请求时序

# 参考
[1] 黄聪.如何扩展Chrome DevTools来获取页面请求.https://www.cnblogs.com/huangcong/p/9414479.html [EB/OL] 2018