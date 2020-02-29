---
title: koajs Analysis
lang: en
date: 2019-04-29 09:25:03
tags:
 - node
 - koa
categories:
 - study
description: Analysis source code
---
# 1. start
## 1.1 simple http server
```js
// app.js
const http = require('http');
http.createServer(function (req, res) {
  res.end('hello world');
}).listen(3000);
```
## 1.2 express
```js
// app.js
const express = require('express');
const app = express();
app.get('/',function(req, res) {
    res.send('hello express')
});
app.listen(3000);
```
## 1.3 koa
```js
cnpm i koa --save
// app.js
const Koa = require('koa');
const app = new Koa(); //koa2 1
app.use(ctx=>{
  ctx.body = 'hello Koa';
}); // 2
app.listen(3000); // 3
```
## 1.4 Differences and connections
express and koa are both based on http,module of node.
# 2 Source Analysis
## 2.1 Core logic
1. Intercept the request for processing
2. Middleware ecological

## 2.2 Dependencies
```sh
mkdir koa-init && cd koa-init
cnpm i koa --save
```
node_modules
```js
node_modules
├── koa
├── koa-compose
├── koa-convert
└── koa-is-json
// koa/package.json
"koa-compose": "^4.1.0",
"koa-convert": "^1.2.0",
"koa-is-json": "^1.0.0",
```
## 2.3 Contruct
There are only four files as the name implies. 
```js
koa
├── lib
│   ├── application.js 
│   ├── context.js
│   ├── request.js
│   └── response.js
```
### 2.3.1 application.js
#### 2.3.1.1 Operations
1. init

```js
// app.js
const app = new Koa()
// package.json{"main":lib/application.js}
constructor() {
  ...
  this.middleware = [];
  this.context = Object.create(context);
  this.request = Object.create(request);
  this.response = Object.create(response);
  ...
  }
```
2. call middleware

```js
// app.js
app.use(ctx=>{
  ...
})
// application.js
/**
 * @param {Function} fn
 * @api use
 */
use(fn) {
  ...
  this.middleware.push(fn); // core,push 'fn' to middleware array
  return this;
}
```
3. listen

```js
// app.js
app.listen(3000);
// application.js
/**
 * Shorthand for:
 *    http.createServer(app.callback()).listen(...)
 * @param {Mixed} ...
 * @return {Server}
 */
listen(...args) {
  ...
  const server = http.createServer(this.callback());
  return server.listen(...args);
}
```
#### 2.3.1.2 callback
```js
// application.js
callback() {
  const fn = compose(this.middleware); // 1
  ...
  const handleRequest = (req, res) => {
    const ctx = this.createContext(req, res); // 2
    return this.handleRequest(ctx, fn); //3
  };

  return handleRequest;
}
```
1. koa-compose

```js
/**
 * Compose `middleware` returning
 * a fully valid middleware comprised
 * of all those which are passed.
 * 
 * @param {Array} middleware
 * @return {Function}
 */
function compose (middleware) {
  ...
  /**
   * @param {Object} context
   * @return {Promise}
   * @api public
   */
  return function (context, next) {
    ...
    function dispatch (i) {
      ...
      try {
        return Promise.resolve(fn(context, dispatch.bind(null, i + 1))); // core recursive calls
      } catch (err) {
        return Promise.reject(err)
      }
    }
  }
}
```
2. createContext

```js
// application.js
createContext(req, res) {
  const context = Object.create(this.context);
  const request = context.request = Object.create(this.request);
  const response = context.response = Object.create(this.response);
  ...
}
```
3. handleRequest

```js
// application.js
handleRequest(ctx, fnMiddleware) {
  ...
  return fnMiddleware(ctx).then(handleResponse).catch(onerror);
}
```
These objects are already created in the constructor,why?
#### 2.3.1.3 Call relationship
![](https://cdn.blog.makergyt.com/images/study-koajs-structure.jpg)

### 2.3.2 context.js
```js
// context.js
/**
 * Response delegation.
 */
delegate(proto, 'response')
/**
 * Request delegation.
 */
delegate(proto, 'request')
```
### 2.3.3 request.js & response.js
Encapsulate common base methods
# 3 Middleware
## 3.1 Model
![The onion model](https://user-gold-cdn.xitu.io/2018/11/12/16706e6c0db63bd6?imageView2/0/w/1280/h/960/format/webp/ignore-error/1)
## 3.2 Unknown
- ``DEBUG=koa* node --harmony``
- await & async & yield
- callback & promise
- `harmony` params
- generator function & regular function

## 3.3 generator & regular
```js
var hello = function(name) {
  return 'hello'  + name;
}
console.log(hello('James'));
```
```js
var hello = function *(name) {
  return 'hello'  + name;
}
var gen = hello('James');
console.log(gen.next());
```
pause
```js
var hello = function(name) {
  yield 'Your name is ' + name;
  return 'hello'  + name;// terminate execution,done: false
}
```
restart
```js
console.log(gen.next()); // done: false
console.log(gen.next()); // done: true
```
# Reference
<small>[1] koajs.Guide. https://github.com/koajs/koa/blob/master/docs/guide.md [EB/OL] 2018.</small>
<small>[2] koJames Moore.Koajs QuickStart Guide. https://www.knowthen.com/episode-3-koajs-quickstart-guide [EB/OL] 2014.</small>
<small>[3] 贾顺名.koa源码阅读[0]. https://segmentfault.com/a/1190000015724787 [EB/OL] 2018.</small>