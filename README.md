  php artisan vendor:publish --force #强制覆盖
### composer.json
  composer.json 添加 files 模块 加载 helps 文件
  ```
  "autoload": {
        "classmap": [
            "database/seeds",
            "database/factories"
        ],
        "psr-4": {
            "App\\": "app/"
        },
        "files":[
            "app/Helps/helps.php"
        ]
    },
    ```
    数据库迁移时注意删除，系统自带的 users 文件 user的model文件
    
   ### config/app.config
```
'providers' 数组添加
 App\Providers\RouteauthServiceProvider::class,
```
   ### 中间件 kernel.php 中添加 
$routeMiddleware
'routeauth' => \App\Http\Middleware\RouteAuth::class,
   
    
    
    