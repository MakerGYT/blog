---
title: how-to-create-an-operating-system 操作问题记录
date: 2019-01-08 17:49:57
tags: 
- linux
---
原文档：
>https://samypesse.gitbooks.io/how-to-create-an-operating-system

本地系统环境：ubuntu 16.04
软件环境：vagrant 2.2.2,vitual box 6.0
### the box url is invalid
<!-- more -->
查找类似的box:
https://app.vagrantup.com/boxes/search?utf8=%E2%9C%93&sort=downloads&provider=&q=lucid32
```sh
vagrant init mrgcastle/ubuntu-lucid32 \
  --box-version 1.0.0.0
vagrant login #need to create a account at vagrantup.com
```
登录错误提示无法解析127.0.0.1:8118,此URL是由于本地使用了ss代理,故暂时关闭privoxy并且在/etc/profile中取消代理，重启生效
```
sudo vim Vagrantfile
# append
$script = %Q{
    sudo apt-get update
    sudo apt-get install nasm make build-essential grub qemu zip -y
  }
config.vm.provision :shell, :inline => $script
```
### "-y"  error ,force to yes
初始化脚本未执行，故开机后依次手动执行
```sh
sudo apt-get update
```
Error ``http://security.ubuntu.com lucid-security/main Packages
  404  Not Found [IP: 91.189.91.23 80]``
Warning ``Failed to fetch http://us.archive.ubuntu.com/ubuntu/dists/lucid/restricted/binary-i386/Packages.gz  404  Not Found [IP: 91.189.91.23 80]``

#### mannul install unzip (latest)
```
sudo apt-get install zip
```
``Failed to fetch http://security.ubuntu.com/ubuntu/pool/main/u/unzip/unzip_6.0-1ubuntu1_i386.deb``
open the url:http://security.ubuntu.com/ubuntu/pool/main/u/unzip/,find the oldest version orresponding to architecture
```
dpkg --print-architecture 
i386
wget http://security.ubuntu.com/ubuntu/pool/main/u/unzip/unzip_6.0-21ubuntu1_i386.deb
dpkg -i unzip_6.0-21ubuntu1_i386.deb
```
``file `unzip_6.0-21ubuntu1_i386.deb' contains ununderstood data member data.tar.xz     , giving up``
```
wget http://security.ubuntu.com/ubuntu/pool/main/u/unzip/unzip_6.0-4ubuntu1_i386.deb
dpkg -i unzip_6.0-4ubuntu1_i386.deb
```
#### install zip
```
wget http://us.archive.ubuntu.com/ubuntu/pool/main/z/zip/zip_3.0-4_i386.deb
sudo dpkg -i zip_3.0-4_i386.deb
zip -v
```
#### install nasm,(make,build-essential is already installed)
grub,qemu:``Errors were encountered while processing``
#### modify apt-get
以上寻找版本手动安装没有根本解决问题，问题在于采用的默认apt源上地址已经没有此版本的所有资源包，故需先找到现在的托管地址，于是沿着上述手动地址
```
sudo cp /etc/apt/sources.list /etc/apt/sources.list_backup
sudo vim /etc/apt/sources.list
:%s/http:\/\/security.ubuntu.com\/ubuntu/http:\/\/old-releases.ubuntu.com\/ubuntu/g
:%s/http:\/\/us.archive.ubuntu.com\/ubuntu/http:\/\/old-releases.ubuntu.com\/ubuntu/g
sudo apt-get update
sudo apt-get install grub
```
``grub: Conflicts: grub-pc but 1.98-1ubuntu13 is to be installed``
``grub-installer: Depends: cdebconf-udeb but it is not installable``
``grub-pc: Conflicts: grub (< 0.97-54) but 0.97-29ubuntu60.10.04.2 is to be installed``
```
sudo apt-get -f install
sudo apt-get autoremove
grub --version
sudo apt-get install qemu
qemu --version
```
### bootdisk/* no such file or directory
此文件夹是启动文件，需要在其github上下载，由于在虚拟机内部使用git clone无法连接（暂未找出原因）故设置同步文件夹后从本地git
```sh
#config the Vagrantfile:
config.vm.synced_folder "/home/jerry/unix", "/home/vagrant"
# vagrant --provision reload
cd unix
git clone https://github.com/SamyPesse/How-to-Make-a-Computer-Operating-System.git
cd How-to-Make-a-Computer-Operating-System/src/sdk 
```
### 系统挂载后无法操作无法退出
只显示加载过程正确，以及hello world例程，由于作者未写完，未能展示操作系统可操作性和基本运行调度的实现效果。

