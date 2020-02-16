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

<!-- more -->

# 2 SSH keys
## 2.1 Root Account Uses SSH Key Authentication
```sh
ssh-keygen # default:2048-bit RSA key pair,-t rsa -b 2048
ssh-copy-id root@remote_host # copy the contents of ~/.ssh/id_rsa.pub key into ~/.ssh/authorized_keys.
# or
cat ~/.ssh/id_rsa.pub | ssh root@remote_host "mkdir -p ~/.ssh && touch ~/.ssh/authorized_keys && chmod -R go= ~/.ssh && cat >> ~/.ssh/authorized_keys"
# or
cat ~/.ssh/id_rsa.pub
# public_key_string
ssh root@remote_host
mkdir -p ~/.ssh
echo public_key_string >> ~/.ssh/authorized_keys
chmod -R go= ~/.ssh
chown -R root:root ~/.ssh
```
## 2.2 SSH-key-based authentication for a non-root account with sudo privileges.
```sh
rsync --archive --chown=user:user ~/.ssh /home/user # substitute the 'user' with non-root account
```
## 2.3 Disable Password Authentication
```sh
ssh user@remote_host
sudo nano /etc/ssh/sshd_config
PasswordAuthentication no # Uncomment line 57, set the value to “no”
sudo systemctl restart ssh
```