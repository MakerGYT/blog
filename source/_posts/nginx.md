---
title: nginx
date: 2019-01-07 18:24:23
tags:
  - 配置
  - php
---
传统基于线程提交请求
可扩展的事件异步驱动
反向代理服务器（邮件代理、通用TCP/UDP代理服务器）
<!-- more -->
### intall nginx 
```sh
sudo vim /etc/apt/sources.list
# append to the end
deb http://nginx.org/packages/ubuntu/ xenial nginx
deb-src http://nginx.org/packages/ubuntu/ xenial nginx
# update sources
sudo apt-get update
```
``W: GPG error: http://nginx.org/packages/ubuntu xenial InRelease: The following signatures couldn't be verified because the public key is not available: NO_PUBKEY ABF5BD827BD9BF62``

```sh
# refer:https://www.nginx.com/resources/wiki/start/topics/tutorials/install/
sudo apt-key adv --keyserver keyserver.ubuntu.com --recv-keys $key
sudo apt-get update # Warning again
# browser and copy the key via http://nginx.org/keys/nginx_signing.key
sudo vim nginx_signing.key # paste the key
sudo apt-key add nginx_signing.key
sudo apt-get update # OK
# install
sudo apt-get install nginx
```
### configure nginx
#### Setting Up a Simple Proxy Server,8080->80
```sh
sudo vim /etc/nginx/nginx.conf
# comment the http block
# add 
http {
    server {
        listen 80;
        location / {
            proxy_pass http://localhost:8080/;
        }
        location ~ \.(gif|jpg|png)$ {
            root /data/images;
        }
    }
    server {
        listen 8080;
        root /data/up1;
        location / {
        }
    }
}
```
new a html
```sh
cd /data/up1
vim index.html
```
```
sudo nginx -t
sudo nginx -s reload 
```
access content correctly through intranet IP
#### Setting Up FastCGI Proxying
```
cat /etc/nginx/nginx.conf
user  nginx;
worker_processes  1;

error_log  /var/log/nginx/error.log warn;
pid        /var/run/nginx.pid;

http {
    server {
        location / {
            fastcgi_pass  localhost:9000;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            fastcgi_param QUERY_STRING    $query_string;
        }
        location ~ \.(gif|jpg|png)$ {
            root /data/images;
        }
    }
}

events {
    worker_connections  1024;
}
```
### install php
```sh
# 1.Obtain and unpack the PHP source:
wget http://cn.php.net/distributions/php-7.2.13.tar.gz
tar zxf php*
# 2.Configure and build PHP.
cd php*
./configure --enable-fpm --with-mysqli
```
``checking for cc... no
checking for gcc... no
configure: error: in `/home/vagrant/php-7.2.13':
configure: error: no acceptable C compiler found in $PATH``
```sh
wget https://mirrors.ustc.edu.cn/gnu/gcc/gcc-8.2.0/gcc-8.2.0.tar.gz 
# need to take more steps in the official way above and try again another day.
sudo apt-get install gcc # Not necessarily up-to-date
./configure --enable-fpm --with-mysqli
```
``configure: error: libxml2 not found. Please check your libxml2 installation.``
```sh
sudo apt-get install libxml2 # do not work
# If you want to compile software from source based on libxml2 you need the development files:
sudo apt-get install libxml2-dev # OK
sudo apt-get install make
make -v
make
sudo make test
```
FAILED TEST SUMMARY
Timeout within function [tests/basic/timeout_variation_1.phpt]
Timeout within shutdown function, variation [tests/basic/timeout_variation_10.phpt]
Timeout within eval [tests/basic/timeout_variation_3.phpt]
Timeout within call_user_func [tests/basic/timeout_variation_4.phpt]
Timeout within function containing exception [tests/basic/timeout_variation_5.phpt]
Timeout within shutdown function [tests/basic/timeout_variation_9.phpt]
Timeout again inside register_shutdown_function [tests/lang/045.phpt]

```sh
sudo make install
Installing shared extensions:     /usr/local/lib/php/extensions/no-debug-non-zts-20170718/
Installing PHP CLI binary:        /usr/local/bin/
Installing PHP CLI man page:      /usr/local/php/man/man1/
Installing PHP FPM binary:        /usr/local/sbin/
Installing PHP FPM defconfig:     /usr/local/etc/
Installing PHP FPM man page:      /usr/local/php/man/man8/
Installing PHP FPM status page:   /usr/local/php/php/fpm/
Installing phpdbg binary:         /usr/local/bin/
Installing phpdbg man page:       /usr/local/php/man/man1/
Installing PHP CGI binary:        /usr/local/bin/
Installing PHP CGI man page:      /usr/local/php/man/man1/
Installing build environment:     /usr/local/lib/php/build/
Installing header files:          /usr/local/include/php/
Installing helper programs:       /usr/local/bin/
  program: phpize
  program: php-config
Installing man pages:             /usr/local/php/man/man1/
  page: phpize.1
  page: php-config.1
Installing PEAR environment:      /usr/local/lib/php/
Installing PDO headers:           /usr/local/include/php/ext/pdo/
```
You may want to add: /usr/local/lib/php to your php.ini include_path
### configure php
```sh
# 3.Obtain and move configuration files to their correct locations
sudo cp php.ini-development /usr/local/php/php.ini
sudo cp /usr/local/etc/php-fpm.conf.default /usr/local/etc/php-fpm.conf
sudo cp sapi/fpm/php-fpm /usr/local/bin
# 4.prevent arbitrarily script injection
sudo vim /usr/local/php/php.ini
cgi.fix_pathinfo=0 # line 769
# 5.php-fpm.conf
sudo vim /usr/local/etc/php-fpm.conf
# append in the end
; Unix user/group of processes
; Note: The user is mandatory. If the group is not set, the default user's group
;       will be used.
user = www-data
group = www-data
```
```sh
# start php-fpm
/usr/local/bin/php-fpm
```
``ERROR: Unable to globalize '/usr/local/NONE/etc/php-fpm.d/*.conf' (ret=2) from /usr/local/etc/php-fpm.conf at line 125.``
The official error here should be changed to:
```sh
cd /usr/local/etc
sudo vim php-fpm.conf
# modify in the end
include=/usr/local/etc/php-fpm.d/*.conf
# sudo cp php-fpm.d/www.conf.default php-fpm.d/www.conf
sudo vim php-fpm.d/www.conf
# line 23
user = www-data
group = www-data
```
```sh
sudo /usr/local/bin/php-fpm # OK
```
### configure  nginx to support php
```
# 6.nginx.conf
sudo vim /etc/nginx/nginx.conf
http {
    server {
        listen 80;
        server_name learn.lea;
        location / {
            root /data/www;
            index index.php index.html index.htm;
        }
        location ~* \.php$ {
            fastcgi_index index.php;
            fastcgi_pass  127.0.0.1:9000;
            include       fastcgi_params;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            fastcgi_param SCRIPT_NAME     $fastcgi_script_name;
        }
        location ~ \.(gif|jpg|png)$ {
            root /data/images;
        }
    }
}

events {
    worker_connections  1024;
}
```
### test
```sh
sudo echo "<?php phpinfo(); ?>" >> /usr/local/nginx/html/index.php
# navigate to http://learn.lea
```
``File not found``
```sh
sudo vim /etc/nginx/nginx.conf
# add "root /data/www" directive to PHP location block
sudo nginx -s reload # OK
```
restart the machine:

``nginx start automaticlly``
``php-fpm need to start``





