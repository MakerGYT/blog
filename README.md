# Blog
[![gh-pages](https://badgen.net/github/status/makergyt/blog/gh-pages)](https://github.blog.makergyt.com)
[![](https://img.shields.io/travis/com/makergyt/blog?logo=travis)](https://travis-ci.com/MakerGYT/blog)
[![](https://img.shields.io/badge/Generator-Hexo-0e83cd?&logo=hexo)](https://hexo.io)
[![](https://img.shields.io/badge/Theme-NexT-181717.svg)](https://github.com/theme-next/hexo-theme-next)

## 自定义内容
通过外部配置或接口(inject)而不直接修改源码以便平滑更新，参考[_data](https://github.com/MakerGYT/blog/tree/master/source/_data)
- 将tags与description作为关键词和摘要插入正文　
- 插入参考文献
- 文末显示文章非首要信息
- 滚动通告栏
- 特殊时期全站灰色
- html中插入`<meta name="keywords">`
- 标题字体`SimHei`,正文`Noto Serif SC`,修复微信内置浏览器显示
- 样式
  - 三线式表格
  - 标题、正文字体大小
  - 段间距、行距
  - 中括号式列表序号
  - 导航栏指示
  - 网站信息区图标
  - 首页文章列表分割线、最大行数
- 数学公式渲染使用服务端方案[markdown-it-latex2img](https://github.com/MakerGYT/markdown-it-latex2img)

## 同步站点
- 静态站点: [blog.makergyt.com](https://blog.makergyt.com)。使用CI构建部署到[对象存储](https://url.cn/lhzrIgeX)并自动刷新[CDN](https://url.cn/paD7E8lb)，全站[https](https://cloud.tencent.com/product/ssl)。
备用链接: [github.blog.makergyt.com](https://github.blog.makergyt.com)

- 语雀:[「激扬文字」](https://www.yuque.com/books/share/4b51224a-b8b0-4191-8403-d28563f6a6ed?#)，使用webHook触发[云函数](https://url.cn/5Ta8LSR)同步。
- 小程序：「源创智造」,使用[云开发](https://url.cn/HqLHX3x6)完成markdown的同步和渲染，并且接入了一些工具

![图5-1 微信扫一扫预览小程序](https://cdn.blog.makergyt.com/mini/assets/poster-H.png)

## LICENSE
<a rel="license" href="https://creativecommons.org/licenses/by-sa/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://licensebuttons.net/l/by-sa/4.0/88x31.png" /></a><br />
© 2017-2020 MakerGYT. Distributed under the [Creative Commons Attribution 4.0 International License](https://github.com/MakerGYT/blog/blob/master/LICENSE.md).