---
title: git reference
date: 2019-01-06 11:22:38
tags: git
categories: reference
description: only for reference
---

## upload


```bash
git init
git add .
git commit -m "message"
git remote add origin https://github.com/user/repo.git
git push -u origin master
```
## connect github with no password
```bash
git config --global user.name "makergyt"
git config --global user.email "me@makergyt.com"
# test
git config --list
user.email=me@makergyt.com
user.name=makergyt
```
### ssh
```sh
git remote add origin git@github.com:user/repo.git
cd ~/.ssh
ssh-keygen -t rsa -C "me@makergyt.com"
cat id_rsa.pub # paste to https://github.com/settings/keys
# test
ssh -T git@github.com
Hi MakerGYT! You've successfully authenticated, but GitHub does not provide shell access
```

### https
```sh
git remote add origin https://github.com/user/repo.git
touch ~/.git-credentials
vim ~/.git-credentials
https://username:password@github.com
git config --global credential.helper store
cat ~/.gitconfig
[credential]
    helper = store
```


## Coding Webhook deploy
```bash
ssh-keygen -t rsa -C "me@makergyt.com" #git公钥
mkdir /var/www/.ssh
chown -R www-data:www-data /var/www/.ssh/
sudo -Hu www-data ssh-keygen -t rsa #部署公钥
cd /var/www/test
mkdir hook
chown -R www-data:www-data /var/www/test/hook
```

## branch management
```sh
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
# rename branch
git branch -m old_branch new_branch # Rename branch locally 
git push origin :old_branch # Delete the old branch 
git push --set-upstream origin new_branch # Push the new branch, set local branch to track the new remote
```
## github floder is grey,can not open
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
## force update local branch
```sh
git fetch --all
git reset --hard origin/master
git fetch
```
## proxy

```git
git config --global http.proxy
git config --global --unset http.proxy
```
### import to another git site
```sh
git clone urlPrevious --bare
git remote add name urlNow
git push name --all
git push name --tags
```