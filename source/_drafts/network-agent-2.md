---
title: 网络代理初探记录(2)
date: 2020-2-3 17:30:30
tags:
    - shadowsocks
categories: record
description: 搭建代理服务器管理平台
---
{% note info %}
A fast tunnel proxy that helps you bypass firewalls.
{% endnote%}
# 0 准备
```sh
apt update
apt install build-essential
```
## 0.1 Node.js 10.*
```sh
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.35.2/install.sh | bash
# ~/.profile
export NVM_DIR="$HOME/.nvm"
[ -s "$NVM_DIR/nvm.sh" ] && \. "$NVM_DIR/nvm.sh"  # This loads nvm
[ -s "$NVM_DIR/bash_completion" ] && \. "$NVM_DIR/bash_completion"  # This loads nvm bash_completion
```
## 0.2 python-pip
`DEPRECATION: Python 2.7 reached the end of its life on January 1st, 2020. Please upgrade your Python as Python 2.7 is no longer maintained. A future version of pip will drop support for Python 2.7.`
```sh
# 查看可用版本
ls /usr/bin/python*
# 更改默认版本为3.6
update-alternatives --install /usr/bin/python python /usr/bin/python2.7   1
update-alternatives --install /usr/bin/python python /usr/bin/python3.6   2
# install
apt install python3-venv python3-pip
# upgrade pip
pip install -U pip
# install setuptools
pip install setuptools
```
## 0.3 Nginx
```sh
wget http://nginx.org/keys/nginx_signing.key
sudo apt-key add nginx_signing.key
sudo apt-get update # OK
# install
sudo apt-get install nginx
# test
service nginx status
service nginx start # if not run
```
## 0.4 Certbot
```sh
sudo apt-get update
sudo apt-get install software-properties-common
sudo add-apt-repository universe
sudo add-apt-repository ppa:certbot/certbot
sudo apt-get update
sudo apt-get install certbot python-certbot-nginx 
sudo certbot certonly -d *.makergyt.com --manual --preferred-challenges dns --server https://acme-v02.api.letsencrypt.org/directory
```
## 0.5 redis
```sh
wget http://download.redis.io/releases/redis-5.0.7.tar.gz
tar xzf redis-5.0.7.tar.gz
cd redis-5.0.7
make
# /etc/sysctl.conf
vm.overcommit_memory=1
sysctl vm.overcommit_memory=1
```
## 0.6 定义
- SHADOWSOCKS_PORT: 节点manager API端口
- NODE_IP: 节点IP
- NODE_PORT: 节点响应端口
- NODE_PASSWD: 节点连接密码
- SITE_DOMAIN: 网站域名
- SITE_PORT: 网站端口
- SITE_FREE_PORT: 免费账号的网站端口
- SITE_FREE_DOMAIN: 免费账号的网站域名

# 1 安装
## 1.1 shadowsocks-server
### 1.1.1 shadowsocks-libev
```sh
sudo add-apt-repository ppa:max-c-lv/shadowsocks-libev -y
```
`E: The repository 'http://ppa.launchpad.net/max-c-lv/shadowsocks-libev/ubuntu bionic Release' does not have a Release file.`
### 1.1.2 shadowsocks-python
```sh
pip install shadowsocks
```
 `AttributeError: /usr/lib/x86_64-linux-gnu/libcrypto.so.1.1: undefined symbol: EVP_CIPHER_CTX_cleanup`
