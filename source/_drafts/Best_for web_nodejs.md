---
title: 【译】Node.js框架:最适合web和应用程序开发的10个框架
date: 2018-05-08 21:43:18
tags:
  - Node.js
categories: translate
description: 译文
---
{% note info no-icon %}
原文:https://noeticforce.com/best-nodejs-frameworks-for-web-and-app-development
作者:Noetic Sunil
{% endnote %}

在浏览器以外运行JavaScript对于JavaScript爱好者来说非常神奇，同时也肯定是Web应用程序开发界最受欢迎的进步之一。全球各地的开发者全力接纳了Node.js。

对于新手来说，Node.js是允许在浏览器之外服务器上运行JavaScript代码的一种JavaScript。它基于谷歌Chrome的V8虚拟引擎建立的，这一引擎用于在Chrome浏览器中支持JavaScript。

Node.js逐渐普及是因为它可以只使用JavaScript就可以建立大规模、实时性、可扩展的移动和Web应用程序。

随着Node.js生态系统的发展，框架也开始着手加快工作流程。有许多的Node.js框架，允许构建实时的端到端网络应用，而无需任何其他第三方Web服务器、应用服务器、工具和技术。

什么样的框架符合要求呢？

通用性的Node框架就像Express，Koa 和Hapi更加灵活，让你做你想要的一切，最大限度的满足开发需求。但是，在最初需要投入更多的努力，更加依靠开发者作出正确的决策。

而另一方面，像Mean.io，Meteor, Derby和Mojito，有自己的标准结构和技术体系，灵活性较差。然而这些框架不会给开发者太多做错误决策的空间。

让我们来看看目前可用的最好、最强大的Node.js框架，并帮助建立实时的、各种规模和复杂性的可扩展 Web 应用程序。
# 1 Node.js Express
对于一个已经在使用Node.js的开发人员来说，Express 或者"Node.js express"并不是一个新鲜事。Express框架提供了对Node.js原生API比较好的封装，从而使开发者更加容易地使用Node.js。

Express 框架提供了用来开发强壮的 Web 移动应用，以及 API 的所有功能。并且开发人员还能够方便地为它开发插件和扩展，从而增加 Express 的能力。下面列出了一些 Express 提供的基本的功
能：
1. 可以和任何的第三方数据库进行通讯；
2. 可以使用任何的用户认证方式；
3. 可以使用任何符合 Express 接口定义的模板引擎；
4. 可以按照需要定义工程目录。

通过使用 Node.js Express，可以使用更少的代码来实现功能。至少通过使用 Node.js Express，可以实现中间件来响应 http 请求，可以定义路由表来定义对不同请求的响应函数，还可以使用模板引擎来输出 html 页面。

对于一个 Node.js 开发新手来说，Express 还提供了如下的好处：
1. Express 的学习曲线并不陡峭，可以很快上手；
2. Express 有非常庞大的社区，和组织良好的文档，新手可以很容易得到所需要的一切。Express 
根据 MIT 协议进行开源，目前 StrongLoop 对它提供支持。

可以通过 Express 的官方网站 expressjs.com 获得更多的信息。
# 2 Sails.js (Node.js mvc)
Sail 作为一个非常稳固的 Node.js 框架，提供了建立任何规模的 web 应用所需要的所有功能。

Sail.js 在底层使用了 Express 框架来提供对 http 请求的处理，同时使用 Socket.IO 框架来处WebSocket 请求。同时作为一个前端应用开发框架，它允许开发人员选择其熟悉的技术来开发应用。

同时 Sail.js 也通过 waterline 框架实现了 ORM 功能。通过这个功能，应用程序可以在不进行大的修改的前提下，就可以从一个后端数据库，切换到另外一个后端数据库（也可以是一个 NoSQL 数据库）。

Sail 特别适合用来开发对数据的实时更新有较高要求的应用，比如多人棋类游戏，单页 Web 应用等等。如果对 Ruby, Django或者Zend有一定的了解，那么将非常容易理解 Sail 中的概念。

简单来说，Sail.js 既给开发者提供了一个优秀的 MVC 框架，也提供了一定的灵活性，让开发者可以自主选择前端开发方式和后端的数据库。 Sail.js 是由 Mike McNeil 创建的，现在由 Treeline and balderdash 提供支持。Sail.js 在 MIT 协议下开源。

