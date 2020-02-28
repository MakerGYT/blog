---
title: js 操作方法
date: 2020-02-09 17:49:53
categories: reference
tags: js
description: js string
---
![](https://cdn.blog.makergyt.com/images/reference-js_function-cover.png)

> js获取指定字符前/后的字符串
```js
let str_before = string.split(str)[0];
let str_after = string.split(str)[1];
```

> js修改数组对象的属性名
```js
JSON.parse(JSON.stringify(data1).replace(/title/g, 'name'))    //data为数组，title为修改前，name为修改后
```
```js
let data2=[];
data1.map((currentValue,index,arry)=>{
   data2.push({ 'name': currentValue.title})
})
```
```js
data2 = data1.map(function(item){
  return {
    name: item.title,
  }
});
```

> js取整

```js
parseInt(5.1234) //取整 5
Math.floor(5.1234) // 向下 5
Math.ceil(5.1234) //向上 6
Math.round(5.1234) //四舍五入 5
Math.abs(-1) //绝对值 
```

> js获取索引
```js
// 获取字符串索引
array.indexOf(string)
// 获取对象元素在数组内的索引
array.findIndex(element => element.id === obj.id)
```

> js截取两字符串之间的内容

```js
function subStringOne(text, begin, end) {
  var regex;
  if (end == '\\n')
      regex = RegExp(begin + '(.+)?');
  else
      regex = RegExp(begin + '([.\\s\\S]+?)' + end);
  try {
    console.log(regex)
      return regex.exec(text)[1].trim()
  } catch (err) {
      return null;
  }
};
```
```js
var subFirstStr=data.substring(data.indexOf(first)+first.length,data.length);
var subSecondStr=subFirstStr.substring(0,subFirstStr.indexOf(end));
```
```js
data.match(/before(.+?)end/)[1]
```