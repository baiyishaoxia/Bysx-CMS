# Bysx-CMS
Yii 是一个 高性能 的，适用于开发 WEB 2.0 应用的 PHP 框架。
Yii 自带了 丰富的功能，包括 MVC，DAO/ActiveRecord，I18N/L10N，缓存，身份验证和基于角色的访问控制，脚手架，测试等，可显著缩短开发时间。长期更新、开发、维护等工作，只为Yii2.0而生。

# Yii the directory structure
```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
tests                    contains various tests for the advanced application
    codeception/         contains tests developed with Codeception PHP Testing Framework
```
# 安装

1、下载Bysx-CMS源码  [点击此处下载](https://codeload.github.com/baiyishaoxia/Bysx-CMS/zip/master)

2、解压到目录，导入数据库等操作

3、配置web服务器(参见下面)

4、浏览器打开输入刚配置的域名地址访问即可

5、完成

* 配置web服务器(Apache)

```apache
  <VirtualHost *:80>
    ServerName www.BysxCms.com
    DocumentRoot D:/php/Bysx-CMS
    <Directory  "D:/php/Bysx-CMS/">
      Options +Indexes +Includes +FollowSymLinks +MultiViews
      AllowOverride All
      Require local
    </Directory>
  </VirtualHost>
```
* 配置web服务器(Nginx)

```nginx
server {
    server_name  localhost;
    root   /path/php/Bysx-CMS;
    index  index.php index.html index.htm;
    try_files $uri $uri/ /index.php?$args;
    location ~ /api/(?!index.php).*$ {
       rewrite /api/(.*) /api/index.php?r=$1 last;
    }
    location ~ \.php$ {
        fastcgi_pass   127.0.0.1:9000;
        fastcgi_index  index.php;
        fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
        include        fastcgi_params;
    }
}
```
# 帮助
1、使用演示站点 演示站点前台 [进入Bysx-CMS](http://webapp.afu666.xyz)  

2、联系方式 QQ群: 173335823

3、微信

![image](https://github.com/baiyishaoxia/personal-space/raw/option/screenshots/20180527012147.jpg)