关于 Sail，可以通过官方网站[sailsjs.org](sailsjs.org)来了解更多内容。
# 3 KOA
KOA 是 Node.js mvc 框架的后起之秀，在 2013 第四个季度才发布了第一个版本。开发 KOA 的人员基本来自 Express 开发团队，TJ Holowaychuk 是 KOA 开发团队的领导者。虽然 KOA 大部分开发人员来自 Express，但是他们使用了完全不同的技术来开发 KOA，并且 KOA 正成为 Express 一个强有力的竞争对手。

KOA 框架的核心是 ES6 的 generator。KOA 使用 generator 来实现中间件的流程控制，使用try/catch 来增强异常处理，同时在 KOA 框架中你再也看不到复杂的 callback 回调了。

KOA 框架本身非常小，只打包了一些必要的功能，但是它本身通过良好的模块化组织，让开发人员可以按照自己的想法来实现一个扩展性非常好的应用。

许多 JavaScript/Node.js 的忠实开发者都开始选择使用 KOA 来开发新的项目，因为 KOA 提供了更多的灵活性开发应用程序。

可以通过[koajs.com](koajs.com)获取更多的信息。
# 4 Meteor
Meteor 框架是 Node.js 上最出色的全栈框架。项目在 GitHub 上有 28K+的赞，拥有大量的自定义包，庞大的社区支持，非常好的教程和文档。在这个领域 Meteor 毫无疑问是王者，可以用它构建纯Javascript 的实时 Web 和手机应用。

Meteor 最优秀的部分是，无论是服务器端的数据库访问，业务逻辑实现，还是客户端的展示，所有的流程都是无缝连接，开箱即用。整个框架使用统一的 API，Meteor API 同时适用于客户端和服务器端。

它使用的 DDP 协议可以在后端连接简单的数据库服务、企业数据仓库、甚至 IOT 传感器。

Meteor 带有自己默认的栈，但又有足够的灵活性，可以选择自己的技术方案。如果不需要尝试其他的框架或者没有其他的条件限制，可以直接使用默认配置，进行快速地应用开发。

Meteor 拥有专业化的开发团队，顶级风投的大量资金支持，这都让 Meteor 能够时刻保持业界领先。

可以通过 meteor.com 网站进一步了解 Meteor。
# 5 Derby.js
Derby.JS 跟它的直接竞争对手 Meteor、Mean.io、以及 Mojito 一样，也是一个全栈框架。它运行在 Node.js+ mongo + Redis 的上层。Derby 主要部分是一个叫做 Racer 的数据同步引擎，它能够让数据在数据库、服务器和浏览器之间的同步变得轻而易举。

Racer 的确能够让基于 Derby 框架的应用运行地更快，无论是在浏览器端还是服务器端，对于单页面应用来说，它都是一个完美的选择方案。Derby 经常被用来和业界领先的 Meteor 进行比较，Meteor 项目已经开发了一段很长时间，因而能够提供更多的开箱即用的功能，使得在更短时间内开发复杂的 Web 应用变得更加容易。

而 Derby 更适合于需要更快运行速度的应用，并且它的模块化方式能够让应用更灵活，更容易扩展。Derby 最近的发展有些缓慢，但它并没有出局，仍有改写 Node.js 全栈框架游戏规则的潜力。

可以通过[derbyjs.com](derbyjs.com)网站进一步了解 Derby。
# 6 Flatiron.js (Node.js MVC 框架)
Flatiron 框架背后的核心思想是能使用它所提供的组件以及一些第三方库构建自己的全栈框架。很酷不是吗？我个人十分的喜欢这种方式。然而，这带来的是更高的复杂度，并有可能会被使用错误组件的开发者搞得一团糟。

它可以称之为一个由多个相互独立的组件松散地组建起来的全栈 MVC 框架。Flatiron 框架支持Director，一个从头到脚都使用 JavaScript 搭建起来的，并不需要任何依赖项的 URL 路由组件。通过一个叫 Plates 的模板引擎，Flatiron 能够支持模版语言，然而数据管理是通过 json 实现的，并能与任何一种数据库一起使用。Flatiron 现在由 Nodejitsu 以及其他的社区成员在进行维护，并做的相当不错，是一个不那么流行却值得一看的框架。

