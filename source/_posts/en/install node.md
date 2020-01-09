---
title: install node
date: 2019-01-06 23:35:38
tags:
 - node
categories: config
---
# 1 Install Node.js via binary archive on Linux64

| system | [ubuntu 16.04](http://releases.ubuntu.com/16.04/ubuntu-16.04.5-desktop-amd64.iso.torrent?_ga=2.96882006.834203655.1547825063-1630968062.1547825063)([vagrant box](https://app.vagrantup.com/ubuntu/boxes/xenial64)) |
|--|--|
| version | [Linux Binaries (x64) v10.15.0(LTS)](https://nodejs.org/dist/v10.15.0/node-v10.15.0-linux-x64.tar.xz) |
<!-- more -->
## 1.1 Unzip the binary archive
```sh
 VERSION=v10.15.0
 DISTRO=linux-x64
 sudo mkdir /usr/local/lib/nodejs
 wget https://nodejs.org/dist/$VERSION/node-$VERSION-$DISTRO.tar.xz
 sudo tar -xJvf node-$VERSION-$DISTRO.tar.xz -C /usr/local/lib/nodejs
 sudo mv /usr/local/lib/nodejs/node-$VERSION-$DISTRO /usr/local/lib/nodejs/node-$VERSION
```
## 1.2 Set the environment variable
```sh
export NODEJS_HOME=/usr/local/lib/nodejs/node-$VERSION/bin
export PATH=$NODEJS_HOME:$PATH
# Refresh profile
. ~/.profile
```
## 1.3 Test installation
```sh
node -v
npm version
npx -v
```
## 1.4 Create a sudo link
```sh
sudo ln -s /usr/local/lib/nodejs/node-$VERSION/bin/node /usr/bin/node
sudo ln -s /usr/local/lib/nodejs/node-$VERSION/bin/npm /usr/bin/npm
sudo ln -s /usr/local/lib/nodejs/node-$VERSION/bin/npx /usr/bin/npx
```

# 2 Installing Node.js via package manager

| system |ubuntu 18.04|
|--|--|
| version |v10.18.0(LTS) |
## 2.1 curl

```sh
curl -sL https://deb.nodesource.com/setup_10.x | sudo -E bash -
sudo apt-get install -y nodejs
```
## 2.2 Manual installation
```sh
# Remove the old PPA if previously used Chris Lea's Node.js PPA.
sudo add-apt-repository -y -r ppa:chris-lea/node.js
sudo rm -f /etc/apt/sources.list.d/chris-lea-node_js-*.list
sudo rm -f /etc/apt/sources.list.d/chris-lea-node_js-*.list.save
# Add the NodeSource package signing key
curl -sSL https://deb.nodesource.com/gpgkey/nodesource.gpg.key | sudo apt-key add -
>gpg: no valid OpenPGP data # cross wall ok
# Add the desired NodeSource repository
VERSION=node_10.x
DISTRO="$(lsb_release -s -c)"
echo "deb https://deb.nodesource.com/$VERSION $DISTRO main" | sudo tee /etc/apt/sources.list.d/nodesource.list
echo "deb-src https://deb.nodesource.com/$VERSION $DISTRO main" | sudo tee -a /etc/apt/sources.list.d/nodesource.list
# Update package lists and install Node.js
sudo apt-get update
sudo apt-get install nodejs
```
# 3 Source
## 3.1 Taobao NPM mirror
```sh
# install cnpm cli
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
![](https://cloud.githubusercontent.com/assets/543405/21505401/fd0b6220-cca1-11e6-86ed-599cc81bb03b.png)
## 3.2 nrm
```sh
sudo npm install -g nrm
nrm ls
nrm use taobao
```
# 4 Change version 
```sh
cnpm install n -g
sudo n stable
```
# 5 Install yarn

| system |ubuntu 18.04|
|--|--|
| version |v1.21.1(stable) |
```sh
# configure the repository:
curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | sudo apt-key add -
echo "deb https://dl.yarnpkg.com/debian/ stable main" | sudo tee /etc/apt/sources.list.d/yarn.list
sudo apt update && sudo apt install yarn
```
# 6. Resolving EACCES permissions errors when installing packages globally
If you see an EACCES error when you try to install a package globally, you can either:
Reinstall npm with a node version manager (recommended)...We strongly recommend using a Node version manager to install Node.js and npm. We do not recommend using a Node installer, since the Node installation process installs npm in a directory with local permissions and can cause permissions errors when you run npm packages globally.Node version managers allow you to install and switch between multiple versions of Node.js and npm on your system so you can test your applications on multiple versions of npm to ensure they work for users on different versions.
```sh
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.35.2/install.sh | bash # cross wall
```
# 7. npm & npx & nvm & nvx & nrm & nvs
- npx: an alternative to running global commands
# Reference

<small>[1] nodesource.Node.js Binary Distributions[EB/OL].https://github.com/nodesource/distributions/blob/master/README.md .2019.</small>
<small>[2] nodejs. How to install Node.js via binary archive on Linux?[EB/OL]. https://github.com/nodejs/help/wiki/Installation .2018.</small>
<small>[3] taobao. 淘宝 NPM 镜像使用说明[EB/OL]. https://npm.taobao.org/ .2014-2016</small>
<small>[4] tj. n – Interactively Manage Your Node.js Versions[EB/OL]. https://www.npmjs.com/package/n .2018.</small>
<small>[5] Yarn.Installation[EB/OL]. https://www.yarnpkg.com/en/docs/install#debian-stable.2018.</small>
<small>[6] npmjs.Resolving EACCES permissions errors when installing packages globally[EB/OL]. https://docs.npmjs.com/resolving-eacces-permissions-errors-when-installing-packages-globally.</small>