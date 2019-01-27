---
title: 绕不过去的node
date: 2019-01-06 23:35:38
tags:
- node
- 配置
---
## Install Node.js via binary archive on Linux64

| system | [ubuntu 16.04](http://releases.ubuntu.com/16.04/ubuntu-16.04.5-desktop-amd64.iso.torrent?_ga=2.96882006.834203655.1547825063-1630968062.1547825063)([vagrant box](https://app.vagrantup.com/ubuntu/boxes/xenial64)) |
|--|--|
| version | [Linux Binaries (x64) v10.15.0(LTS)](https://nodejs.org/dist/v10.15.0/node-v10.15.0-linux-x64.tar.xz) |
<!-- more -->
### Unzip the binary archive
```sh
 VERSION=v10.15.0
 DISTRO=linux-x64
 sudo mkdir /usr/local/lib/nodejs
 wget https://nodejs.org/dist/$VERSION/node-$VERSION-$DISTRO.tar.xz
 sudo tar -xJvf node-$VERSION-$DISTRO.tar.xz -C /usr/local/lib/nodejs
 sudo mv /usr/local/lib/nodejs/node-$VERSION-$DISTRO /usr/local/lib/nodejs/node-$VERSION
```
### Set the environment variable
```sh
export NODEJS_HOME=/usr/local/lib/nodejs/node-$VERSION/bin
export PATH=$NODEJS_HOME:$PATH
```
### Refresh profile
```sh
. ~/.profile
```
### Test installation
```sh
node -v
npm version
npx -v
```
### Create a sudo link
```sh
sudo ln -s /usr/local/lib/nodejs/node-$VERSION/bin/node /usr/bin/node
sudo ln -s /usr/local/lib/nodejs/node-$VERSION/bin/npm /usr/bin/npm
sudo ln -s /usr/local/lib/nodejs/node-$VERSION/bin/npx /usr/bin/npx
```

## Installing Node.js via package manager
| system | [ubuntu 16.04](http://releases.ubuntu.com/16.04/ubuntu-16.04.5-desktop-amd64.iso.torrent?_ga=2.96882006.834203655.1547825063-1630968062.1547825063)([vagrant box](https://app.vagrantup.com/ubuntu/boxes/xenial64)) |
|--|--|
| version | [v10.15.0(LTS)](https://nodejs.org/dist/v10.15.0/node-v10.15.0-linux-x64.tar.xz) |
```sh
curl -sL https://deb.nodesource.com/setup_10.x | sudo -E bash -
sudo apt-get install -y nodejs
```
## Cnpm
```sh
npm install -g cnpm --registry=https://registry.npm.taobao.org
cnpm version
```
CNPM command fails after shutdown and restart，so
```sh
alias cnpm="npm --registry=https://registry.npm.taobao.org \
--cache=$HOME/.npm/.cache/cnpm \
--disturl=https://npm.taobao.org/dist \
--userconfig=$HOME/.cnpmrc"
# OK
```
## Change version 
```
cnpm install n -g
sudo n stable
```
## Reference

<small>[1] nodesource.Node.js Binary Distributions[EB/OL].https://github.com/nodesource/distributions/blob/master/README.md .2019.</small>
<small>[2] nodejs. How to install Node.js via binary archive on Linux?[EB/OL]. https://github.com/nodejs/help/wiki/Installation .2018.</small>
<small>[3] taobao. 淘宝 NPM 镜像使用说明[EB/OL]. https://npm.taobao.org/ .2014-2016</small>
<small>[4] tj. n – Interactively Manage Your Node.js Versions[EB/OL]. https://www.npmjs.com/package/n .2018.</small>    

