---
title: ubuntu reference
lang: en
date: 2019-04-05 09:41:28
tags:
  - linux
categories: reference
---
``This requires installing packages from unauthenticated sources.``
```sh
sudo apt-get install debian-archive-keyring
wget -qO - http://deb.opera.com/archive.key | sudo apt-key add -
sudo apt-get update
sudo apt-get install opera
```