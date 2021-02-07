---
title: install jdk8
date: 2020-02-14 21:20:38
tags:
 - java
categories: config
description: install Java SE Development Kit 8u281
---
```sh
wget wget https://download.oracle.com/otn/java/jdk/8u281-b09/89d678f2be164786b292527658ca1605/jdk-8u281-linux-x64.tar.gz?AuthParam=1612689618_65fe9491bf481f6d77fd517264c1772e
sudo mkdir /usr/lib/jvm
sudo tar zxvf jdk-8u281-linux-x64.tar.gz -C /usr/lib/jvm
# ~/.bashrc
#set oracle jdk environment
export JAVA_HOME="/usr/lib/jvm/jdk1.8.0_281"
export JRE_HOME="${JAVA_HOME}/jre"
export CLASSPATH=".:${JAVA_HOME}/lib:${JRE_HOME}/lib"
export PATH="${JAVA_HOME}/bin:$PATH"
java -version
```
