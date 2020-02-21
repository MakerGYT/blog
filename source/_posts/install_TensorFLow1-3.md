---
title: 【译】TensorFLow1.3文档中文翻译之1.0.0安装
date: 2017-10-14 12:11:06
tags:
	- tensorflow
categories: translate
description: 译文
---

{% note info %}
中文社区并没有及时做到更新，于是边翻译边学习，发现效果很显著，会强迫自己去确保理解了每一部分，以前是常常会跳过。
{% endnote %}

下面的引导解释了如何安装让你可以使用Python写程序的一个TensorFlow的版本
# 1 在ubuntu上安装
这份引导解释了如何在Ubuntu上安装TensorFlow。这些说明可能在其它Linux版本上也能工作，但是我们目前仅仅在Ubuntu14.04或者之上的版本上（我们也只支持）测试了它们。
# 2 选择安装哪个Tesorflow版本
你必须选择下面的一种来安装：
- 仅支持CPU。如果你的系统没有NVIDIA® GPU，你只能安装这个版本。注意这个版本更容易去安装（5~10分钟之内），所以即便你有NVIDIA® GPU，我们仍然推荐先安装这个版本。
- 支持GPU。TensorFlow程序在GPU上比在CPU上运行起来明显要快。因此，如果你的系统有符合下面提到要求的NVIDIA® GPU并且你需要运行更具有良好表现的应用，你终究要安装这个版本。

**运行带有GPU支持的TensorFlowN对VIDIA®的要求**
如果你正在安装支持GPU的TensorFlow使用引导中描述的架构，下面的NVIDIA软件必须安装到你的系统上：
- CUDA® Toolkit 8.0.对于细节参考英伟达的文档。确保你按照英伟达文档添加相应的Cuda路径到LD_LIBRARY_PATH环境变量里与CUDA Toolkit 8.0关联的英伟达驱动
- cuDNN v6.对于细节参考英伟达的文档。确保你按照英伟达文档添加相应的Cuda路径到CUDA_HOME环境变量里
- CUDA计算性能3.0及以上的显卡。参考英伟达文档列出的支持的显卡。
- libcupti-dev库，它是英伟达CUDA配置工具接口。这个库提供了先进的<em>仿真</em>支持，按照下面的命令：

```sh
sudo apt-get install libcupti-dev
```

如果你是使用前面列举先前的包，请更新到特定的版本。如果没有更新，你还可以运行支持GPU的TensorFlow，不过仅限于做下面：
- 按照从源码安装的文档安装。
- 安装或至少更新到下面版本的英伟达：
  - CUDA toolkit 8.0及以上
  - cuDNN v3 及以上
  - CUDA计算性能3.0及以上的显卡

# 3 选择如何去安装

你必须掌握如何安装TensorFlow的机制。下面列出了支持的选择:
- virtualenv
- “本地”的pip
- Docker
- Anaconda
- 从源码安装，在单独的引导中有注明

<strong>我们推荐这种virtualenv安装。</strong>virtualenv是一个虚拟的与其他平台隔离的Python系统，在同一个机器上不会妨碍和被影响其他的Python程序。在virtualenv安装过程中，你将不仅安装TensorFlow还有它的依赖项。（这事实上相当容易）开始用TensorFlow工作时，你仅需激活这个虚拟环境。总而言之，virtualenv提供了一个安全可靠的安装运行TensorFlow的机制。

本地的pip直接在你的系统上安装而不进行任何的包含系统。对于想要在一个多用户系统上让所有人都可以获得TensorFlow的系统管理员，我们推荐这种本地pip安装方式。由于本地的pip安装不是隔离在一个单独的容器中，它可能会加入一些基于Python的安装项到你的系统中。不过，如果你理解了pip和你的Python环境，本地安装仅需要一个命令。

Docker将TensorFlow与在你的机器上与预先的包完全隔离开。Docker包含了TensorFlow和所有它的依赖项。注意Docker镜像可能非常大（有成百上千兆）。如果你正准备将TensorFlow合并到已经使用Docker的更大的应用架构里，你可以选择这种Docker安装方式。

