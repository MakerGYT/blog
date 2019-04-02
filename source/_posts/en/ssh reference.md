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
```
ssh-keygen -t rsa
cd ~/.ssh
scp id_rsa.pub root@ip:~/.ssh/id_rsa.pub
```
## 2.2 server
```
cd ~/.ssh
cat id_rsa.pub >> authorized_keys
rm id_rsa.pub
```
## 2.3 test
```
ssh root@ip
```
