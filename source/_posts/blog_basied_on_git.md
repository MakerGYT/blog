---
title: 基于git的博客(含站点与小程序)
date: 2020-07-04 22:08:16
tags:
  - 博客
  - 微信小程序
  - 建站
description: 云开发提供的支持最大意义在于弱化后端和运维在开发中所占的时间成本和角色，按需提供可靠服务，但并不能理解为某些项目所谓的“不依赖任何后端服务”、“无需服务器、域名”。结合git自身commit附带的变更信息，可以实现对资源的增删改查。这样，博客更新构建无感进行，也无需实现管理后台和编辑器功能，借助WebHook同步多端，可以专注于内容沉淀。而git天生支持协同编辑，从而可以拓展至团队博客。
categories: 项目
cover: https://cdn.blog.makergyt.com/images/project-blog_basied_on_git_cover.png
language: zh-CN
---
## 1 效果
- 静态站点: 
  - [blog.makergyt.com](https://blog.makergyt.com)
    <div>
    <a href="https://makergyt.coding.net/p/blog/ci/job"><img style="display:inline" src="https://makergyt.coding.net/badges/blog/job/187329/master/build.svg"></a>
    <img style="display:inline;margin-left:5px;" src="https://img.shields.io/badge/Generator-Hexo-0e83cd?&logo=hexo">
    </div>
  - 备用链接: [github.blog.makergyt.com](https://github.blog.makergyt.com)
    <div>
    <a href="https://github.blog.makergyt.com"><img style="display:inline" src="https://badgen.net/github/status/makergyt/blog/gh-pages"></a>
    <a href="https://travis-ci.com/MakerGYT/blog"><img style="display:inline;margin-left:5px;" src="https://img.shields.io/travis/com/makergyt/blog?logo=travis"></a>
    </div>  
- 小程序: <div><img style="display:inline" src="https://img.shields.io/badge/basicLib-%3E=2.11.0-brightgreen?logo=wechat"><div>
![图1-1 源创智造小程序](https://cdn.blog.makergyt.com/mini/assets/poster-H.png)
- 语雀:[《MakerGYT blog》](https://www.yuque.com/books/share/4b51224a-b8b0-4191-8403-d28563f6a6ed?#) 

## 2 需求分析
### 2.1 做
- 专注于写markdown文档，或者说专注于内容。
- 一端书写，多端同步：小程序、静态站点
- 快速的静态托管、持续集成、页面资源加载

### 2.2 不做
- 不需要满足随时随地写文章,因为随时随地写的大部分是随笔、记录一类的帖子，若要呈现出来，必然要经过整理。
- 不需要自定义主题风格,博客就主体业务类型(除了评论、点赞、收藏)而言受众个性色彩不强

## 3 系统设计
### 3.1 概要设计
#### 3.1.1 架构设计
主要思路是通过git管理文章(markdown类型)，发布到小程序和静态站点(适用于构建md文档的框架如hexo、jeklly等)。
**技术路线**:
1. 更新 => 通过git进行源端CURD操作
2. 解析 => 通过serverless完成md解析至html
3. 同步 => 通过CI完成构建和部署到对象存储(静态托管));通过webhook拉取git仓库更新到云存储(小程序)
4. 浏览 => 通过对象存储触发云函数刷新CDN(静态托管);通过rich-text组件解析html(小程序)

#### 3.1.2 技术选型与开发框架
在开发框架上，由于初期面向微信小程序开发且可能存在未知问题，故使用原生开发，不使用多端或其他预编译框架。在小程序UI上，参考但不依赖WeUI组件库，因由于封装不必要的特性可能造成代码包的冗余。

| 类型 | 方案 | 备注 |
| -- | -- | --|
| 代码托管 | Coding | github api访问较大概率慢且不稳定 |
| 云开发 | [腾讯云TCB](https://url.cn/HqLHX3x6) | 含小程序云开发服务 |
| 持续集成 | Coding CI | 使用Jenkinsfile定义pipeline |
| 静态托管 | [腾讯云COS](https://url.cn/lhzrIgeX) | 也可使用[阿里云OSS](https://www.aliyun.com/product/oss?source=5176.11533457&userCode=89lfnf3q&type=copy),或直接使用云开发提供的[静态网站托管](https://cloud.tencent.com/product/wh),使用对象存储配合内容分发加速。|
| Markdown解析 | markdown-it | 也可使用markdjs,但markdown-it支持拓展插件 |
| 富文本渲染 | [parser](https://jin-yufeng.github.io/Parser/#/) | 比原生rich-text功能丰富且效果稳定 | 


#### 3.1.3 界面设计
由于是内容类应用，需要格外注意视觉规范，以使用户获取较好的阅读体验。以下规范参考了[WEDESIGN](https://developers.weixin.qq.com/miniprogram/design/)和[Ant Design](https://ant.design/docs/spec/introduce-cn),根据实际需要进行了修改和补充。
字体:
| 字号pt　| 像素px |颜色| 用途|
|--|--|--|--|
| 17 |17|#000000| 页面内首要层级信息,列表标题 |
| 17 |17|#B2B2B2| 时间戳与表单缺省值 |
| 14 |14|#888888| 页面内次要描述信息，搭配列表标题 |
| 14 |14|#353535| 大段文本 |
| 13 |13|#576b95| 页面辅助信息，需弱化的内容如链接|
| 13 |13|#09bb07| 完成字样 |
| 13 |13|#e64340| 出错字样 |
| 11 |11|rgba(0, 0, 0, 0.3)|说明文本，如版权信息等不需要用户关注的信息|

图标:
|类别|颜色|大小|
| --|--|--|
|导航类 | 可多色，但不多于三色,主色一致 |28px|
|菜单操作类 | 单色,颜色统一 | 22px|
|操作提示类 | 与提示类型相关 | 30px |
|展示区分类 | 图标固有色彩 | 与跟随字体大小一致 |

响应式设计:
主要通过改变px为rpx实现，由于基本不涉及列表项目，不考虑自适应布局变换，仅做不同屏幕下元素呈现比例保持一致，以iphone-6作为标准，对于iphone-x类异形屏，重点考虑操作菜单(如贴顶、贴底、悬浮)的安全区域问题，主要通过CSS中`calc(env(safe-area-inset-bottom))`方式实现。
- 图片横向铺满屏幕
- 主体文字不需要
- 由于已经有静态站点，暂不考虑PC端适配

#### 3.1.4 开发规范
- 渐进式，先实现基本功能，再考虑抽离和组件化。
- 能用简单的逻辑实现就不抽离组件，能使用成熟库就不自行创建组件，能通过配置或迁就性使用就不修改外部库以保证平滑更新。
- 对于功能实现的方式，要考虑服务角色,权衡计算复杂度、网络延时和用户感知程度:

小程序端做简单计算
- canvas绘制海报 
- 基本格式转换

服务端(云开发)做复杂处理,非实时性计算，或可预生成内容
- markdown转html
- TOC目录
- AI识别、处理
- 对于读写数据库，尽量将写操作放在云函数中。

### 3.2 详细设计
#### 3.2.1 数据源
安全校验，保证云函数触发来源及方式可信:
```js
// 查看请求头
if (!req.headers['user-agent'].includes('Coding.net Hook') || 
    !('x-coding-signature' in req.headers) || req.headers['x-coding-signature'].indexOf('sha1=')
    !('x-coding-event' in req.headers) || 'POST' !== req.httpMethod ) {
  return false;
}
// 计算和比对签名
const theirSignature = req.headers['x-coding-signature'];
const payload = req.body;
const secret = process.env.HOOKTOKEN;
const ourSignature = `sha1=${crypto.createHmac('sha1', secret).update(payload).digest('hex')}`;
return crypto.timingSafeEqual(Buffer.from(theirSignature), Buffer.from(ourSignature));
```

在每次commit推送新的代码时，WebHook会push以下信息(限于篇幅，略去非必要信息)
```json
{
  "ref": "refs/heads/master",
  "commits": [
    {
    "id": "8a175afab1cf117f2e1318f9b7f0bc5d4dd54d45",
    "timestamp": 1592488968000,
    "author": {
      "name": "memakergytcom",
      "email": "me@makergyt.com",
      "username": "memakergytcom"
    },
    "committer": {
      "name": "memakergytcom",
      "email": "me@makergyt.com",
      "username": "memakergytcom"
    },
    "added": [
      "source/_drafts/site.md"
    ],
    "removed": [],
    "modified": [
      "package.json",
      "scripts/fix.js",
      "source/_posts/next.yml",
      "source/_posts/typesetting.md"
    ]}
  ],
  "head_commit":{...},
  "pusher",
  "sender",
  "repository"
}
```
保持最新状态故关注`head_commit`.这些信息包含了本次提交产生的变更，可以基于遍历这些变更状态，同步云数据库。但由于可能包含了非文章文件的变更，也可能非目标分支，故需要筛选:
```js
if ('refs/heads/' + branch === ref) {
  if (filePath.indexOf(dirPrefix) || filePath.slice(-3) !== '.md') {　// 路径前缀和文章后缀
    continue;
  }
}
```
要建立数据库文件与git仓库文件的关联，由于每次commit的文件没有唯一id信息,可以通过文件名来建立联系，将文件名作为slug字段(主键)
```js
let slug = filePath.match(new RegExp(dirPrefix + "([\\s\\S]+)\\.md"))[1];
```
由于Push 事件不包含文件内容，需要通过api发起请求
```js
await axios({
  url: `${baseUrl}/${branch}/${filePath}`,
  method: 'get',
  headers: {
    'Authorization': `token ${process.env.CODINGTOKEN}` // 个人令牌
  }
});
```
#### 3.2.2 数据处理
提取文章信息:
由于要求在markdown开头通过yaml格式写明基本信息，故在获取到文件内容(String)后需要转json。
```js
const matter = require('hexo-front-matter');
let { title, date, tags, description, categories, _content, cover } = matter.parse(data);
```
其中cover字段(封面图)也可不声明，而通过文章首图来获取
```js
let cover = _content.match(/!\[.*\]\((.+?)\)/);
```
markdown解析html:
小程序端环境与传统网页有区别，让markdown渲染在本地进行，其中还需要先转为html，为了减少渲染时间，这一步在云端提前进行:
```js
const md = require('markdown-it')({
  html: true,// 允许渲染html
}).use(require('markdown-it-footnote'))　// 脚注引用
```
生成目录
为了保持一致，章节自行标号。目录放在侧边栏不解析到html中，需另行处理。而`markdown-it-anchor`插件会使用header的值作为id(markdown-it-anchor),但id不能以数字开头，不能含中文及`encodeURIComponent(中文)`，但可以含`-`。
```js
// 为<h>标签插入id
id = 'makergyt-' + crypto.createHash('md5').update(title).digest('hex');
// 获取所有h2-h4生成目录列表
const { tocObj } = require('hexo-util');
const data = tocObj(str, { min_depth:2, max_depth: 4 });
```
#### 3.2.3 数据同步
在小程序的文档中，触发云函数可以通过http api（invokeCloudFunction）的方式。但是invokeCloudFunction需要关键的access_token，需要两小时内刷新获取，webhook无法提前获知。考虑设置中控服务器统一获取和刷新 access_token，webhook首先向中控服务器发起请求，再向云函数请求，但这样显然是不可能的，因其只能push一个地址一次，没有上下文。其间再加一个中间函数，那么这个中间函数又放在哪里，如何请求...(同样需要access_token)

这时，在[腾讯云－云开发控制台](https://url.cn/ZHExHUCa)，发现可以直接通过"云接入HTTP触发方式"触发云函数，这样就可以直接该地址作为WebHook的Url。但需要关注业务和资源安全[^1],上文在处理webhook push事件时已经做了安全检验，可以再将Coding的request domain加入到WEB安全域名列表中。

获取到文章信息和内容后就可以同步到云数据库的相应集合中,这里循环中使用`async/await`遍历,为了在每个调用解析之前保持循环,只使用`for...of`进行异步[^2]。
```js
for (const file of added) {
  await db.collection('sync_posts').add({
    data
  })
}
for (const file of modified) {
  await db.collection('sync_posts').where({
    slug
  }).update({
    data
  })
}
for (const file of removed) {
  await syncPosts.where({
    slug
  }).remove();
}
```

#### 3.2.4 文本渲染
几乎不太可能将原内容原封不动显示出来, 经过markdown-it渲染后的html字符串没有插入任何样式,直接测试(根据标签默认提供样式)效果如下:
| 方案 | 效果 |
| -- | -- |
|rich-text | 代码块缺失，长内容被截断 |
|wxparser | 间距过大，表格、代码块被截断 |
|towxml | 代码块被截断 |
|wemark |代码块与引用部分不换行拉宽 |
|Parser| 表格溢出 |
*Tips*: 注意到腾讯Omi团队开发的小程序代码高亮和markdown渲染组件[Comi](https://github.com/Tencent/omi/tree/master/packages/comi/mp/comi)，实际上采用模板引入的方式使用。考虑随后实测效果和对比渲染速度。

相比之下，都会出现溢出组件边界，产生横向滚动条问题。在使用上，存在不支持解析style标签缺陷[^3]
![图3-1 表格溢出](https://imgkr.cn-bj.ufileos.com/9781bc4f-de66-4338-a993-21cfc987b405.png)

而Parser可以通过控制源html样式的方法解决这种问题
```js
var document = that.selectComponent("#article").document;
document.getElementsByTagName('table').forEach(tableNode => {
  var div=document.createElement("div");
  div.setStyle("overflow", "scroll");
  div.appendChild(tableNode);
  div._path = tableNode._path;
  tableNode = div;
});
```
Parser也提供了通过控制源html中标签样式来影响渲染效果，这样就可以改变字体大小、行高、行间距等，以适应手机屏幕。
```js
//post.wxml
<parser id="article" tag-style="{{tagStyle}}"/>
// post.js
tagStyle: {
  p: 'font-size: 14px;color: #353535;line-height: 2;font-family: "Times New Roman";',
  h2: 'font-size: 18.67px;color: #000;text-align:center;margin: 1em auto;font-weight: 500;font-family: SimHei;',
  h3: 'font-size:16.33px;color: #000;line-height: 2em;font-family: SimHei;',
  h4: 'font-size:14px;color: #000;font-family: SimHei;',
}
```
对于代码高亮，使用[prism ](https://prismjs.com/),引入到该组件中。
```js
const Prism = require('./prism.js');
...
highlight(content, attrs) {
  content = content.replace(/&lt;/g, '<').replace(/&gt;/g, '>').replace(/quot;/g, '"').replace(/&amp;/g, '&'); // 替换实体编码
  attrs["data-content"] = content; // 记录原始文本，可用于长按复制等操作
  switch (attrs[lan]) {
    case "javascript":
    case "js":
      return Prism.highlight(content, Prism.languages.javascript, "javascript");
  }
}  
```

**数学公式Latex**
对于latex渲染引擎，主要有两种
| 引擎 | 特点|
|--|--|
|mathjax |语法丰富，渲染较慢 |
|katex |支持语法较少，迅速,只能输出mathml或html,需要搭配其CSS and font files使用 |

当然，这两种都是网页客户端渲染，在小程序端天生不可用，考虑采用服务端渲染。问题有:
- 服务端渲染如果使用外部接口，需encodeUrl(公式)，但内部`\`被转义消失，需要`\\`，replace(/\\/g,'\\')无效
- 服务端渲染如果使用mathjax-node,其依赖项mathjax版本^2.7.2，需将所有`\`替换为`\\`,会经常性出现`SVG - Unknown character: U+C in MathJax_Main,MathJax_Size1,MathJax_AMS`, 矩阵解析错误`TeX parse error: Misplaced &`
- 如何比较精准的识别markdown中特定标记的Latex，不造成误操作。

考虑在markdown解析html阶段将其转化为`<img>`，也是很多内容平台采取的方式，较为可靠可控。这里使用[markdown-it-latex2img](https://github.com/MakerGYT/markdown-it-latex2img)插件
```js
const md = require('markdown-it')({
  html: true,// Enable HTML tags in source
}).use(require('markdown-it-latex2img'),{
    style: "filter: opacity(90%);transform:scale(0.85);text-align:center;" //　优化显示样式
  })
```
![图3-2 markdown-it-latex2img效果](https://imgkr.cn-bj.ufileos.com/5be6b53b-c3dc-4119-9683-09d650858558.jpeg)

### 3.3 静态托管
为git库设置构建计划，以使每次提交后同步到对象存储。这里使用[hexo](https://hexo.io)作为构建框架。
```sh
pipeline {
  agent any
  stages {
    stage('检出') {
      steps {
        checkout([
          $class: 'GitSCM',
          branches: [[name: env.GIT_BUILD_REF]],
          userRemoteConfigs: [[url: env.GIT_REPO_URL, credentialsId: env.CREDENTIALS_ID]]
        ])
      }
    }
    stage('构建') {
      steps {
        echo '构建中...'
        sh 'npm install -g cnpm --registry=https://registry.npm.taobao.org'
        sh 'cnpm install'
        sh 'npm run build'
        echo '构建完成.'
      }
    }
    stage('并行阶段') {
      parallel {
        stage('部署到腾讯云存储') {
          steps {
            echo '部署中...'
            sh "coscmd config -a $TENCENT_SECRET_ID -s $TENCENT_SECRET_KEY -b $TENCENT_BUCKET -r $TENCENT_REGION"
            sh 'coscmd upload -r public/ /'
            echo '部署完成'
          }
        }
        stage('打包') {
          steps {
            sh 'tar -zcf blog.tar.gz public'
            archiveArtifacts(artifacts: 'blog.tar.gz', defaultExcludes: true, fingerprint: true, onlyIfSuccessful: true)
          }
        }
      }
    }
  }
}
```
构建后自动刷新CDN,
```js
// refresh_cdn
const Key = decodeURIComponent(event.Records[0].cos.cosObject.key.replace(/^\/[^/]+\/[^/]+\//,""));
const cdnUrl = `${process.env.CDN_HOST}/${Key}`;
CDN.request('RefreshCdnUrl', {
    'urls.0': cdnUrl
}, (res) => {
  ...
})
```
## 4 系统实现
### 4.1 数据库
文章:
```js
sync_posts = [
  {
    _id: String,
    createTime: String,
    slug: String,
    title: String,
    tags: Array,
    description: String,
    cover: String, // url
    content: String, // html
  }
]
// 安全规则
{
  "read": true, // 公有读
  "write": "get('database.user_info.${auth.openid}').isManager", // 仅管理员可以写
}
```
用户收藏
```js
user_favorite = [
  {
    _id:String,
    userId:String,// openid
    postId: String,// 在表中加入冗余数据直接查询
    createTime: Date
  }
]
// 安全规则
{
  "read": "doc._openid == auth.openid",// 私有读
  "write": "doc._openid == auth.openid"// 私有写
}
```
用户信息
```js
user_info = [
  {
    _id: String,
    _openid: String,
    ...userInfo,
    isManager: Boolean,
  }
]
// 安全规则
{
  "read": "doc._openid == auth.openid", // 私有读
  "write": "doc._openid == auth.openid"// 私有写
}
```
### 4.2 登录
#### 4.2.1 普通登录
使用云开发后，无需通过wx.login获取登录凭证（code）进而换取用户登录态信息，因每次调用云函数时会附带调用者openid。同时由于可以直接通过open-data展示用户信息(不论是否授权),一些小程序因此绕过用户登录。有些小程序通过授权用户信息后保存到数据库，后续操作均使用数据库信息，无法在用户变更信息后更新。如果用户主动通过设置页取消授权，但返回后却还在展示使用用户的信息(显示已登录)。这是因为用户态信息是通过onLoad获取的，返回操作时是onShow,故此时会产生矛盾。用户在重新授权登录时选择使用其他昵称和头像，这时一些小程序会认为是新用户登录。还有一部分小程序不论业务中是否需要用户信息，均要求授权才可使用。实际上微信小程序最大的特点就是可以方便地获取微信提供的用户身份标识，快速建立小程序内的用户体系，但上述情形均没有妥善处理用户登录这一基本策略。

基于["来去自如"](https://developers.weixin.qq.com/miniprogram/design/#%E5%AF%BC%E8%88%AA%E6%98%8E%E7%A1%AE%EF%BC%8C%E6%9D%A5%E5%8E%BB%E8%87%AA%E5%A6%82)的原则,可以游客浏览，也可登录和登出。在涉及一些需要采集和输入用户信息、或保存用户记录的功能时才要求用户跳至登录页授权获取信息，会通过云函数将其与上下文中的openid保存到数据库，同时在回调中将用户标识生成自定义登录态缓存到本地，如果用户点击退出会将其置空。
```js
// cloudfunction/login
const openid = wxContext.OPENID
db.collection('user_info').where({
  _openid: openid
}).get().then(async (res)=> {
  if (res.data.length === 0) {
    db.collection('user_info').add({
      data: {
        _openid: openid,
        ...event.userInfo,
        createTime: db.serverDate(),
      }
    })
  }
```
在下次打开小程序时，会通过检查缓存中的自定义登录态来判断用户是否登录，同样调用云函数来更新用户信息和使用信息(如打开时间、打开次数用于后续用户分析)。在下次登录时将不会弹出授权提示，当用户自行取消授权(或者wx.openSetting时误操作)，这种情况概率很小，但一旦出现就是Bug。如果在onShow中检测用户，会与正常onLaunch产生重复的逻辑，但又需要检测这种行为。实际上，打开设置页必然会进入onHide，可以:
```js
// app.js
onHide:function() {
  wx.onAppShow(()=> {
    if(this.globalData.hasLogin) {
      wx.getSetting({
        success: res => {
          if (!res.authSetting['scope.userInfo']) { // 取消了授权
            this.logout() // 返回后直接登出
          }
        }
      })
    }
    wx.offAppShow();
  })
},
```
#### 4.2.2 管理员鉴权
管理员即文章作者，对于管理员标识，考虑到
- 手机号: 目前该接口针对非个人开发者，且完成了认证的小程序开放
- openid: 不使用前是未知的，无法提前绑定
- 其他用户信息、密码等会暴露管理入口

于是采取了最简单直接的数据字段标记`isMaganer:true`,这一字段也用于数据库的安全规则设定。
### 4.3 分享
分享无非两种，直接分享到聊天和生成海报后引导分享到朋友圈，对于前者，需要考虑图片大小为5:4,其他比例会产生空白或者裁切。这里主要分析后者。在小程序端通过canvas绘制到倒出图片比较慢，由于每篇文章分享内容基本固定，可以考虑预生成。但如果分享二维码和分享者关联，就仍然需要本地生成。这里使用组件[mini-share](https://github.com/MakerGYT/share)。对于小程序码，目前采用云调用方式，这种方式只能由小程序端触发。
```js
// 处理参数
const path = page +'?' + Object.keys(param).map(function (key) {
    return encodeURIComponent(key) + "=" + encodeURIComponent(param[key]);
}).join("&");
// 组织文件名
const fileName = 'wxacode/limitA-' + crypto.createHash('md5').update(path).digest('hex');
// 查找文件,如果找到直接返回路径
let getFileRes = await cloud.getTempFileURL({
  fileList: [fileID]
});
// 若未找到重新生成
const wxacodeRes = await cloud.openapi.wxacode.get({
  path,
  isHyaline:true
})
// 上传到云存储
const uploadRes = await cloud.uploadFile({
  cloudPath: fileName + fileSuffix,
  fileContent: wxacodeRes.buffer,
});
// 获取返回临时路径
getFileRes = await cloud.getTempFileURL({
  fileList: [uploadRes.fileID]
});
```
生成二维码方式有三种，分析特性
| 类型　| 特点 |适用场景 |
|--|--|--|
|A+ C | 个数有限、参数较长 |生成后储存　用于长期有效业务，可用于邀请码一类用户可长期关注使用的操作。|
|B |个数无限、参数较短 |生成后可不保存，其scene与用户短期行为关联（如活动）。活码，与数据库关联后可以转换含义再次使用。|
这里由于文章的数据库`_id`默认是32位，达到了B类的限制，并且还需要关联其他信息，故使用了A类(wxacode.get)
### 4.4 订阅消息
对于个人主体，只能用户经小程序发起订阅(获取下发权限)后下发一次消息，这里当用户留言时，会订阅一次回复通知,但无法发给作者(除非作者长期订阅)。由于同时需要保存到数据库，这里使用云调用实现。
```js
// post.js
wx.requestSubscribeMessage({
  tmplIds: [TEMPLATE.REPLY]
})
// cloudfunction/sengMsg
let sendRes = await db.collection('user_msg').add({
  data: {
    _openid: wxContext.OPENID,
    msg:inputMsg,
    createTime:Date.parse(new Date())
  }
});
await cloud.openapi.subscribeMessage.send({
  data: format(data), // 由于各种类型信息有长度格式限制，需要处理
  touser: wxContext.OPENID,
  templateId: TEMPLATE.REPLY
});
```
## 5 拓展总结
### 5.1 结合语雀
#### 5.1.1 同步到语雀
- 会在标题前插入`<a name="tqO5w"></a>`标签
- 编辑界面直接复制会图片外链转化，但是直接导入的不会转化  
- 只可本地引入文件(图片)，均不支持外部链接引入，除了加入的第三方服务 
- 可以input任意类型，但output都是特有lake格式,且在[更新文档](https://www.yuque.com/yuque/developer/doc#c2e9ee2a)接口调用时，会返回
```json
{
  "status": 400,
  "message": "抱歉，语雀不允许通过 API 修改 Lake 格式文档，请到语雀进行操作。"
}
```
#### 5.1.2 从语雀同步
可以借助语雀良好的编辑体验来写文章，同步到其他平台。yuque的webhook会发送webhook.doc_detail可以直接获取到内容。但是，在丰富文档内容类型方面，语雀做了很多卓有成效的努力，使用这些特性，也就无法保证其他平台的兼容性。删除操作返回的slug会变为`trash-EJA8tL7W`，与原slug无关，无法通过slug建立其他平台的关联，即仅增改操作可以同步。因此，在语雀写作，自动部署到其他平台的方案是不切实际和不必要的。

#### 5.1.3 workflow
同步至语雀后，可以利用其丰富的支持类型完善文档内容，比如将文本内容转化为更直观的流程图、思维导图，将demo和代码合并到codepen直观演示，将可能涉及的资料直接以附件上传方便获取。
但要注意：
- 很多内容平台往往会在拥有一定用户基数后做图片防盗链。
- 目前的webhook设计不安全，没有签名验证，可能由于Webhooks URL泄露被伪造请求

### 5.2 小程序开发已知问题
- 真机初始动画卡顿500ms
- 原生TabBar隐藏会跳动，加动画会黑屏，自定义TabBar切换时所有图标会闪动，自动隐藏会显示白条.
- 简单几次来回navigate后,listeners of event onBeforeUnloadPage_17 have been added, possibly causing memory leak.
- 在调用CameraFrameListener.start开始监听帧数据后，必然有对像素data的获取和处理，但这会导致界面所有的点击(bindtap)事件失效，也就不能通过点击触发CameraFrameListener.stop停止函数
- 云控制台数据库管理页中数组更新操作符addToSet无效,对象元素传入后[不稳定](https://developers.weixin.qq.com/community/develop/doc/0006e2966e886042445a5e6c456c00)，或生效或不生效

[^1]: Tencent Cloud.云开发CloudBase文档[EB/OL].https://cloud.tencent.com/document/product/876/41136. 2020
[^2]: Tory Walker.The-Pitfalls-of-Async-Await-in-Array-Loops[EB/OL].https://medium.com/dailyjs/the-pitfalls-of-async-await-in-array-loops-cf9cf713bfeb. 2020
[^3]: 金煜峰.小程序富文本能力的深入研究与应用[EB/OL].https://developers.weixin.qq.com/community/develop/article/doc/0006e05c1e8dd80b78a8d49f356413. 2019