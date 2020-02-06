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
# pre:Access remote host using whichever method which is available.eg,web console
su passwd # modify root's password
su root
# Install ssh
apt-get install openssd-server
ps -e |grep ssh
apt install net-tools
ifconfig
# /etc/ssh/sshd_config
PermitRootLogin yes # Uncomment line 32,set the value to “yes”
# Creating a New User with Administrative Privileges
adduser user # substitute the 'user' with non-root account
usermod -aG sudo user
# Setting Up a Basic Firewall
sudo ufw app list
sudo ufw allow OpenSSH
sudo ufw enable # Y
sudo ufw allow proto tcp from any to any port 80,443
sudo ufw status
```
```sh
dpkg --print-architecture 
```