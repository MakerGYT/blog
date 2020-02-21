---
title: mysql reset password 
date: 2019/3/31 20:46:25
categories: record
tags: mysql
---
[1]https://dev.mysql.com/doc/refman/5.7/en/resetting-permissions.html

```sh
kill `cat /var/run/mysqld/mysqld.pid`
vim mysql-init
# /home/laravel-ubuntu-init/mysql-init
ALTER USER 'root'@'localhost' IDENTIFIED BY '';
#SET PASSWORD FOR 'root'@'localhost' = PASSWORD('');
mysqld --init-file=/home/laravel-ubuntu-init/mysql-init &
[1] 13651
service mysql start
mysql -u root -p
ERROR 1045 (28000): Access denied for user 'root'@'localhost' (using password: YES)
```

[2]https://stackoverflow.com/questions/4258124/how-to-reset-mysql-root-password

```sh
service mysql stop
mysqld --skip-grant-tables --skip-networking
mysql
ERROR 2002 (HY000): Can't connect to local MySQL server through socket '/var/run/mysqld/mysqld.sock' (2)
```

[3]https://support.rackspace.com/how-to/mysql-resetting-a-lost-mysql-root-password/

```sh
/etc/init.d/mysql stop
mysqld_safe --skip-grant-tables &
mysqld_safe Directory '/var/run/mysqld' for UNIX socket file don't exists.
mysql -u root
ERROR 2002 (HY000): Can't connect to local MySQL server through socket '/var/run/mysqld/mysqld.sock' (2)
```