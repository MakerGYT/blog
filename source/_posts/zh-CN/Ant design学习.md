---
title: Ant design学习
date: 2019-04-15 16:47:43
tags:
  - react

categories: study
---
react => umi
umi集成了react-router,将antd,dva作为plugin引入
>组件是中性的，任何一种应用架构都可以采用。因此，React 可以用于 MVC 架构，也可以用于 MVVM 架构，或者别的架构。
umi : Pluggable enterprise-level react application framework.
umi-plugin-react: advanced function

how to define child components

>“受控”与“非受控”两个概念，区别在于这个组件的状态是否可以被外部修改。一个设计得当的组件应该同时支持“受控”与“非受控”两种形式，即当开发者不控制组件属性时，组件自己管理状态，而当开发者控制组件属性时，组件该由属性控制。

布局　－> Props.children数组 和容器类组件 
[React.js 小书](http://huziketang.mangojuice.top/books/react/)

>通过全局唯一的 CSS 命名，我们变相地获得了局部作用域的 CSS（scoped CSS）。如果一个 CSS 文件仅仅是作用在某个局部的话，我们称这样一个 CSS 文件为 CSS module。

less:
  1. Less 的语法。
  2. Less 预处理器（Less preprocessor）。

test
[enzyme](https://airbnb.io/enzyme/)
react lifestyle
![](https://cdn.yuque.com/lark/0/2018/png/5482/1528371738002-2a20482c-f375-45d0-a7e9-3492e2496b0f.png)

权限控制
>权限的真正控制都必须是在服务端负责的,如果仅仅是前端把这个按钮隐藏是无法做到真正的权限控制的。因为理论上用户可以直接发送一个接口请求服务端来完成这个操作。
# question
vh & px
子组件定义关系
umi & dva
  react -> dva -> umi
  ![](https://gw.alipayobjects.com/zos/rmsportal/hawpVKfSgndqDucTgjJQ.png)

  node -> koa -> egg
国际化　＆　本地化
浏览器端渲染　＆　服务器端渲染

# new
[now](https://zeit.co/now)

# Error
- Experimental support for decorators is a feature that is subject to change in a future release. Set the 'experimentalDecorators' option to remove this warning
"javascript.implicitProjectConfig.experimentalDecorators": true

- uncaught at _callee3 at _callee3 
 at _callee6 
 at takeEvery(cards/queryList, _callee) 
 at _callee 
 at _callee 
 Error: SyntaxError: Unexpected token < in JSON at position 0

![Originate from https://www.yuque.com/ant-design/course/abl3ad](https://gw.alipayobjects.com/zos/rmsportal/trbRYJugHYeODogmIgwi.png)
# Reference
<small>
[1] ant-design.Ant Design 实战教程（beta 版）https://www.yuque.com/ant-design/course/ [EB/OL] 2018
</small>