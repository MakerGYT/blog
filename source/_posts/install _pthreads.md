---
title: 安装pthreads多线程扩展记录
date: 2017-11-16 19:37:04
tags:
  - php
categories: record
description: 仅作记录
---
# 1 当前环境
+ WampServer Version 3.1.0 64bit
+ PHP 5.6.31
+ windows 10 pro 1703
+ [pthreads-2.0.9-5.6-ts-vc11-x64](http://windows.php.net/downloads/pecl/releases/pthreads/2.0.9/)
5.6对应php version,vc11代表是Visual Studio 2010 compiler编译器编译的(暂无需考虑)，x64代表wamp平台。

# 2 安装
只用到下载包内的**pthreadVC2.dll**和**php_pthreads.dll**
```sh
# php.ini
extension=php_pthreads.dll //加在最后一行
cp pthreadVC2.dll *%wamp%/bin/php/%php5.6.31%*和*%wamp%/bin/apache/%apache2.4.27*
cp php_pthreads.dll %wamp%/bin/php/bin/php/%php5.6.31%/ext
```
重启wamp所有服务。

# 3 测试

```php
// AsyncOperation.php
<?php 
class AsyncOperation extends Thread { 
  public function __construct($arg){ 
    $this->arg = $arg; 
  } 
  
  public function run(){ 
    if($this->arg){ 
      printf("Hello %s\n", $this->arg); 
    } 
  } 
} 
$thread = new AsyncOperation("World"); 
if($thread->start()) 
  $thread->join(); 
?> 
php AsyncOperation.php
HelloWorld #则配置成功
```
# 4 实验
+ 目的：检测多线程和普通方式的时间消耗
+ 例程：for循环爬取百度

```php
<?php  
  class test_thread_run extends Thread   
  {  
      public $url;  
      public $data;  
  
      public function __construct($url)  
      {  
          $this->url = $url;  
      }  
  
      public function run()  
      {  
          if(($url = $this->url))  
          {  
              $this->data = model_http_curl_get($url);  
          }  
      }  
  }  
  
  function model_thread_result_get($urls_array)   
  {  
      foreach ($urls_array as $key => $value)   
      {  
          $thread_array[$key] = new test_thread_run($value["url"]);  
          $thread_array[$key]->start();  
      }  
  
      foreach ($thread_array as $thread_array_key => $thread_array_value)   
      {  
          while($thread_array[$thread_array_key]->isRunning())  
          {  
              usleep(10);  
          }  
          if($thread_array[$thread_array_key]->join())  
          {  
              $variable_data[$thread_array_key] = $thread_array[$thread_array_key]->data;  
          }  
      }  
      return $variable_data;  
  }  
  
  function model_http_curl_get($url,$userAgent="")   
  {  
      $userAgent = $userAgent ? $userAgent : 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.2)';   
      $curl = curl_init();  
      curl_setopt($curl, CURLOPT_URL, $url);  
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  
      curl_setopt($curl, CURLOPT_TIMEOUT, 5);  
      curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);  
      $result = curl_exec($curl);  
      curl_close($curl);  
      return $result;  
  }  
  
  for ($i=0; $i < 10; $i++)   
  {   
      $urls_array[] = array("name" => "baidu", "url" => "http://www.baidu.com/s?wd=".mt_rand(10000,20000));  
  }  
  
  $t = microtime(true);  
  $result = model_thread_result_get($urls_array);  
  $e = microtime(true);  
  echo "多线程：".($e-$t)."\n";  
  
  $t = microtime(true);  
  foreach ($urls_array as $key => $value)   
  {  
      $result_new[$key] = model_http_curl_get($value["url"]);  
  }  
  $e = microtime(true);  
  echo "For循环：".($e-$t)."\n";  
?>
```
输出
```sh
多线程：5.1022920608521 For循环：20.272159099579 #具体时间不一定相同
```