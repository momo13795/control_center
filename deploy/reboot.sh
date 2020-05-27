#!/bin/bash
#此脚本用于启动所有的服务
#项目目录
project_code=/Users/mark/HG/docker/control_center
#php-fpm 服务名
service_php_name="php-fpm"

#nginx 服务名
service_nginx_name="webserver"


#进入项目目录
cd ${project_code}

echo '......开始启动2个fpm......'
docker-compose -f docker/compose/php-fpm/docker-compose-all.yml \
--env-file docker/compose/php-fpm/.env \
up \
--build \
--no-deps \
 -d \
 --scale  ${service_php_name}=2

echo '......启动2个fpm成功......'


echo '......开始启动nginx......'
docker-compose -f docker/compose/nginx/docker-compose-all.yml \
--env-file docker/compose/nginx/.env  \
up \
--build --no-deps \
-d ${service_nginx_name}
echo '......启动nginx成功......'
