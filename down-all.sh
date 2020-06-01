#!/bin/bash

#############service###########################
echo '启动nginx'
docker-compose -f docker/compose/nginx/docker-compose-all.yml down

echo '启动php-fpm'
docker-compose -f docker/compose/php-fpm/docker-compose-all.yml down

echo '启动jenkins'
docker-compose -f docker/compose/jenkins/docker-compose-all.yml down

echo '启动mysql'
docker-compose -f docker/compose/mysql/docker-compose-all.yml down

echo '启动redis'
docker-compose -f docker/compose/redis/docker-compose-all.yml down

echo '启动nginx-env'
docker-compose -f docker/compose/nginx-env/docker-compose-all.yml down

echo '启动zentao'
docker-compose -f docker/compose/zentao/docker-compose-all.yml down

###########service#############################




