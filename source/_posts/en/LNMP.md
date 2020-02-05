---
title: LNMP
date: 2019-01-07 18:24:23
categories: config
tags:
  - nginx
  - php
  - mysql
---

# 1 nginx
传统基于线程提交请求
可扩展的事件异步驱动
反向代理服务器（邮件代理、通用TCP/UDP代理服务器）
<!-- more -->
## 1.1 intall nginx 
### 1.1.1 Prebuilt Packages
#### 1.1.1.1 try
```sh
# can install directly
sudo apt-get install nginx
# install the latest version as follows
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
```
Correct action:
```sh
sudo apt install curl gnupg2 ca-certificates lsb-release
echo "deb http://nginx.org/packages/ubuntu `lsb_release -cs` nginx" \
    | sudo tee /etc/apt/sources.list.d/nginx.list
curl -fsSL https://nginx.org/keys/nginx_signing.key | sudo apt-key add -
sudo apt-key fingerprint ABF5BD827BD9BF62
# pub   rsa2048 2011-08-19 [SC] [expires: 2024-06-14]
#       573B FD6B 3D8F BC64 1079  A6AB ABF5 BD82 7BD9 BF62
# uid   [ unknown] nginx signing key <signing-key@nginx.com>
sudo apt update
sudo apt install nginx
# test
service nginx status
service nginx start # if not run
```
`nginx.service: Can't open PID file /var/run/nginx.pid (yet?) after start: No such file or directory`
Available [install_nginx.sh](https://github.com/MakerGYT/ubuntu-sh/blob/master/install_nginx.sh)
#### 1.1.1.2 uninstall
```sh
sudo service nginx stop
sudo apt-get remove nginx
sudo apt-get --purge remove nginx
sudo apt-get --purge remove nginx-common
sudo apt-get autoremove
# test
sudo service nginx status
which nginx
dpkg --get-selections|grep nginx
```
### 1.1.2 Building from Sources
#### 1.1.2.1 try
```sh
wget https://nginx.org/download/nginx-1.16.0.tar.gz
tar -zxvf nginx-1.16.0.tar.gz
./configure --prefix=/etc/nginx
```
{% note danger %}
./configure: error: the HTTP rewrite module requires the PCRE library.
You can either disable the module by using --without-http_rewrite_module
option, or install the PCRE library into the system, or build the PCRE library
statically from the source with nginx by using --with-pcre=<path> option.
{% endnote%}
```sh
wget wget https://ftp.pcre.org/pub/pcre/pcre2-10.33.tar.gz
tar -zxvf pcre2-10.33.tar.gz
cd nginx-1.16.0
./configure --prefix=/etc/nginx --with-pcre=../pcre2-10.33
```
{% note danger %}
./configure: error: the HTTP gzip module requires the zlib library.
You can either disable the module by using --without-http_gzip_module
option, or install the zlib library into the system, or build the zlib library
statically from the source with nginx by using --with-zlib=<path> option.
{% endnote%}
```sh
wget http://www.zlib.net/zlib-1.2.11.tar.gz
tar -zxvf zlib-1.2.11.tar.gz
cd nginx-1.16.0 && ./configure --prefix=/etc/nginx --with-pcre=../pcre2-10.33 --with-zlib=../zlib-1.2.11
```
{% note info %}
Configuration summary
  + using PCRE library: ../pcre2-10.33
  + OpenSSL library is not used
  + using zlib library: ../zlib-1.2.11
{% endnote%}
```sh
wget https://www.openssl.org/source/openssl-1.1.1b.tar.gz
tar -zxvf openssl-1.1.1b.tar.gz
cd nginx-1.16.0 &&  ./configure --prefix=/etc/nginx --with-pcre=../pcre2-10.33 --with-zlib=../zlib-1.2.11 --with-http_ssl_module --with-openssl=../openssl-1.1.1b # ok
```
{% note danger %}
src/core/ngx_regex.h:15:18: fatal error: pcre.h: No such file or directory
compilation terminated.
objs/Makefile:383: recipe for target 'objs/src/core/nginx.o' failed
make[1]: *** [objs/src/core/nginx.o] Error 1
make[1]: Leaving directory '/root/nginx-1.16.0'
Makefile:8: recipe for target 'build' failed
{% endnote %}
need to install libpcre3-dev_8.x, so pcre 8.x series maybe works,but
{% note info no-icon %}
The older, but still widely deployed PCRE library, originally released in 1997, is at version 8.43. Its API and feature set are stable—future releases will be for bugfixes only. Any new features will be added to PCRE2, and not to the PCRE 8.x series.
{% endnote%}
Change pcre version(8.43) and reinstall,OK
```sh
make install
# test
/etc/sbin/nginx start
```
#### 1.1.2.2 uninstall
```sh
sudo rm -rf /nginx-1.16.0
sudo rm -rf /etc/nginx
```
## 1.2 configure nginx
### 1.2.1 default
```sh
# etc/nginx/nginx.conf
user  nginx;
worker_processes  1;
error_log  /var/log/nginx/error.log warn;
pid        /var/run/nginx.pid;
events {
    worker_connections  1024;
}
http {
    include       /etc/nginx/mime.types;
    default_type  application/octet-stream;
    log_format  main  '$remote_addr - $remote_user [$time_local] "$request" '
                      '$status $body_bytes_sent "$http_referer" '
                      '"$http_user_agent" "$http_x_forwarded_for"';

    access_log  /var/log/nginx/access.log  main;
    sendfile        on;
    #tcp_nopush     on;
    keepalive_timeout  65;
    #gzip  on;
    include /etc/nginx/conf.d/*.conf;
}
# /etc/nginx/conf.d/default.conf
server {
    listen       80;
    server_name  localhost;
    #charset koi8-r;
    #access_log  /var/log/nginx/host.access.log  main;
    location / {
        root   /usr/share/nginx/html;
        index  index.html index.htm;
    }
    #error_page  404              /404.html;
    # redirect server error pages to the static page /50x.html
    #
    error_page   500 502 503 504  /50x.html;
    location = /50x.html {
        root   /usr/share/nginx/html;
    }

    # proxy the PHP scripts to Apache listening on 127.0.0.1:80
    #
    #location ~ \.php$ {
    #    proxy_pass   http://127.0.0.1;
    #}

    # pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
    #
    #location ~ \.php$ {
    #    root           html;
    #    fastcgi_pass   127.0.0.1:9000;
    #    fastcgi_index  index.php;
    #    fastcgi_param  SCRIPT_FILENAME  /scripts$fastcgi_script_name;
    #    include        fastcgi_params;
    #}

    # deny access to .htaccess files, if Apache's document root
    # concurs with nginx's one
    #
    #location ~ /\.ht {
    #    deny  all;
    #}
}
```
### 1.2.2 Setting Up a Simple Proxy Server,8080->80
```sh
# /etc/nginx/conf.d/test.conf
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
### 1.2.3 Setting Up FastCGI Proxying
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

# 2 php
## 2.1 install php
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
## 2.2 configure php
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
## 2.3 configure  nginx to support php
```sh
# nginx.conf
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
## 2.4 test
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

# 3 mysql
>version: `8.0`

```sh
wget https://dev.mysql.com/get/mysql-apt-config_0.8.12-1_all.deb
sudo dpkg -i mysql-apt-config_0.8.12-1_all.deb
sudo apt-get update
sudo apt-get install mysql-server
sudo service mysql status
mysql -u root -p
```

# Reference
<small>
[1] Martin Fjordvald.NGINX CONFIGURATION PRIMER.http://blog.martinfjordvald.com/2010/07/nginx-primer/ [EB/OL] 2010
[2] debian.Nginx.https://wiki.debian.org/Nginx [EB/OL] 2016
</small>