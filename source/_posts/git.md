---
title: git
date: 2019-01-06 11:22:38
tags:
---
https://coding.net/help/doc/git/ssh-key.html
```
cd ~/.ssh
ssh-keygen -t rsa -C "me@makergyt.com"
cat id_rsa.pub #复制到https://dev.tencent.com/user/account/setting/keys
ssh -T git@coding.net
```
<!-- more -->
## Coding Webhook 自动部署Git项目
```
ssh-keygen -t rsa -C "me@makergyt.com" #git公钥
mkdir /var/www/.ssh
chown -R www-data:www-data /var/www/.ssh/
sudo -Hu www-data ssh-keygen -t rsa #部署公钥
cd /var/www/test
mkdir hook
chown -R www-data:www-data /var/www/test/hook
```
git恢复文件文件夹
```
git checkout file/folder
```
