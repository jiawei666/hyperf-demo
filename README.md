# 介绍

基于[Hyperf](https://github.com/hyperf/hyperf)框架的开箱即用demo，集成了。。。

### 安装步骤

1. 进入根目录

    ```shell script
    cd /path
    ```

2. 安装插件包

    ```shell script
    composer install
    ```
3. 执行数据库迁移
 
    ```shell script
    php bin/hyperf.php migrate
    ```
    
4. 配置oauth

    1. 生成私钥跟公钥（会在~目录下生成`provate.key`私钥跟`public.key`公钥）
    
    ```shell script
   openssl genrsa -out ~/private.key 2048
   openssl rsa -in ~/private.key -pubout -out ~/public.key
    ```
    2. 生成加密秘钥
    
    ```shell script
    php -r 'echo base64_encode(random_bytes(32)), PHP_EOL;'
    ```
   
    3. 分别将公钥私钥的路径、加密秘钥填写到环境变量`OAUTH_PRIVATE_KEY_PATH`,`OAUTH_PUBLIC_KEY_PATH`,`OAUTH_ENCRYPTION_KEY`中
   
5. 生成上传文件夹
    
    ```shell script
    mkdir public/upload
    ```
    
    

    