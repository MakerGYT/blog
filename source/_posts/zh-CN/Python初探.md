---
title: Python 初探
date: 2017-10-21 07:06:36
tags:
  - python
categories: study
---

{% cq %}Life is short,I use Python!{% endcq %}

# 1 学习准备
## 1.1 环境

<!-- more -->


+ 学习环境：[Anaconda 5.0.0](https://repo.continuum.io/archive/Anaconda3-5.0.0.1-Linux-x86_64.sh)
+ 编辑器：[sublime text 3143](https://www.sublimetext.com/)
+ 虚拟机：[VMwarePro 12](http://sw.bos.baidu.com/sw-search-sp/software/aff3469fe5f99/VMware-workstation-full-12.5.7.20721.exe)
+ Linux镜像：[Ubuntu 16.04](http://blog.csdn.net/zhu_xun/article/details/16921413)



## 1.2 基础知识
+ Python介绍:[中](https://baike.baidu.com/item/Python/407313)     [英](https://en.wikipedia.org/wiki/Python_%28programming_language%29)
+ 计算机语言类型：[编译型和解释型的区别](http://blog.csdn.net/zhu_xun/article/details/16921413)

## 1.3 学习目标

+ 配置Python运行环境，在Anaconda下运行python
+ 了解Python的基础知识及与其他语言的区别及优势
+ 学会配置虚拟机，在linux默认环境下运行python
+ 练习用Python写一个贪吃蛇游戏

## 1.4 学习资源
+ 慕课：[嵩天](http://www.icourse163.org/u/1732151471?userId=4462001)
+ 教程：[廖雪峰](https://www.liaoxuefeng.com/wiki/0014316089557264a6b348958f449949df42a6d3a2e542c000)
+ 参考：[官方文档](https://docs.python.org/3/)
## 1.5 一个Python实例代码

```python
#Fibonacci series up to n
>>> def fib(n):
>>>     a, b = 0, 1
>>>     while a < n:
>>>         print(a, end=' ')
>>>         a, b = b, a+b
>>>     print()
>>> fib(1000)
```

# 2 开始

## 2.1 前言

   现在切入正题，首先为什么是要学习python？

首先因为这是个讲求效率的时代，当然这里Python的效率在于其开发效率，可以试下用其他语言写上面的斐波那契数列。在运行效率上依然C/C++是首位，这是毋庸置疑的。然而在计算资源不再是问题的现在，开发效率显得极其重要。Python没有复杂晦涩的语法概念，它更像是为人类语言设计的，更多的面向算法实现而不是考虑底层实现机制，这与C++或者Java有很大不同。就语言本身来看，它始终基于自身不断迭代而不像其他语言不断新增各种各样的库或者包，让开发者应接不暇。当然也由于要“脱胎换骨“，不得不壮士断腕，于是形成2.7和3.x版本不兼容的”脾气“，这一点也让很多人苦恼。

其次，Python现在太受欢迎了。在今年10月10日召开的[Github Universe](https://octoverse.github.com/)大会上，根据发布的Github Octoverse报告显示，Python已代替Java从去年的第三突进到了第二（第一是js），新增了40%的Pull。不是我们追风，而是在很多开源项目中，越来越多的开发者选择使用Python，尤其是一些大公司(联盟)主导的开源项目，例如被fork最多的TensorFlow（谷歌开发的深度学习平台），开发者不可避免的要去使用进而也就必须要学习。这是一个提高语言热度的良性循环。
![语言排行](http://upload-images.jianshu.io/upload_images/3234038-ceab477152c9aa36.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
因而，正如本文开始提到的，越来越多的开发者在感慨”人生苦短“了。

   然后是Python能干什么？

在此之前，听说过爬虫、图像处理，对，如果使用python编写，这将变得十分容易。在研究领域，Python可以很快的将算法付诸实现，从而让研究者有更多精力去测试并改进算法而不必把时间耗费在语言工具上，这也正是在机器学习领域python更受欢迎的原因。

## 2.1 准备

### 2.1.1 安装环境
主要分为两种，
+ 在windows64平台上,集成了`python3.6`的[Anaconda](https://docs.anaconda.com/anaconda/install/windows)。点击查看安装步骤，也可以参考[这个](https://jingyan.baidu.com/article/7908e85c9e4725af481ad2e2.html)不过不全面。
**注意**：不用勾选add to environment path和register to ...,安装路径不要含中文、空格(这些都在官方文档有所说明)
+ 在Ubuntu16.04平台上，内置的`python2.7`。在此之前需要先安装[VMware](https://jingyan.baidu.com/article/c275f6ba07e269e33d756714.html),一个虚拟机软件，便于在win平台上运行ubuntu系统。或者你也可以选择安装双系统，当然目前不推荐。**注意**：一般会遇到两个问题，[安装VMtools](https://jingyan.baidu.com/article/3065b3b6e8dedabecff8a435.html)用于与主机的文件交互，[网络无法连接](http://blog.csdn.net/jjmjeffrey/article/details/54972676)。

其实也可以在一个平台上配置两种版本的环境，不过在当前只是入门的情况下，还是隔离开学习比较好。使用Ubuntu也可以顺便学习linux的基本操作

测试已正确安装
+ win:找到Anaconda prompt右键管理员运行，键入`python`,出现欢迎语和版本，前面提示符变为>>,试一下：
```python
>>>print "hello python"
#有结果即安装成功。
```
+ linux:左上方找到terminal，键入`python`,出现欢迎语和版本,前面提示符变为>>,试一下：
```python
>>>print "hello ubuntu"
#有结果即安装成功。
```
### 2.1.2 安装sublime
+ win:直接下载安装，默认到底
+ linux:通过apt方式安装

```linux
~$ wget -qO - https://download.sublimetext.com/sublimehq-pub.gpg | sudo apt-key add -
~$ sudo apt-get install apt-transport-https
~$ echo "deb https://download.sublimetext.com/ apt/stable/" | sudo tee /etc/apt/sources.list.d/sublime-text.list
~$ sudo apt-get update
~$ sudo apt-get install sublime-text
```
## 2.2 学习基本知识
一般学习一门语言，都会从运行机制然后是基础语法入手。为了便于语言选择的迁移，几乎所有语言的基础语法都是类似的，如变量类型、逻辑关系、逻辑式等等，接着是函数定义。因此如果已经系统学习过一门语言，上手其他是很容易的。
学习基础语法还是要参考[官方文档](https://docs.python.org/3/tutorial/index.html),更加细致权威，读取差异即可。
## 2.3练手
+ 爬虫:一个[系列](http://www.ehcoblog.ml/post/1/)
+ web编程:一个[专栏](https://zhuanlan.zhihu.com/p/29685446)
+ 游戏：实现[贪吃蛇游戏](http://eyehere.net/2011/python-pygame-novice-professional-index/)

以贪吃蛇游戏为实现样例。
### 2.3.1 基本环境

+ 系统：Ubuntu16.04
+ 版本：Python2.7
+ 第三方库：pygame1.9.3
+ 编辑器：sublime text3143
+ 效果如图

![贪吃蛇](http://upload-images.jianshu.io/upload_images/3234038-53f09a7f69439dc5.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

+ 操作方法：
  上下左右键或wsad键控制
ESC键退出游戏

### 2.3.2 练习
**注意**：安装库需要pip方式，打开terminal,键入：
```linux
~$ sudo apt-get install python-pip
~$ sudo apt-get install python-pip python-dev
~$ sudo pip install --upgrade pip
#确认安装好pip：
~$ pip -V
#会出现版本号即pip安装成功
~$ pip install pygame
```
进入python终端
```python
>>>import pygame
>>>print pygame.ver
##可看到版本号成功
```
可以继续在解释器终端编写；也可以先写好snake.py脚本（用sublime,也可以用vim，推荐前者），然后在命令行用`python snake.py`执行
```python
# snake.py
import pygame,sys,time,random
from pygame.locals import *

redColour = pygame.Color(255,0,0)
blackColour = pygame.Color(0,0,0)
whiteColour = pygame.Color(255,255,255)
greyColour = pygame.Color(150,150,150)

def gameOver(playSurface):
    gameOverFont = font = pygame.font.SysFont(None, 48)
    gameOverSurf = gameOverFont.render('Game Over', True, greyColour)
    gameOverRect = gameOverSurf.get_rect()
    gameOverRect.midtop = (320, 10)
    playSurface.blit(gameOverSurf, gameOverRect)
    pygame.display.flip()
    time.sleep(5)
    pygame.quit()
    sys.exit()

def main():
  
    pygame.init()
    pygame.font.init()
    fpsClock = pygame.time.Clock()
   
    playSurface = pygame.display.set_mode((640,480))
    pygame.display.set_caption('Raspberry Snake')

    snakePosition = [100,100]
    snakeSegments = [[100,100],[80,100],[60,100]]
    raspberryPosition = [300,300]
    raspberrySpawned = 1
    direction = 'right'
    changeDirection = direction
    while True:
        
        for event in pygame.event.get():
            if event.type == QUIT:
                pygame.quit()
                sys.exit()
            elif event.type == KEYDOWN:
                
                if event.key == K_RIGHT or event.key == ord('d'):
                    changeDirection = 'right'
                if event.key == K_LEFT or event.key == ord('a'):
                    changeDirection = 'left'
                if event.key == K_UP or event.key == ord('w'):
                    changeDirection = 'up'
                if event.key == K_DOWN or event.key == ord('s'):
                    changeDirection = 'down'
                if event.key == K_ESCAPE:
                    pygame.event.post(pygame.event.Event(QUIT))
       
        if changeDirection == 'right' and not direction == 'left':
            direction = changeDirection
        if changeDirection == 'left' and not direction == 'right':
            direction = changeDirection
        if changeDirection == 'up' and not direction == 'down':
            direction = changeDirection
        if changeDirection == 'down' and not direction == 'up':
            direction = changeDirection
        
        if direction == 'right':
            snakePosition[0] += 20
        if direction == 'left':
            snakePosition[0] -= 20
        if direction == 'up':
            snakePosition[1] -= 20
        if direction == 'down':
            snakePosition[1] += 20
      
        snakeSegments.insert(0,list(snakePosition))
       
        if snakePosition[0] == raspberryPosition[0] and snakePosition[1] == raspberryPosition[1]:
            raspberrySpawned = 0
        else:
            snakeSegments.pop()
       
        if raspberrySpawned == 0:
            x = random.randrange(1,32)
            y = random.randrange(1,24)
            raspberryPosition = [int(x*20),int(y*20)]
            raspberrySpawned = 1
      
        playSurface.fill(blackColour)
        for position in snakeSegments:
            pygame.draw.rect(playSurface,whiteColour,Rect(position[0],position[1],20,20))
            pygame.draw.rect(playSurface,redColour,Rect(raspberryPosition[0], raspberryPosition[1],20,20))

        pygame.display.flip()
       
        if snakePosition[0] > 620 or snakePosition[0] < 0:
            gameOver(playSurface)
        if snakePosition[1] > 460 or snakePosition[1] < 0:
            for snakeBody in snakeSegments[1:]:
                if snakePosition[0] == snakeBody[0] and snakePosition[1] == snakeBody[1]:
                    gameOver(playSurface)
       
        fpsClock.tick(5)

if __name__ == "__main__":
    main()
```