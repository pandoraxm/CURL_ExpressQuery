# AJAX+CURL 实现快递查询
> 本项目是调用`快递100`首页的查询API,运用ajax和curl实现快递查询的功能

# 1 分析
## 1.1 打开[快递100首页](http://www.kuaidi100.com),在搜索框输入一个快递单号例如111111。
打开chrome调试工具,可以看到,当用户输入单号之后,会有一条`autoComNum?text=111111`的请求。点击进去查看详细信息可以看到真实的请求地址是 http://www.kuaidi100.com/autonumber/autoComNum?text=11111 ，请求方式是POST,传递了一个参数text=[快递单号],返回值是一串json。json字符串里面有一个comCode(快递公司)。这个就是我们想要的数据。
![快递公司](http://wx1.sinaimg.cn/large/658dc60bgy1fhtpv7426fg211a0i9tfg.gif)
## 1.2 选择一个自动识别的快递公司,然后点击查询
可以看到有一个query?type=***的一个请求,查看详情。可以看到真实请求地址 http://www.kuaidi100.com/query?type=kuaijiesudi&postid=111111&id=1&valicode=&temp=0.4196015551034187 ，请求方式是GET，返回值是一串字符串,传递了5个参数,而真实有效的参数是前面两个,type=[快递公司]&postid=[快递单号],对比一下页面信息,这就是我们要的运单详情了。
![订单详情](http://wx1.sinaimg.cn/large/658dc60bgy1fhtpva2d6eg211a0i9b29.gif)

# 2 程序实现
前台使用jquery ajax将快递单号传递到后台,后台查询到结果返回到前台。

而调用快递100 API部分，则用CURL实现。

前台页面以及AJAX部分，请看index.php

CURL部分请看search.php

# 3 实现效果图
## 3.1 单号错误
![单号错误](http://wx3.sinaimg.cn/large/658dc60bgy1fhtow4z5sdg211a0i9tzs.gif)
## 3.2 正常
![正常](http://wx4.sinaimg.cn/large/658dc60bgy1fhtow7cpfmg211a0i9nog.gif)
## 3.3 没有查询到记录
![没有记录](http://wx2.sinaimg.cn/large/658dc60bgy1fhtowbjsf6g211a0i9kjl.gif)

# 4 查询结果
## 4.1 电脑版
![电脑](http://wx4.sinaimg.cn/mw690/658dc60bgy1fhtqz3adrjj210y0wokjn.jpg)
## 4.2 手机版
![手机](http://wx4.sinaimg.cn/mw690/658dc60bgy1fhtqw5ztfgj20ai18x7wh.jpg)

# 5 其他说明
注意,如果使用https请求时,本机没有安装ssl证书的话,会有报错。
请务必加上
```
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
```

<a target="_blank" href="https://www.bear777.com/search">项目演示地址</a>

[github地址](https://github.com/pandoraxm/CURL_ExpressQuery)

(不要脸的打个广告:) )个人网站https://www.bear777.com
