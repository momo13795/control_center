#!/bin/bash

#############service###########################
echo '关闭nginx'
docker-compose -f docker/compose/nginx/docker-compose-all.yml down

echo '关闭php-fpm'
docker-compose -f docker/compose/php-fpm/docker-compose-all.yml down


echo '关闭mysql'
docker-compose -f docker/compose/mysql/docker-compose-all.yml down

echo '关闭redis'
docker-compose -f docker/compose/redis/docker-compose-all.yml down


echo '关闭zentao'
docker-compose -f docker/compose/zentao/docker-compose-all.yml down

###########service#############################