在Anconda中，你可以使用conda（译者注：一个包管理器）创建一个虚拟环境。然而，用Anaconda的话，我们推荐<code>pip install</code>命令，而不是<code>conda install</code>命令。

{% note warning %}
**注意** :conda包是社区支持的，不是官方支持。那就是说，TensorFlow团队没有测试也没有包含上conda包。使用该包的风险要由你承担。
{% endnote %}

## 3.1 用vitualenv安装

采取下面的步骤来使用vitualenv安装TensorFlow：
1. 键入下面任一指令来安装pip和virtualenv(译者注：对应不同的python版本,2.7或3.x):

```sh
sudo apt-get install python-pip python-dev python-virtualenv # for Python 2.7`
sudo apt-get install python3-pip python3-dev python-virtualenv # for Python 3.n`
```
2. 键入下面的指令创建一个virtualenv环境：

```sh
virtualenv --system-site-packages <em>targetDirectory</em> # for Python 2.7
virtualenv --system-site-packages -p python3 <em>targetDirectory</em> # for Python 3.n
```

``targetDirectory``指明了virtualenv树的顶部。我们的介绍会设定``targetDirectory``是``～/tensorflow``,你也可以自己选择任何目录。

3. 键入下面的指令来激活virtualenv环境：

```bash
source ~/tensorflow/bin/activate # bash, sh, ksh, or zsh
source ~/tensorflow/bin/activate.csh # csh or tcsh
```

资源符前面会变成这样的提示：
``(tensorflow)$``
4. 确保pip8.0以上已经安装：

```sh
(tensorflow)$ easy_install -U pip
```
5. 键入下面任一指令在激活的virtualenv环境中安装TensorFlow:

```sh
(tensorflow)$ pip install --upgrade tensorflow # for Python 2.7
(tensorflow)$ pip3 install --upgrade tensorflow # for Python 3.n
(tensorflow)$ pip install --upgrade tensorflow-gpu # for Python 2.7 and GPU
(tensorflow)$ pip3 install --upgrade tensorflow-gpu # for Python 3.n and GPU
```
6. 可选）如果步骤4失败（可能是因为低于8.1版本的pip），按下面格式键入指令在激活的virtualenv环境中安装TensorFlow：

```sh
(tensorflow)$ pip install --upgrade tfBinaryURL # Python 2.7
(tensorflow)$ pip3 install --upgrade tfBinaryURL # Python 3.n
```

``tfBinaryURL``定义了TensorFlow Python包的URL。根据操作系统，Python版本和GPU支持选择合适的``tfBinaryURL``值。在这里为你系统找合适的``tfBinaryURL``值。例如，如果你是为Linux,Python 3.4 并且支持GPU,键入下列命令在激活的virtualenv环境中安装TensorFlow：
```sh
(tensorflow)$ pip3 install --upgrade
https://storage.googleapis.com/tensorflow/linux/cpu/tensorflow-1.3.0-cp34-cp34m-linux_x86_64.whl
```
如果安装遇到问题，参考常见安装问题
# 4 下一步
在安装完TensorFlow后，验证安装。
注意每当你使用TensorFlow的时候你必须激活virtual环境。如果该环境当时没有激活，调用下面的指令：
```sh
source ~/tensorflow/bin/activate # bash, sh, ksh, or zsh
source ~/tensorflow/bin/activate.csh # csh or tcsh
```
当该环境激活时，你可以从这个shell中运行TensorFlow程序。你的提示将变成下面这样证明tensorflow环境已经激活：
```sh
(tensorflow)$
```
当你使用完TensorFlow后，调用下面的``deactivate``函数来停止环境:
```sh
(tensorflow)$ deactivate
```
提示符会翻转成默认的（在``PS1``环境变量里定义的）。
# 5 卸载TensorFlow
要卸载TensorFLow的话，移除你创建的树。例如：
```sh
rm -r targetDirectory
```

<em>未完待续</em>

# Reference

<small>[1] Google.tensorflow[EB/OL].https://tensorflow.google.cn .2017.</small>