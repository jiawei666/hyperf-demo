### 项目概述

- 产品名称：`filecoin`
- 介绍：星云FileCoin项目，基于[Hyperf](https://github.com/hyperf/hyperf)

### 运行环境要求

- 系统要求
    - 仅可运行于 `Linux` 和 `Mac` 环境下， `Windows` 下也可以通过 `Docker` 来作为运行环境

- 真机环境
    - `Composer` 1.6+
    - `Mysql` 5.7+
    - `Redis` 4.0+
    - `PHP` 7.2+
    - `Swoole`PHP扩展 4.4+，且关闭`Short Name`
    - `OpenSSL` PHP扩展
    - `JSON` PHP扩展 
    - `PDO` PHP扩展
    - `Redis` PHP扩展

- `Docker`
    - `docker` 19.03.13
    - `docker-compose` 1.27.4

### Docker部署方式

1. 克隆代码到本地
     ```shell script
    git clone git@github.com:jiawei666/filecoin.git
    ```
2. 进入项目目录
    ```shell script
    cd filecoin
    ```

3. 构建`docker-compose`编排容器（包含了`mysql`、`redis`，详情查看`docker-compose.yml`文件）
    ```shell script
    docker-compose build
    ```
4. 启动编排服务
    ```shell script
   # 停止服务执行 docker-compose stop 
    docker-compose start
    ```

5. 进入项目容器
    ```shell script
    docker-compose exec -it filecoin /bin/sh
    ```

6. 配置oauth

    1. 创建秘钥对
    
    ```shell script
   openssl genrsa -out ~/private.key 2048
   openssl rsa -in ~/private.key -pubout -out ~/public.key
    ```
    2. 生成加密秘钥
    
    ```shell script
    php -r 'echo base64_encode(random_bytes(32)), PHP_EOL;'
    ```

7. 配置`.env`文件
    1. 创建`.env`文件
        ```shell script
        cp .env.examplle .env
        ```
    2. 配置`mysql`、`redis`
    3. 将上一步公钥私钥的路径、加密秘钥填写到环境变量`OAUTH_PRIVATE_KEY_PATH`,`OAUTH_PUBLIC_KEY_PATH`,`OAUTH_ENCRYPTION_KEY`中
    4. 其他...

8. 执行数据库迁移
    ```shell script
    php bin/hyperf.php migrate
    ```

9. 服务启动，有两种方法
    ```shell script
    # 1. 常规启动
    php bin/hyperf.php start 
    # 2. 代码热更新启动（开发环境推荐这个方法）
    php bin/hyperf.php server:watch 
    ```

### 真机部署方式

1. 克隆代码到本地
     ```shell script
    git clone git@github.com:jiawei666/filecoin.git
    ```
2. 进入项目目录
    ```shell script
    cd filecoin
    ```

3. 安装依赖包
    ```shell script
    composer install
    ```

4. 配置oauth

    1. 创建秘钥对
    
    ```shell script
   openssl genrsa -out ~/private.key 2048
   openssl rsa -in ~/private.key -pubout -out ~/public.key
    ```
    2. 生成加密秘钥
    
    ```shell script
    php -r 'echo base64_encode(random_bytes(32)), PHP_EOL;'
    ```

5. 配置`.env`文件
    1. 创建`.env`文件
        ```shell script
        cp .env.examplle .env
        ```
    2. 配置`mysql`、`redis`
    3. 将上一步公钥私钥的路径、加密秘钥填写到环境变量`OAUTH_PRIVATE_KEY_PATH`,`OAUTH_PUBLIC_KEY_PATH`,`OAUTH_ENCRYPTION_KEY`中
    4. 其他...

6. 执行数据库迁移
    ```shell script
    php bin/hyperf.php migrate
    ```

7. 服务启动，有两种方法
    ```shell script
    # 1. 常规启动
    php bin/hyperf.php start 
    # 2. 代码热更新启动（开发环境推荐这个方法）
    php bin/hyperf.php server:watch 
    ```