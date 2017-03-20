# laravel-env

用于自动部署系统自动修改env环境变量的命令工具
```php
composer require selden1992/laravel-env
```
添加 
```php
\Env\Commands\EnvCommand::class,  
```
到 Kernel.php 文件里

使用用法
```php
php artisan env:generate=PUSHER_APP_ID 2334324
```

