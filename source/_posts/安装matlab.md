---
title: 安装matlab
date: 2017-11-03 13:55:21
tags:
	- 配置
	- matlab
---
>无论是分析数据、开发算法还是创建模型，
MATLAB 都是针对您的思维方式和工作内容而设计的。

## winx64平台

### 教程环境
+ 系统：windows 10pro 1703
+ 版本：matlab R2017b win64

<!-- more -->
### 基础准备
+ 安装虚拟光驱工具，如[2345好压](http://dl.2345.com/haozip/haozip_v5.9.5.exe)附带这一功能
+ 软件iso镜像文件和破解文件，关注“MakerGYT”公众号回复matlab-win

### 开始
下载文件后，你将获得如下文件
```log
-|matlab
---|R2017b_win64_dvd1.iso #这是镜像1
---|R2017b_win64_dvd2.iso #这是镜像2
---|crack
-----|R2017b 
-------|bin  
---------|netapi32.dll #这是替换文件
-----|license_key.txt #这是激活密钥
-----|license_standalone.lic #这是离线激活认证文件
```

#### 加载镜像1
然后先将镜像1加载到虚拟光驱（右键,或者直接装载），然后进入光驱文件，以管理员身份运行setup.exe，将跳出安装界面，接下来选择不使用internet，接下来输入激活密钥，后面根据自己选择或执行默认安装，**注意**路径最好不要含中文或空格。

#### 加载镜像2
在安装到60%左右时会提示`请插入DVD2`,这时先将刚才加载的虚拟光驱卸载（右键弹出），然后以同样方式加载镜像2到虚拟光驱。回到安装界面，点击确定，继续执行安装。

#### 激活文件
安装完成后运行matlab，进入激活界面，选择离线激活，将激活认证文件导入，确定，激活完成。

#### 覆盖替换
将`netapi32.dll`文件替换到安装路径里的·`bin`下位置，完成最后一步。

#### 语言切换
默认是半中文界面，可在预设->常规->桌面语言中修改

## linux64平台

### 教程环境
+ 系统：Ubuntu 16.04 amd64
+ 版本：matlab R2017b glnxa64

### 基础准备
+ 软件iso镜像文件和破解文件，关注“MakerGYT”公众号回复matlab-linux

### 开始
下载文件后，你将获得如下文件，**注意**，命令中所有`makergyt`替换为你的用户名
```log
-|matlab
---|R2017b_glnxa64_dvd1.iso #这是镜像1
---|R2017b_glnxa64_dvd2.iso #这是镜像2
---|crack
-----|libmwservices.so #这是替换文件
-----|license_key.txt #这是激活密钥
-----|license_standalone.lic #这是离线激活认证文件
```

#### 创建镜像目录

```linux
$ sudo mkdir /media/matlab
```

#### 加载镜像1

```linux
$ sudo mount -o loop R2017b_glnxa64_dvd1.iso /media/matlab/
$ cd /media/matlab
$ cd ..
```

安装
```linux
$ sudo /media/matlab/install
$ sudo mount -o loop R2017b_glnxa64_dvd2.iso /media/matlab/
$ cd /home/Matlab/bin/
$ ./matlab
$ cd~ 
```

#### 加载镜像2
在安装到80%左右时会提示`请插入DVD2`,这时先将刚才加载的虚拟光驱卸载（右键弹出），然后以同样方式加载镜像2到虚拟光驱。回到安装界面，点击确定，继续执行安装。

#### 激活文件
安装完成后运行matlab，进入激活界面，选择离线激活，将激活认证文件导入，确定，激活完成。

#### 覆盖替换
```linux
$ sudo chmod -R 777 Matlab/
$ cd crack
$ sudo cp libmwservices.so /home/Matlab/bin/glnxa64/
$ cd ../
$ ./matlab
```
#### 卸载镜像
```linux
$ sudo umount /media/matlab
```

#### 语言切换
默认是半中文界面，可在预设->常规->桌面语言中修改
####快捷方式
在`/home/Desktop`新建一个文件
```C
[Desktop Entry]
Encoding=UTF-8
Name=Matlab_2017b
Comment=MATLAB
Exec=/home/makergyt/Matlab/bin/matlab
Icon=/home/makergyt/Matlab/bin/glnxa64/cef_resources/matlab_icon.png
StartupNotify=true
Type=Application
Categories=Application;
```
在文件属性中permissions->Allow

获取软件包公众号回复`matlab-win`/`matlab-linux`

*本文仅作为过程性记录，不具有一般适用性，本文采用https://makergyt.com/md 构建*
