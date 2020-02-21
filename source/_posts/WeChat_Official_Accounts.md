---
title: 微信订阅号开发记录
date: 2019-01-04 21:21:36
tags: 
  - 微信
categories: record
description: 仅作记录
---
# 0 准备
## 0.1 环境
| 系统 | 语言 | web服务器 |
| ---- | ---- | ---- |
| ubuntu 18.04 | node v10.18.0 | nginx v1.16.0 |
## 0.2 其他
- 公众号订阅号
- 域名，解析至服务器IP

## 0.3 定义
- TOKEN 响应验证
- APPID 公众号唯一识别码
- AESKey 消息体加解密密钥
- DOMAIN 域名

# 1 开始
## 1.1 安装
```sh
git clone git@e.coding.net:makergyt/wechat-message.git
cd wechat-message
npm i
```
## 1.2 配置
```js
// app.js
var config = {
    token: TOKEN, 
    appid: APPID, 
    encodingAESKey: AESKey,
    checkSignature: true 
};
```
Nginx
```sh
server {
    listen 80;
    server_name DOMAIN;       # 域名

    location / {
        proxy_pass http://127.0.0.1:5050;
    }
}
```
# 2 启动
```sh
npm i pm2 -g
pm2 start app.js --name wechat
```
# 3. 测试
公众号窗口发送任意消息，回复固定
>你好，Hello World!

# 参考
- nodejs:https://cloud.tencent.com/developer/labs/lab/10196
- python:https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1472017492_58YV5
- php:https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421135319
