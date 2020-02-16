---
title: install jdk8
date: 2020-02-14 21:20:38
tags:
 - java
categories: config
description: install Java SE Development Kit 8u241
---
```sh
wget https://download.oracle.com/otn/java/jdk/8u241-b07/1f5b5a70bf22433b84d0e960903adac8/jdk-8u241-linux-x64.tar.gz
sudo mkdir /usr/lib/jvm
sudo tar zxvf jdk-8u241-linux-x64.tar.gz -C /usr/lib/jvm
# ~/.bashrc
#set oracle jdk environment
export JAVA_HOME="/usr/lib/jvm/jdk1.8.0_241"
export JRE_HOME="${JAVA_HOME}/jre"
export CLASSPATH=".:${JAVA_HOME}/lib:${JRE_HOME}/lib"
export PATH="${JAVA_HOME}/bin:$PATH"
java -version
```