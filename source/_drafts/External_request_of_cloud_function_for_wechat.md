---
title: 微信小程序云开发之云函数外部请求
date: 2019-04-18 11:59:07
tags:
- wechat

cagetories: record 
description: 通过云函数发起外部网络请求，省去校验域名
---
{% note info no-icon %}
在小程序开发中，遇到一些未在国内备案的域名无法加到管理后台的情况，突破这个限制，想到了用云开发做接口转发
{% endnote%}

官方提示：
{% note info %}
在云函数中我们可以引入第三方依赖来帮助我们更快的开发。云函数的运行环境是 Node.js，因此我们可以使用 npm 安装第三方依赖。比如除了使用 Node.js 提供的原生 http 接口在云函数中发起网络请求，我们还可以使用一个流行的 Node.js 网络请求库 request 来更便捷的发起网络请求。
{% endnote%}
于是新建一个云函数
```js
//cloudFuntion/github/index.js
const cloud = require('wx-server-sdk')
var request = require('request-promise');

exports.main = async (event, context) => {
  cloud.init({
    env: 'test-728bbc'
  });
 var request = require('request');
 
var options = {
  url: 'https://api.github.com/repos/request/request',
  headers: {
    'User-Agent': 'request'
  }
};
 
function callback(error, response, body) {
  if (!error && response.statusCode == 200) {
    var info = JSON.parse(body);
    return info;
  }
}
request(options, callback);
}
```
在小程序端
```js
//app.js
App({
  onLaunch: function () {
    wx.cloud.init({
      env: "test-728bbc"
    });
  },
  globalData: {
    userInfo: null
  }
});
//source/index.js
Page({
    onLoad: function () {
        wx.cloud.callFunction({
            name: 'github',
            complete: res => {
                console.log('callFunction test result: ', res)
            },
        })
    },
 )}
```
然而上传云函数后测试始终返回
```json
{
    errMsg: "cloud.callFunction:ok",
    result: null,
    requestID: "1618a9aa-618e-11e9-97c2-52540025df0e"
}
```
开始换用node自带的http模块，但结果相同，后换用promise写法
```js
//cloudFuntion/github/index.js
const cloud = require('wx-server-sdk')
var request = require('request-promise');

exports.main = async (event, context) => {
  cloud.init({
    env: 'test-728bbc'
  });
  var options = {
    method: 'GET',
    url: 'https://api.github.com/repos/request/request',
    headers: {
      'User-Agent': 'request'
    },
    json: true
  };
  const resultValue = await request(options);
  return resultValue
}
```
成功返回预期结果,但异常类型未知
# Reference
<small>
[1] 微信小程序团队.小程序开发-云开发[EB/OL].https://developers.weixin.qq.com/miniprogram/dev/wxcloud/guide/functions/npm.html. 2019.
</small>