可以在[flatironjs.org](flatironjs.org)上获得更多信息。
# 7 Hapi
Hapi 是为数不多的不依赖于 Express 的 Node.js 框架，现在甚至已经完全独立于 Express 了。在最近一段时间中，很多开发者选择了 Hapi 而非 Express，这使得它或多或少变为了 Express 的竞争对手。

Hapi 在众多 nodejs 的框架中并非一个老牌选手，然而它却成功的在这当中创造了自己的一个生态圈。Hapi 致力于完全的分离 node HTTP 服务器、路由以及业务逻辑，并更多的聚焦于如何尽可能的通过配置而非代码来控制东西。

Hapi 最初是由 Eran Hammer 以及在 Walmart labs 的团队为了工作需要开发的。其后便以极快的速度受到了欢迎，现在已在 MIT 许可下成为一个开源的框架，能够免费的被下载和使用。

迪士尼、雅虎、Pebble、beats 音乐以及 Walmart 这样的公司都在使用 HAPI 作为他们旗下一个或多个项目的网络应用框架，它的影响力便可见一斑了。

可以在[hapijs.com](hapijs.com)上找到更多关于 Hapi 的信息。
# 8 Mean.IO
Mean 是 Mongo DB，Express，Angular 和 Node.js 捆绑在一起的组合。基本上说只要有它，就拥有了数据库层，服务器端和网页前端的整套工具，足以开发所有类型的现代网络应用。

Mean 是一个完整独立的包，它涵盖了应用开发的所有方面。尤其适合于那些需要快速开始开发的人。它内置多种技术而且在联合使用时非常好。可以用于创建任意大小和复杂度的应用。

使用 Mean，开发者可以避免经历混合和匹配不同的技术栈。通过 mean 栈，可以减少安装和配置 MongoDB，Express，Angular 和 Node.js 需要的时间。Mean.io 的另一个巨大好处就是所有的栈都使用 JavaScript，服务器端 Express 对 MongoDB 的访问(json)和通多 Angular 从 Node.js 到客户端。

通过[mean.io](mean.io)了解更多 Mean.io 的相关信息。

还有一个名为 mean.js 的 mean 分支也相当流行
# 9 Mojito
Mojito 由 Yahoo 开发并迅速取得成功。然而很快又带着关于框架的空前的成功坐到了冷板凳，就像 Meteor 和 Mean stack 那样。

Mojito 同样是一个 MVC 应用框架，非常适合于创建基于 HTML5，JavaScript 和 CSS3 的高性能的网络和手机应用。Mojito 的根本目标是提供一个框架，该框架用于构建标准的基于跨平台的应用。使之可以同时运行在客户端和服务器端，并实现高性能。

可以在 Yahoo 开发者网页—— mojito 获得更多信息。
# 10 Socket Stream
SocketStream 是一个有趣的框架，专注于客户端和服务端数据的快速同步，它致力于前后端数据的实时更新。

它最大的特点是不严格要求你使用指定的客户端技术，也不限定数据库的 ORM。我趋向于将它和有同样功能的兄弟项目 Sail.js 做比较，它更适合做单页 Web 应用，多用户游戏，聊天客户端，网络应用，交易平台以及所有的需要将数据从服务端实时推送到客户端的应用。

服务端和客户端使用 JSON 来传输数据，比较理想的是使用 websockets 在服务端事件发生时自动将数据推送到客户端，Socket stream 是由 Owen Barnes 创建，现在由 Paul Jensen 和团队维护，他们的工作让这个框架得到了应有的荣耀。

SocketStream framework 在最近几月获得了很好的发展，未来一片光明。

cketStream 信息请浏览 github 上的 socketstream。

优秀框架还有：total.js, Geddy.JS, Locomotive, compound 和 Restify。
# 11 结论
Web 和应用开发的变化是非常快速的，开发人员正在转向快速致力于快速、纯净的项目交付框架。

使用 Node.js 框架的最大优势是提供了高层级结构的盒子，可以关注扩展应用程序而不用在构建和定义基础上消耗精力。

框架提供了多样的特性，工作在不同的底层，试图解决构建实时的常见问题，并解决了可伸缩的和复杂的 Web 应用程序在速度上的问题。在这篇文章里讨论的框架是目前市场上最好的 Node.js 框架。