---
title: 搭建本地服务器记录
date: 2017-11-19 18:33:16
tags:
  - centos
categories: record
description: 仅作记录
---
手头有租用阿里云的centos7的服务器，但目前它的角色既是实验机又是生产环境，感觉这样不太合适，于是产生了下面的需求
{% note info no-icon %}
在本地电脑上通过安装虚拟机，实现模拟与操作远程服务器一样的情形，这样将实验环境和生产环境隔离开，也起到本地验证的作用，提高项目的稳定性和安全性
{% endnote %}
# 1 前言

其实，顾名思义**模拟**操作，跟配置远程的服务器/虚拟主机操作是一模一样的，区别在于网络：
+ 远程服务器是有一个**公网IP**，也就是我们可以从其他联网的IP访问到它
+ 本地虚拟机是使用宿主机的网络，因而它分到的IP地址是一个**内网IP**，也就是说只能通过宿主机访问到。这一点就如同你用手上的设备访问路由器一样。

那么，基于网络的差异，也就决定了需要做以下两点：
1. 设置好虚拟机的网络
2. 改变某些参数使得宿主机能访问到“服务器”

## 1.1 当前环境
+ 系统：`windows 10 pro 1703`
+ 工具：[VMware® Workstation 12 Pro](http://sw.bos.baidu.com/sw-search-sp/software/ca7ad8c6d3103/VMware-workstation-full-14.0.0.24051.exe)
+ 服务器系统:[centos 7.4.1](http://mirrors.aliyun.com/centos/7/isos/x86_64/CentOS-7-x86_64-DVD-1708.iso)
+ 服务器环境：`Apache 2.4.6` \ `php-5.4.16` \ `MariaDB-5.5.56` (`phpmyadmin 4.4.15.10`)

*已测试且仅成功测试以上环境*
## 1.2 名词约定
+ 宿主机：物理机，即本地电脑

# 2 开工
## 2.1 新建虚拟机
在此之前，已经熟悉VMware且[新建](https://www.cnblogs.com/fzng/p/7228284.html?utm_source=itdadao&utm_medium=referral)了一台适合centos64位的虚拟机
这里需要注意两点：
1. 如果跳出不支持虚拟化，请在开机进入BIOS将virtual选项改为enable，具体机型具体百度
2. 选择自定义(高级)：
	+ 安装来源：稍后安装操作系统
	+ 选择客户机操作系统：CentOS 64位
	+ 位置：不要含中文、特殊字符、空格(所有软件安装不出错的基础要求【1】)
	+ 处理器配置、内存、磁盘容量：由于模拟，我设置跟服务器一样的
	+ 网络类型：**使用桥接网络***
	其余基本一路默认

## 2.2 安装操作系统
1. 开启后，两项安装方式都可以，我这里选择第一项，Install CentOS 7
2. 安装语言我选择默认，English，避免乱码字符(所有软件安装不出错的基础要求【2】)
3. 安装信息摘要：
	+ 语言支持把Chinese加上
	+ 基本环境由于是模拟，选择最小安装，从头体验配置的操作(这里没有GUI桌面)
    + 安装位置：分区自动配置
    + 其余按提示或默认
4. 完成后重启以root登陆

## 2.3 配置虚拟机基本

### 2.3.1 开启网络连接

先测试一下网络
```sh
ping -c 5 202.108.22.5 #ping百度的IP，5次
```

CentOS 7.4默认安装好之后是没有自动开启网络连接的，因此需要我们更改配置文件来开启网络
```sh
cd /etc/sysconfig/network-scripts
ls
# ifcfg-enXXX ifdown-cth xxxxxxxx
# 这里会列出该目录下所有脚本，注意第一个ifcfg-enXXX
vi ifcfg-enXXX
···
ONBOOT=yes #这里将no改成yes
```

然后Esc键退出insert模式，`:wq`保存退出，重启网卡：
```sh
service network start
#再次测试
ping -c 5 202.108.22.5 #ping百度的IP，5次
#有ttl回应，Ctrl+C退出`ping`
```
### 2.3.2 安装vim
```sh
yum install vim
# vim是支持命令行内的编辑器，yum 是一种便捷的安装方式，会自动安装依赖项
```
### 2.3.4 升级内核
```sh
# Import the public key:
rpm --import https://www.elrepo.org/RPM-GPG-KEY-elrepo.org
#To install ELRepo for RHEL-7, SL-7 or CentOS-7:
yum install https://www.elrepo.org/elrepo-release-7.0-4.el7.elrepo.noarch.rpm
# Download the kernel
yum install wget
wget https://elrepo.org/linux/kernel/el7/x86_64/RPMS/kernel-ml-5.4.7-1.el7.elrepo.x86_64.rpm # https://elrepo.org/linux/kernel/el7/x86_64/RPMS/
# install
rpm -ivh https://elrepo.org/linux/kernel/el7/x86_64/RPMS/kernel-ml-5.4.7-1.el7.elrepo.x86_64.rpm
# list all grub2
awk -F \' '$1=="menuentry " {print i++ " : " $2}' /etc/grub2.cfg
0 ：
1： 
# modify the default
grub2-set-default '【0】'
# check
grub2-editenv list
reboot
# update kernel headers
wget https://elrepo.org/linux/kernel/el7/x86_64/RPMS/kernel-ml-headers-5.4.7-1.el7.elrepo.x86_64.rpm
rpm -ivh https://elrepo.org/linux/kernel/el7/x86_64/RPMS/kernel-ml-headers-5.4.7-1.el7.elrepo.x86_64.rpm
# update kernel devel
wget https://elrepo.org/linux/kernel/el7/x86_64/RPMS/kernel-ml-devel-5.4.7-1.el7.elrepo.x86_64.rpm
yum install perl
rpm -ivh https://elrepo.org/linux/kernel/el7/x86_64/RPMS/kernel-ml-devel-5.4.7-1.el7.elrepo.x86_64.rpm
```
## 2.4 安装LAMP环境
### 2.4.1 安装Apache
```sh
yum install httpd # Apache的软件包名是httpd，服务名也是
# 启动
systemctl start httpd.service
# 允许开机启动Apache
systemctl enable httpd.service
#检查httpd服务状态
systemctl status httpd.service
#验证：loaded为enables,Active为running
```

#### 2.4.1.1 防火墙开放tcp端口80：
```sh
firewall-cmd --zone=public --add-port=80/tcp --permanent
#重启防火墙
firewall-cmd --reload
#检查配置是否成功：
firewall-cmd --list-all
#验证：ports：80/tcp
```
##### 2.4.1.2 查询当前主机IP:
```sh
ip addr
#形如192.168.xxx 2中找inet第一个地址
```
此时，可在宿主机(你的物理机)浏览器访问该IP，会获取Apache欢迎页面
### 2.4.2 安装php
```sh
yum install php
```
安装完成后，PHP生成三个配置文件
1. `/etc/httpd/conf.d/php.conf` 用于被Apache读取
2. `/etc/httpd/conf.modules.d/10-php.conf` 用于Apache加载LoadModule指定的模块(PHP模块)
3. `/etc/php.ini` php针对生产环境和开发环境自身的配置文件

#### 2.4.2.1 重启Apache
```sh
systemctl restart httpd
```
#### 2.4.2.2 测试Apache正常调用PHP
```sh
vim /var/www/html/phpinfo.php
<?php phpinfo ();?>
```
宿主机浏览器访问http://ip/phpinfo.php,如果正常的话可以看到php的安装信息
### 2.4.3 安装MariaDB

> 从RHEL 7开始Red Hat公司推荐使用MariaDB替换MySQL,基础功能操作一样

```sh
yum install mariadb-server mariadb
```
#### 2.4.3.1 启动
```sh
systemctl start mariadb
systemctl status mariadb
# 验证Active为running
```
#### 2.4.3.2 保护数据库

包括设置数据库的 root 密码、移除测试数据库test、移除匿名用户anonymous等
```sh
mysqlsecureinstallation
#出现提示时自行选择是否移除，这里暂不移除，选择n
```
#### 2.4.3.3 测试数据库

使用 root 账户登录 MariaDB 并用 quit 退出
```sh
mysql -u root -p
Enter password:
MariaDB [(none)]> SHOW VARIABLES;
```
#### 2.4.3.4 允许远程访问
```sql
MariaDB [(none)]> grant all privileges on *.* to root@'%' identified by 'password' with grant option;
#允许任意ip以root身份password访问
MariaDB [(none)]> flush privileges;
#刷新权限
```
测试一下在宿主机上navicat访问，*我测试时一般连接会迟滞，使用ssh连接正常*

### 2.4.4 安装PhpMyAdmin
#### 2.4.4.1 安装库
CentOS 7.4 仓库默认没有提供 PhpMyAdmin 二进制安装包。如果不适应使用 MySQL 命令行来管理你的数据库，可以通过下面的命令启用 [CentOS
 7.4 rpmforge 仓库](http://fedoraproject.org/wiki/EPEL#How_can_I_use_these_extra_packages.3F) 来安装 PhpMyAdmin。
```sh
yum install https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
#最新链接可在The newest version of ‘epel-release’ for EL7找到
yum install phpmyadmin
```
#### 2.4.4.2 配置

配置远程连接，使得能在宿主机上以http://ip/phpmyadmin访问
```sh
vi /etc/httpd/conf.d/phpMyAdmin.conf
<Directory /usr/share/phpMyAdmin/>
   AddDefaultCharset UTF-8

   <IfModule mod_authz_core.c>
     # Apache 2.4
     <RequireAny>
      # Require ip 127.0.0.1  #注释掉
      # Require ip ::1   #注释掉
      Require all granted   #新添加
     </RequireAny>
 </IfModule>
 <IfModule !mod_authz_core.c>
     # Apache 2.2
     Order Deny,Allow
     Deny from All
     Allow from 127.0.0.1
     Allow from ::1
   </IfModule>
</Directory>

<Directory /usr/share/phpMyAdmin/setup/>
   <IfModule mod_authz_core.c>
     # Apache 2.4
     <RequireAny>
      #Require ip 127.0.0.1  #注释掉
      #Require ip ::1   #注释掉
      Require all granted   #新添加
     </RequireAny>
   </IfModule>
   <IfModule !mod_authz_core.c>
     # Apache 2.2
     Order Deny,Allow
     Deny from All
     Allow from 127.0.0.1
     Allow from ::1
   </IfModule>
</Directory>
#保存退出
systemctl restart httpd
```
测试一下并登录http://ip/phpmyadmin
# 3 完工
现在可以使用xshell访问，xftp连接模拟上传下载文件，网站文件放在 /var/www/html下。也就是说开启VM让虚拟机跑起来，然后就可以忽略它是虚拟机的存在。