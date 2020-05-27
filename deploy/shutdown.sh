#!/bin/bash
#此脚本用于关闭所有的服务
#项目目录
project_code=/Users/mark/HG/docker/control_center
#php-fpm 服务名
service_php_name="php-fpm"

#nginx 服务名
service_nginx_name="webserver"


#进入项目目录
cd ${project_code}

echo '......开始关闭fpm......'
docker-compose -f docker/compose/php-fpm/docker-compose-all.yml \
--env-file docker/compose/php-fpm/.env \
down

echo '......成功......'


echo '......开始关闭nginx......'
docker-compose -f docker/compose/nginx/docker-compose-all.yml \
--env-file docker/compose/nginx/.env  \
down
echo '.....成功......'
