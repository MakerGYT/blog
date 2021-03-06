---
title: 安装双系统记录
date: 2018-12-24 17:15:19
tags:
	- linux
categories: record
description: 仅作记录
---
# 1 当前环境

联想lenovo G50:4G+4G(自行扩展)内存，512G机械硬盘，128G SSD 64位i5CPU
# 2 使用工具：

- 系统盘刻录：[rufus 3.2](http://rufus.akeo.ie/)(类似刻录工具有ultraiso，老毛桃、大白菜之类装机工具虽然集成度高，但比较笨重且不稳定，不便于引导启动系统)
- U盘：8G USB2.0 （USB规格不影响，容量8G足够）
- 分区：[Disk genius V4.9.6.564](http://www.diskgenius.cn/)
- 激活工具：[MicroKMS_v18.08.09](http://www.yishimei123.com/network/319.html?=microKMS_17.06.25)（容易被windows defender识别为病毒并直接删除，需先关闭后下载，执行完后删除，恢复defender）

# 3 系统版本

- Windows 10 pro Version 1803(English)(目前最新稳定版，省去安装后不停更新)
- Ubuntu 16.04.5 desktop amd64（目前最新版本为18.04，此版本稳定支持各类开源软件）

# 4 安装模式

先安装win到机械盘后安装ubuntu到固态（限于资源，权衡系统使用场景频率协调）

# 5 详细记录

## 5.1 安装windows

### 5.1.1 准备：
#### 5.1.1.0 分区
原分区符合当前需求故不重新分，本次采用以下分区：

+ system partition:`166G`
+ data partition:`150G`
+ software partition:`150G`

#### 5.1.1.1 制作系统盘
使用rufus刻录系统镜像文件
[en_windows_10_consumer_editions_version_1803_updated_march_2018_x64_dvd_12063379](ed2k://|file|en_windows_10_consumer_editions_version_1803_updated_march_2018_x64_dvd_12063379.iso|4692365312|E991C13EC003F6C98C8A6BD4364F806F|/)，配置项默认：
+ partition scheme:`GPT`
+ target system:`UEFI`
+ file system:`FAT32`

### 5.1.2 安装
#### 5.1.2.1 修改启动项
重启F2进入BIOS，修改boot启动项，将USB DRIVE（根据名称大致判别引导U盘）修改为第一项（F5上移）,关闭安全启动和快速启动，os scheme 为others,save and quit

#### 5.1.2.2 开始安装
1. 按照guide，修改region和time and input,暂不输入序列号。
2. 选择系统版本为windows pro x64,
3. 进入磁盘选择后，delete原有系统引导启动分区，保证三个分区后分别format,选定size为166G的分区
4. 安装完成后拔除U盘进入个性化设置，跳过联网
5. 其余默认
### 5.1.3 激活系统
1. 连接网络
2. 右下角进入windows defender,暂时关闭threat protection
3. 使1用KMS一键激活，进入control panel->system，查看激活状态

## 5.2 安装ubuntu
### 5.2.1 准备：
#### 5.2.1.0 分区
通过Disk Genius将SSD格式化，4096k对齐，在windows里通过disk management将该磁盘卸载，保持为未挂载状态，稍后安装时再进行分区

#### 5.2.1.1 制作系统盘
使用rufus刻录系统镜像文件，
[ubuntu-16.04.5-desktop-amd64.iso](http://releases.ubuntu.com/16.04/ubuntu-16.04.5-desktop-amd64.iso.torrent?_ga=2.90542874.18967268.1536736360-304383447.1536736360) 配置项默认
### 5.2.2 安装
#### 5.2.2.1 修改启动项
重启F2进入BIOS，修改boot启动项，将USB DRIVE修改为第一项（F5上移）,关闭安全启动和快速启动，os scheme 为others,save and quit
#### 5.2.2.2 开始安装
进入界面后，选择install ubuntu,选择语言及输入法English，安装方式为something else,进入磁盘选择，先对SSD进行分区，选定sdb1中的free partition,+依此分区：
+ / ：30G,primary,ext filesystem,begin
+ swap:8G*2=16384MB,logical,
+ boot:512MB,primary
+ home:left space,logical

选择启动位置为SSD对应的标称,结合容量大小，sdb1 120G
根据引导执行后续步骤
### 5.2.3 修改root密码
sudo passwd
试用su验证

## 5.3 验证双系统可正确引导
关机重启后可出现unity风格的系统选择界面，第一项为ubuntu，第三项为检测出的windows boot,分别尝试登陆