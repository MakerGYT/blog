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
## 上传项目
```bash
git init
git add .
git commit -m "message"
git remote add origin https://github.com/user/repo.git
git push -u origin master
```
## 免密连接github
```bash
git config --global user.name "makergyt"
git config --global user.email "me@makergyt.com"
# test
git config --list
user.email=me@makergyt.com
user.name=makergyt
```
### ssh
```bash
git remote add origin git@github.com:user/repo.git
cd ~/.ssh
ssh-keygen -t rsa -C "me@makergyt.com"
cat id_rsa.pub # paste to https://github.com/settings/keys
# test
ssh -T git@github.com
Hi MakerGYT! You've successfully authenticated, but GitHub does not provide shell access
```

### https
```bash
git remote add origin https://github.com/user/repo.git
touch ~/.git-credentials
vim ~/.git-credentials
https://username:password@github.com
git config --global credential.helper store
cat ~/.gitconfig
[credential]
    helper = store
```


## Coding Webhook 自动部署Git项目
```bash
ssh-keygen -t rsa -C "me@makergyt.com" #git公钥
mkdir /var/www/.ssh
chown -R www-data:www-data /var/www/.ssh/
sudo -Hu www-data ssh-keygen -t rsa #部署公钥
cd /var/www/test
mkdir hook
chown -R www-data:www-data /var/www/test/hook
```

## 分支管理
```bash
# view branch
git branch
*master # default
# setup local branch
git branch local
# test
*master
local
# publish branch
git push origin local:local
# change branch
git checkout local
# merge branch
git merge master
# delete remote branch
git push origin :master
```
## github文件夹图标为灰色，打不开文件夹
```bash
# enter the grey folder
ll -a
.git # delete the folder
cd ..
git rm -r  --cached folder
git add .
git commit -m "remove the cache"
git push origin master
```
## 强制更新本地分支
```sh
git fetch --all
git reset --hard origin/master
git fetch
```



```

