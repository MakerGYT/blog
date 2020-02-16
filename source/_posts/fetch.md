---
title: fetch
date: 2019-05-10 17:01:10
tags:
  - node
  - react
  - api
description: Design a simple front-end and back-end response mechanism
---
# 0 Prerequisite
- nodejs
- cnpm
- create-react-app

# 1 get
## 1.1 front-end
```sh
create-react-app react-test
touch src/config.js
```
```js
// src/config.js
module.exports = {
  basicUrl: "https://idpjtg-8080-hkyibe.dev.ide.live"
}
```
```js
// src/App.js
import React, { Component } from 'react';
import { basicUrl } from './config';
class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      error: null,
      isLoaded: false,
      items: []
    };
  }
  componentDidMount() {
    fetch(basicUrl)
      .then(res => res.json())
      .then(
        (result) => {
          this.setState({
            result: JSON.stringify(result),
            isLoaded: true,
          });
        },
        // Note: it's important to handle errors here
        // instead of a catch() block so that we don't swallow
        // exceptions from actual bugs in components.
        (error) => {
          this.setState({
            isLoaded: true,
            error
          });
        }
      )
  }
  render() {
    const { error, isLoaded, result } = this.state;
    if (error) {
      return <div>Error: {error.message}</div>;
    } else if (!isLoaded) {
      return <div>Loading...</div>;
    } else {
      return (
        <div>{result}</div>
      );
    }
  }
}
export default App;
```
## 1.2 back-end
```sh
$ mkdir express-test && cd express-test
$ cnpm init -y
$ touch index.js
$ cnpm i express --save
```
```js
// package.json
"scripts": {
    "dev": "node ."
  },
```
```js
// index.js
const express = require('express');
const app = express()
var httpPort = process.env.PORT || 8080;
app.get('/', function(req, res) {
  var data = {
    data: 'test'
  }
  res.send(data);
});
app.listen(httpPort);
```
## 1.3 run
```sh
$ curl curl https://idpjtg-8080-hkyibe.dev.ide.live
{"data":"test"} // ok
$ cd react-test
$ npm run start
# browser
Error: Failed to fetch
```
### 1.3.1 error
``Access to fetch at 'https://idpjtg-8080-hkyibe.dev.ide.live/' from origin 'https://idpjtg-3000-icqklp.dev.ide.live' has been blocked by CORS policy: No 'Access-Control-Allow-Origin' header is present on the requested resource. If an opaque response serves your needs, set the request's mode to 'no-cors' to fetch the resource with CORS disabled.``

### 1.3.2 check
use mock => [data](https://easy-mock.com/mock/5cd54a04bcc93766c5928798/#!method=get)
>ok 

It is proved that it is may not a front-end problem.
```js
// express/index,js
app.get('/', function(req, res) {
  ...
  console.log(req)  
});
```
reload react-test, express-test console
>IncomingMessage{...}

It is proved that cross-site requests can be initiated normally, but the returned results are intercepted maybe by browsers.

![](https://mdn.mozillademos.org/files/14295/CORS_principle.png)
### 1.3.3 fix
```js
// express/indx.js
var allowCrossDomain = function (req, res, next) {
 res.header('Access-Control-Allow-Origin', '*');
 next();
};
app.use(allowCrossDomain);
```
>ok

Q: fetch default mode is same-origin?
# 2 post
## 2.1 front-end
```js
// react-test/src/App.js
...
getFetch() {
  fetch(basicUrl)
    .then(res => res.json())
    .then(
      (result) => {
        this.setState({
          result: JSON.stringify(result),
        });
      },
      (error) => {
        this.setState({
          error
        });
      }
    )
}
postFetch() {
  var postData = {
    data: new Date()
  }
  console.log(JSON.stringify(postData));
  fetch(basicUrl, {
    method: 'POST',
    headers: {
      "Content-Type": "application/json",
      // "Content-Type": "application/x-www-form-urlencoded",
    },
    body: JSON.stringify(postData)
  })
    .then(res => res.json())
    .then(
      (result) => {
        this.setState({
          result: JSON.stringify(result),
        });
      },
      (error) => {
        this.setState({
          error
        });
      }
    )
}
render() {
  const { error, result } = this.state;
  const btn = (
    <div>
      <button onClick={() => this.getFetch()}>GET</button>
      <br />
      <button onClick={() => this.postFetch()}>POST</button>
    </div>);
  var content = (
    <div></div>
  );
  if (error) {
    content = <div>Error: {error.message}</div>;
  } else {
    content = <div>{result}</div>;
  }
  return (
    <div>{btn}{content}</div>
  );
}
...
```
## 2.2 back-end
```js
// express-test/index.js
const bodyParser = require('body-parser');
var allowCrossDomain = function (req, res, next) {
 res.header('Access-Control-Allow-Origin', '*');
 res.header('Access-Control-Allow-Headers', 'Content-Type');
 next();
};
app.use(allowCrossDomain);
app.use(bodyParser.json());
app.post('/', function(req, res) {
  var backdata = {
    data: 'test' + req.body.data
  }
  res.send(backdata);
});
```
Q: body-parser is not installed?
# 3 fetch
## 3.1 interfaces
## 3.2 cors policy
## 3.3 fetch polyfill
# 4 mock
## 4.1 DXY F2E
[api mocker](http://api-mocker.com)
## 4.2 Easy Mock
[Easy Mock](https://easy-mock.com)
## 4.3 nuysoft Alibaba Inc.
[mockjs](http://mockjs.com/)
# Reference
<small>[1] Mozilla.Fetch API[EB/OL].https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API, 2019.</small>
<small>[2] Mozilla.HTTP访问控制（CORS）[EB/OL].https://developer.mozilla.org/zh-CN/docs/Web/HTTP/Access_control_CORS, 2019.</small>
<small>[3] 赵客缦胡缨v吴钩霜雪明.ajax和axios、fetch的区别[EB/OL].https://www.jianshu.com/p/8bc48f8fde75, 2018.</small>