#!/bin/bash
#全局环境变量配置
source ./.env


#############service 启动###########################
echo '启动nginx'
docker-compose -f docker/compose/nginx/docker-compose-all.yml up -d

echo '启动php-fpm'
docker-compose -f docker/compose/php-fpm/docker-compose-all.yml up --build --no-deps -d --scale php-fpm=2

echo '启动jenkins'
docker-compose -f docker/compose/jenkins/docker-compose.yml up -d

echo '启动mysql'
docker-compose -f docker/compose/mysql/docker-compose.yml up -d

echo '启动redis'
docker-compose -f docker/compose/redis/docker-compose.yml up -d

echo '启动zentao'
docker-compose -f docker/compose/zentao/docker-compose.yml up -d

###########service 启动#############################




#判断zentao(每次重新启动需删除此文件)
if [ ! -f ${PROJECT_ROOT}/configs/zentao/data/zbox/app/zentao/www/upgrade.php ];then
echo "文件不存在，不操作"
else
rm -rf ${PROJECT_ROOT}/configs/zentao/data/zbox/app/zentao/www/upgrade.php
fi


