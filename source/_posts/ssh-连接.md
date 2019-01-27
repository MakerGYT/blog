---
title: ssh 连接
date: 2019-01-06 11:16:25
tags:
---
## 密钥对
```
ssh -i xxx.pem root@ip
```
## ssh
本地
```
ssh-keygen -t rsa
cd ~/.ssh
scp id_rsa.pub root@ip:~/.ssh/id_rsa.pub
```
<!-- more -->
服务器
```
cd ~/.ssh
cat id_rsa.pub >> authorized_keys
rm id_rsa.pub
```
测试
```
ssh root@ip
```
开发环境local homestead 
- 目录：~/code

测试环境vagrant vhost
- 协议http
- 目录 /var/www

生产环境aliyun test.makergyt.com 
- 协议https
- 目录 /var/www
生产环境与开发环境除https保持严格一致
只在测试环境修改并同步coding
开发环境内部git push到coding->测试环境git clone->生产环境git clone coding
调试生产环境使用webhook同步测试环境
生产环境顺利调通->git push到github，部署固定环境并从github git clone