```sh
# /usr/local/lib/python3.6/dist-packages/shadowsocks/crypto/openssl.py
libcrypto.EVP_CIPHER_CTX_cleanup.argtypes = (c_void_p,) => libcrypto.EVP_CIPHER_CTX_reset.argtypes = (c_void_p,) # line 52
libcrypto.EVP_CIPHER_CTX_cleanup(self._ctx) => libcrypto.EVP_CIPHER_CTX_reset(self._ctx) # line 111
```
## 1.2 shadowsocks-manager
```sh
npm i -g shadowsocks-manager --unsafe-perm
```
# 2 配置
## 2.1 ssmgr
```sh
mkdir ~/.ssmgr
# ~/.ssmgr/ssmgr.yml
type: s

shadowsocks:
  address: 127.0.0.1:SHADOWSOCKS_PORT
manager:
  address: NODE_IP:NODE_PORT
  password: NODE_PASSWD
db: 'ssmgr.sqlite'
```
## 2.2 插件
### 2.2.1 webgui
```sh
# ~/.ssmgr/webgui.yml
type: m

manager:
  address: NODE_IP:NODE_PORT
  password: NODE_PASSWD

plugins:
  flowSaver:
    use: true
  user:
    use: true
  account:
    use: true
  macAccount:
    use: true
  group:
    use: true
  email:
    use: true
    type: 'smtp'
    username: ''
    password: ''
    host: 'smtp.qq.com'
  webgui:
    use: true
    host: '127.0.0.1'
    port: SITE_PORT
    site: SITE_DOMAIN
    # admin_username: 'youremail@address.com'
    # admin_password: '35710935109364'
    # icon: 'icon.png'
    # skin: 'default'
    # language: 'en-US'
    # googleAnalytics: 'UA-xxxxxxxx-x'
    # gcmSenderId: '476902381496'
    # gcmAPIKey: 'AAAAGzddLRc:XXXXXXXXXXXXXX'
    # google_login_client_id: '724695589056-p78tu8738t4fjel56yhe34qq34gjufsi.apps.googleusercontent.com'
    # google_login_client_secret: 'TjUd36YnQ-YUI2uUtQa_43Tl'
    # facebook_login_client_id: '9825686749820123'
    # facebook_login_client_secret: 'a46c6bb6f8281c23d2b74b43008c9c46'
    # github_login_client_id: '7c45c34c1de3ef937d37'
    # github_login_client_secret: 'd2768efe5258cfb9ce4da11ed7ddc334bc65756b'
    # twitter_login_consumer_key: 'tKPH3RViDT68PtHBMHYJuQ'
    # twitter_login_consumer_secret: 'wYCtWdUSEfm8H3ES0r5rgHKeqGvYGiFDrGj4THiq3T6'
  # alipay:
  #   use: true
  #   appid: 2015012104922471
  #   notifyUrl: 'http://yourwebsite.com/api/user/alipay/callback'
  #   merchantPrivateKey: 'xxxxxxxxxxxx'
  #   alipayPublicKey: 'xxxxxxxxxxx'
  #   gatewayUrl: 'https://openapi.alipay.com/gateway.do'
  # webgui_telegram:
  #   use: true
  #   token: '191374681:AAw6oaVPR4nnY7T4CtW78QX-Xy2Q5WD3wmZ'
  # paypal:
  #   use: true
  #   mode: 'live' # sandbox or live
  #   client_id: 'At9xcGd1t5L6OrICKNnp2g9'
  #   client_secret: 'EP40s6pQAZmqp_G_nrU9kKY4XaZph'

db: 'webgui.sqlite'
```
### 2.2.2 freeAccount
```sh
# ~/.ssmgr/free.yml
type: m
manager:
  address: SHADOWSOCKS_IP:MANAGER_PORT
  password: MANAGER_PASSWD
plugins:
  freeAccount:
    use: true
    port: SITE_FREE_PORT
    # port value can be a range: '1000-2000,2003,2005-2009'
    flow: 500000000
    time: 3600000
    address: SITE_FREE_DOMAIN
    method: 'aes-256-cfb'
    listen: '0.0.0.0:SITE_PORT'
db: 'free.sqlite'
```
### 2.2.3 nginx
```sh
# /etc/nginx/conf.d/free.vpn.conf
ssl_session_cache    shared:SSL:10m;
ssl_session_timeout  10m;

server{
    listen 80;
    server_name free.vpn.makergyt.com;
    rewrite ^(.*)$ https://${server_name}$1 permanent;
}
server {
    listen               443 ssl;
    server_name          free.vpn.makergyt.com;
    keepalive_timeout    70;

    ssl_certificate     /etc/letsencrypt/live/vpn.makergyt.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/vpn.makergyt.com/privkey.pem;
    ssl_protocols       TLSv1 TLSv1.1 TLSv1.2;
    ssl_ciphers         HIGH:!aNULL:!MD5;

    location / {
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header Host  $http_host;
        proxy_set_header X-Nginx-Proxy true;
        proxy_set_header Connection "";
        proxy_pass      http://127.0.0.1:81;
    }
}
```
## 3 启动
## 3.1 脚本
```sh
# 节点
ssserver -m aes-256-cfb -p 12345 -k abcedf --manager-address 127.0.0.1:SHADOWSOCKS_PORT
ssmgr -c ~/.ssmgr/ssmgr.yml &
# webgui
./redis-5.0.7/src/redis-server
ssmgr -c ~/.ssmgr/webgui.yml &
```
```sh
ssmgr -c ~/.ssmgr/ssmgr.yml -r python
~/redis-5.0.7/src/redis-server
ssmgr -c ~/.ssmgr/webgui.yml
```
### 3.2 守护进程
```sh
npm i -g pm2
pm2 start 
```
# 4 总结
VPS无法连接，只能通过控制台的web console连接，经测试，在本地区，该VPS已经无法访问。收到答复是
>Our testing to date indicates this is an issue at the regional ISP level, which is 100% outside of our control.

那么，这种方案已经失去了意义。

# 参考
<small>
[1] renzhi.多用户管理面板 ss-manager 安装教程[EB/OL].https://roov.org/2017/09/ss-manager/. 2017.
</small>