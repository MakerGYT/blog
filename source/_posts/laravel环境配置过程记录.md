---
title: laravel环境配置过程记录
tags:
  - php
  - Laravel
categories: record
date: 2018-12-27 00:03:00
---

## 一、环境配置过程
### 1.开发环境
**基本环境:**

本地主机：[![ubuntu](https://img.shields.io/badge/ubuntu-16.04-orange.svg)](https://www.ubuntu.com//)  (amd64 8G RAM)
<!-- more -->
已安装环境：
[![node](https://img.shields.io/badge/npm-6.4.1-orange.png)](https://nodejs.org/zh-cn/) [![git](https://img.shields.io/badge/git-2.7.4-orange.svg)](https://git-scm.com/)[![sublime](https://img.shields.io/badge/sublime-3176-blue.svg)](http://www.sublimetext.com/)

#### 1.1 一点认识：
开发时会出现本地环境的不确定变数，且一般是唯一的，不利于版本切换。在团队协同中，环境的差异可能导致配合的巨大问题。于是，基于vitual box产生了vagrant,而laravel官方又基于vagrant推出homestead，从而在开发时基于虚拟机工作，本地程序工程映射到虚拟机内，随时可以撤销、共享环境，不会对本地产生影响。这一点认为与python的virtualenv功能类似,也与我《[本地“模拟”一台服务器](https://blog.makergyt.com/2017/11/19/%E6%9C%AC%E5%9C%B0%E2%80%9C%E6%A8%A1%E6%8B%9F%E2%80%9D%E4%B8%80%E5%8F%B0%E6%9C%8D%E5%8A%A1%E5%99%A8/)》中的方式类似。


#### 1.2 homestead的安装过程
根据其依赖关系，需要依次完成vitualbox、vagrant、homestead的安装与配置，由于ubuntu系统基于Debian GNU/Linux，基本可通过deb安装包进行：
- vitualbox:https://www.virtualbox.org/wiki/Downloads
- vagrant:https://releases.hashicorp.com/vagrant/2.2.2/vagrant_2.2.2_x86_64.deb

 刚开始采用大部分教程中的`apt-get`方式，但到后边发现这样安装的版本是1.8.1，与homestead不匹配(require >=2.1.0)，于是采用官方的deb。然后加入laravel的盒子:
```
vagrant box add laravel/homestead
```

- homestead:
```
git clone https://github.com/laravel/homestead.git 
cd ~/Homestead 
git checkout v7.18.0
bash init.sh
```

以上是第一次时采用官方的安装文档，但是由于不可避免的网络问题，更重要的是在并不熟悉laravel的情况下，需要将环境过程尽可能简化与透明，于是采用了适用于国情的 Homestead 安装包：http://download.fsdhub.com/lc-homestead-6.1.1-2018090400.zip 。在回滚上述环境后，重新开始安装：【[参考](https://laravel-china.org/index.php/docs/laravel-development-environment/5.7/development-environment-macos/2901#a3c561)】
```
vagrant box remove laravel/homestead
#完全清理上述环境及文件
wget http://download.fsdhub.com/lc-homestead-6.1.1-2018090400.zip
unzip lc-homestead-6.1.1-2018090400.zip
cd lc-homestead-6.1.1-2018090400
vagrant box add metadata.json
cd ~
git clone https://git.coding.net/summerblue/homestead.git Homestead
cd ~/Homestead
git checkout v7.8.0
bash init.sh
```
#### 1.3 配置homestead.yaml
```
subl ~/Homestead/Homestead.yaml
```
- 虚拟机设置：为了便于在同一局域网下在手机端查看效果，这里在配置IP时选择与内网同一网段的，`ifconfig`查得在192.168.0.104，于是设置为`192.168.0.100`，其他默认.
修改网络设置：
```
sudo vim /Homestead/scripts/homestead.rb
#在第20行改为：
config.vm.network :public_network, ip: settings["ip"] ||= "192.168.0.100"
```

- SSH 秘钥登录：
```
ls -al ~/.ssh
-rw-------  1 makergyt makergyt 1679 Nov 30 23:56 id_rsa
-rw-r--r--  1 makergyt makergyt  406 Nov 30 23:56 id_rsa.pub
#不需要再生成，如没有需ssh-keygen -t rsa -C "email"
```
于是补充 `-  ~/.ssh/id_rsa.pub`到`key`

- 共享文件夹配置
默认后在本地主机上新建code文件夹:
```
cd ~
mkdir code
```

- 站点配置：
```
sites:
    - map: homestead.test
      to: /home/vagrant/Code/Laravel/public
```
在主机内将域名与IP绑定(即同DNS的作用):
```
sudo /etc/hosts
#最后一行追加：
192.168.0.100  homestead.test
```

- 数据库配置：默认，对应的用户名/密码是`homestead/secret`,其实可自行在虚拟机命令行新建

其他均默认

#### 1.4 运行vagrant
```
pwd
/home/makergyt/Homestead
vagrant up
#开始一段时间根据配置文件新建主机
#登录
vagrant ssh
#退出
exit
#关闭homestead(相当于虚拟机关机)
vagrant halt
```
### 2.生产环境

**基本环境**

Aliyun ECS：[![ubuntu](https://img.shields.io/badge/ubuntu-16.04-orange.svg)](https://www.ubuntu.com//)  (amd64 1G RAM 1 core CPU)

已安装环境：
[![node](https://img.shields.io/badge/npm-6.4.1-orange.svg)](https://nodejs.org/zh-cn/) 
[![git](https://img.shields.io/badge/git-2.7.4-orange.svg)](https://git-scm.com/)
#### 2.1 一点认识
生产环境与开发环境相反，需要非常稳定，部署后一般不变更。首先需要lnmp配置，这里采用针对laravel的脚本，速度很快，然后需要完成ssl证书安装，这里采用certbort
#### 2.2 过程
- 密钥连接：
```
# 赋予权限
chmod 400 xxx.pem
# 删除旧信息
ssh-keygen -f "/home/makergyt/.ssh/known_hosts" -R 112.74.41.209
# 连接 
ssh -i /makergyt.pem root@112.74.41.209
```
- 脚本安装：
```
wget -qO- https://raw.githubusercontent.com/summerblue/laravel-ubuntu-init/master/download.sh - | bash
# 完成后
cd laravel-ubuntu-init
./16.04/nginx_add_site.sh
#项目名即工程文件夹名，会在/var/www下新建
```
域名即对应访问此虚拟主机的域名，手头有一台云服务器，一个已经备案的`com`顶级域名,考虑到今后的项目需求，采取解析不同二级域名至同一ECS IP,然后在ECS中新建相应虚拟主机来绑定二级域名。

- ssl证书安装
```
$ sudo apt-get update
$ sudo apt-get install software-properties-common
$ sudo add-apt-repository universe
$ sudo add-apt-repository ppa:certbot/certbot
$ sudo apt-get update
$ sudo apt-get install python-certbot-nginx 
$ sudo certbot --nginx #这里可检测到已经新建的多个主机并同时安装
$ sudo certbot renew --dry-run #日后更新
```
修改nginx配置文件,,开启80(http)强转443(https)：
```
pwd 
/etc/nginx/sites-enabled
sudo vim cloud-doc.conf
```
文件如下：

```
server{
    listen 80;
    server_name cloud-doc.makergyt.com;
    rewrite ^(.*)$ https://${server_name}$1 permanent; 
}
server {
    listen 443;
    server_name cloud-doc.makergyt.com;
    ssl on;
    ssl_certificate   /etc/letsencrypt/live/makergyt.com/fullchain.pem;
    ssl_certificate_key  /etc/letsencrypt/live/makergyt.com/privkey.pem;
    ssl_session_timeout 5m;
    ssl_ciphers ECDHE-RSA-AES128-GCM-SHA256:ECDHE:ECDH:AES:HIGH:!NULL:!aNULL:!MD5:!ADH:!RC4;
    ssl_protocols TLSv1 TLSv1.1 TLSv1.2;
    ssl_prefer_server_ciphers on;
    index index.html index.htm index.php;
    charset utf-8;
    location / {
        root  /var/www/cloud-doc/public;
        try_files $uri $uri/ /index.php?$query_string;
    }
    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }
    access_log /var/log/nginx/cloud-doc.log;
    error_log /var/log/nginx/cloud-doc-error.log error;
    sendfile off;
    client_max_body_size 100m;
    location ~ \.php$ {
        root  /var/www/cloud-doc/public;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass unix:/var/run/php/php7.2-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        fastcgi_param DOCUMENT_ROOT $realpath_root;
        fastcgi_intercept_errors off;
        fastcgi_buffer_size 16k;
        fastcgi_buffers 4 16k;
        fastcgi_connect_timeout 300;
        fastcgi_send_timeout 300;
        fastcgi_read_timeout 300;
    }
    location ~ /\.ht {
        deny all;
    }
}

```

## 二、部署项目
这里部署一个微信小程序项目【[云文档](https://github.com/MakerGYT/cloud-doc)】
### 1. 本地测试
- 新增网站到vagrant主机
在homestead.yaml中新增site:
```
map: cloud-doc.test
      to: /home/vagrant/code/cloud-doc/public
```
在主机`/etc/hosts`后追加：
```
192.168.0.100 cloud-doc.test
```
启动vagrant并登录：
```
vagrant provision
vagrant up
vagrant ssh
```
- 在虚拟主机内完成源码下载，数据库相应工作：
```
git clond https://github.com/SmallRuralDog/cloud-doc-server.git /code/cloud-doc
cd /code/cloudoc
unzip cloud_doc_server.zip
mysql -u root -p
mysql> create database cloudoc; #创建数据库
mysql> create user 'cloud-doc'@'%' identified by 'cloud-doc';  #创建用户
mysql> grant all on cloudoc.* to  'cloud-doc'@'%';  #授权
mysql> flush privileges;
mysql> use cloudoc;
mysql> source cloud_doc_server.sql
```
修改源码，【[参考](https://github.com/SmallRuralDog/cloud-doc-server)】
```
sudo vim /config/database.php
#采用本地，修改app.php,admin.php中url:
'http://cloud-doc.test'
#修改wx.php
```

- 赋予根目录 storage 目录可写权限：
```
chmod -R 777 storage
```
在主机访问cloud-doc.test和同局域网下终端访问192.168.100

### 2.部署上线

将修改后的源码传至服务器
```
scp -r -i makergyt.pem cloud-doc root@112.74.41.209:/var/www
```
在服务器配置数据库、赋予根目录 storage 目录可写权限过程完全一致

### 3.小程序配置
- 下载源码并修改
```
git clone https://github.com/MakerGYT/cloud-doc.git miniprogram
cd miniprogram 
sudo vim app.js
#修改请求域名
const HOST = "https://cloud-doc.makergyt.com";
```
同时将此域名在小程序平台开发设置中更新修改

### 4.测试
小程序可正常通过请求api获取文档信息，但是用户无法登录，经检查，提示错误：
```
Call to undefined function App\Extend\WxApp\mcrypt_module_open()
```
是因为mcrypt_module_open()函数在7.1中被贬低，将在7.2中被移除，要用openssl_decrypt()函数代替，参考https://blog.csdn.net/haibo_j/article/details/80759706 将`app/Extend/WxApp/Prpcrypt.php`中第35~42行修改为：
```
$decrypted = openssl_decrypt($aesCipher, 'AES-256-CBC', $this->key, OPENSSL_RAW_DATA|OPENSSL_ZERO_PADDING, $aesIV);
```
不再报错，但仍无法登录，需进一步检查源码