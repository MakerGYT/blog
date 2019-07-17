---
title: redis
lang: en
date: 2019-05-10 11:10:28
tags:
---
#  install
```sh
wget http://download.redis.io/redis-stable.tar.gz
tar xvzf redis-stable.tar.gz
cd redis-stable
make
make test
```
``You need tcl 8.5 or newer in order to run the Redis test``
```sh
sudo apt-get update
sudo apt-get install tcl8.5-dev
```
test
```sh
[exception]: Executing test client: couldn't execute "grep": not enough memory.
```
## start
default port: 6379
```sh
./src/redis-server
./src/redis-cli 
```
or
```sh
sudo cp src/redis-server /usr/local/bin/
sudo cp src/redis-cli /usr/local/bin/
redis-server
redis-cli
// or just 
make install
```
# Remote 