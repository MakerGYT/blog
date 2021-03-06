---
title: 网络代理记录(1)
date: 2018-12-24 17:30:30
tags:
    - shadowsocks
categories: record
---

# 1 概述
遵循国家法律法规，科学使用网络技术，本文仅用于学习记录。
主要由两部分组成:服务端(中介)和客户端
<!-- more -->
# 2 准备
- 资金：>=$10
- 远程工具：ubuntu terminal(ssh连接VPS) 
- 定义
  - VPS_IP: 服务器IP地址
  - SSSERVER_PORT： 服务端端口
  - SS_PASSWORD: 连接密码


# 3 开工
## 3.1 服务端
### 3.1.1 选购VPS
使用[vultr](https://www.vultr.com/?ref=7533527)，注册账户，该服务商采用的是先[充值](https://www.vultr.com/?ref=8407425-6G)后消费，支持支付宝，按使用时间计费，月底结算。
> Vultr, founded in 2014, is on a mission to empower developers and businesses by simplifying the deployment of infrastructure via its advanced cloud platform. 

<a href="https://www.vultr.com/?ref=8407425-6G"><img src="https://www.vultr.com/media/banners/banner_728x90.png" width="728" height="90"></a>

Deploy一台服务器，规格如下：
| Server          | Cloud Compute    |
| --------------- |----------------- | 
| Server Location | New York (NJ)    | 
| Server Type     | Ubuntu 18.04 x64 | 
| Server Size     | 10 GB SSD, 1 CPU, 512MB Memory, 500GB Bandwidth （ $3.50/month）|   
| Other options | Temporary default |  

### 3.1.2 安全组
新增安全组，IPv4 Rules:
| Action | Protocol	| Port (or range) | Source | Notes | Action |
| ------ | -------- | --------------- | ------ | ----- | ------ |
| accept | TCP	    | 22	          | 0.0.0.0/0 |
| accept | TCP	    | `SSSERVER_PORT`	  | 0.0.0.0/0 |
| drop	 | any	    | 0 - 65535	      | 0.0.0.0/0 |  |(default)|

### 3.1.3 部署
1. 初始化：
```sh
# login
ssh root@VPS_IP
# modify root password
sudo passwd
# update
apt update
apt-get update
```
2. 安装python版：
```python
# install basic pip dependency:
apt-get install python-pip # default 8.1.1
pip install --upgrade pip # to 18.1 close current terminal and restart
apt-get install python-setuptools
pip install shadowsocks
```
或者libev版
```sh
# install:shadowsocks-libev
sudo apt-get install software-properties-common -y
sudo add-apt-repository ppa:max-c-lv/shadowsocks-libev -y
sudo apt-get update
sudo apt install shadowsocks-libev
```

3. 配置：
```sh
# /etc/shadowsocks.json
{
  "server": VPS_IP,
  "server_port": SSSERVER_PORT,
  "local_address": "127.0.0.1",
  "local_port": 1080,
  "password": SS_PASSWORD,
  "timeout": 300,
  "method": "aes-256-cfb",
  "fast_open": true
}
```
4. 启动
```sh
ssserver -c /etc/shadowsocks.json -d start
```
5. 异常

 `AttributeError: /usr/lib/x86_64-linux-gnu/libcrypto.so.1.1: undefined symbol: EVP_CIPHER_CTX_cleanup`
```sh
# /usr/local/lib/python2.7/dist-packages/shadowsocks/crypto/openssl.py
libcrypto.EVP_CIPHER_CTX_cleanup.argtypes = (c_void_p,) => libcrypto.EVP_CIPHER_CTX_reset.argtypes = (c_void_p,) # line52
libcrypto.EVP_CIPHER_CTX_cleanup(self._ctx) => libcrypto.EVP_CIPHER_CTX_reset(self._ctx) # line111
```
6. 测试
```sh
telnet VPS_IP SSSERVER_PORT
```
### 3.1.4 bbr 加速
```sh
sudo echo "net.core.default_qdisc=fq" >> /etc/sysctl.conf
sudo echo "net.ipv4.tcp_congestion_control=bbr" >> /etc/sysctl.conf
sysctl -p # 保存生效
# 测试
sysctl net.ipv4.tcp_available_congestion_control
net.ipv4.tcp_available_congestion_control = bbr cubic reno # 返回此结果，则表示成功
```
## 3.2 客户端
### 3.2.1 ubuntu客户端
#### 3.2.1.1 基础配置
```sh
sudo apt-get update
sudo apt-get install python-pip
sudo pip install shadowsocks
# /etc/shadowsocks.json
{
  "server": VPS_IP,
  "server_port": SSSERVER_PORT,
  "local_address": "127.0.0.1",
  "local_port": 1080,
  "password": SS_PASSWORD,
  "method": "aes-256-cfb",
  "fast_open": true,
  "timeout": 300
}
```
启动
```sh
sudo sslocal -c /etc/shadowsocks.json 
```
异常

 `AttributeError: /usr/lib/x86_64-linux-gnu/libcrypto.so.1.1: undefined symbol: EVP_CIPHER_CTX_cleanup`
```sh
vim /home/user/.local/lib/python3.6/site-packages/shadowsocks/crypto/openssl.py
:%s/cleanup/reset/
:x
```
上述命令执行后，此终端不能关闭，可通过`nohup/setsid`实现后台运行。
#### 3.2.1.2 privoxy配置
privoxy实现将sock5代理映射为http代理
```sh
# 安装privoxy
sudo apt-get install privoxy
# 配置privoxy
sudo chmod 666 /etc/privoxy/config # 只读改可写
vim /etc/privoxy/config
# 5.2节末尾(line 1364)加入 `forward-socks5 / 127.0.0.1:1080 .`
# 重启privoxy服务
sudo /etc/init.d/privoxy restart
#开机自启privoxy服务
systemctl enable privoxy
#查看privoxy服务状态
systemctl status privoxy
```
#### 3.2.1.3 代理配置
1.  终端代理(非必须)
```sh
# /etc/profile or ~/.bashrc
export http_proxy="127.0.0.1:8118"
export https_proxy="127.0.0.1:8118"
export ftp_proxy="127.0.0.1:8118"
source /etc/profile
```
2. 浏览器代理
在浏览器的proxy settings中手动配置如下：firefox为例

| Http Proxy        | 127.0.0.1 | 8118  |
| ------------- |:-------------:| -----:|
| SSL Proxy  | 127.0.0.1 | 8118 |
| ftp Proxy  | 127.0.0.1 | 8118 |
| sockets Proxy| 127.0.0.1 | 8118|
勾选Use this proxy server for all protocols

3. 全局代理
在ubuntu setting->Network->Network proxy,选择Manual，代理配置项与上述浏览器一致。

#### 3.2.1.4 测试
```sh
wget google.com
```
# 3.2.2 安卓
下载[客户端apk](https://github.com/shadowsocks/shadowsocks/wiki/Ports-and-Clients),配置
| 服务器 | 远程端口 | 密码 | 加密方式 | 路由 |
| ----- | ----- | ----- | ----- | ----- |
| `VPS_IP` | `SSSERVER_PORT` | `SS_PASSWORD` | AES-256-CFB | 全局|

# 4 进阶
通过使用[shadowsocks-manager](https://github.com/shadowsocks/shadowsocks-manager)构建多用户管理和流量控制界面,☞[参考](https://blog.makergyt.com/zh-CN/%E7%BD%91%E7%BB%9C%E4%BB%A3%E7%90%86%E8%AE%B0%E5%BD%95(2)/)。

# Reference
<small>
[1] kionf.ShadowSocks启动报错[EB/OL].https://kionf.com/2016/12/15/errornote-ss/. 2016
</small>
