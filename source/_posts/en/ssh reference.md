---
title: ssh reference
date: 2019-01-06 11:16:25
tags: ssh
categories: reference
comments: false
---
# 1 key
```
ssh -i xxx.pem root@ip
```

# 2 ssh

<!-- more -->

## 2.1 local
```sh
ssh-keygen -t rsa
cd ~/.ssh
scp id_rsa.pub root@ip:~/.ssh/id_rsa.pub
```
## 2.2 server
```sh
sudo apt-get install openssd-server
sudo ps -e |grep ssh
sudo apt install net-tools
ifconfig
cd ~/.ssh
cat id_rsa.pub >> authorized_keys
rm id_rsa.pub
```
## 2.3 test
```sh
ssh root@ip
```
