#!/bin/bash
#全局环境变量配置
source ./.env
#创建指定网络
docker network create ${NETWORK}


#############service 启动###########################
echo '启动nginx'
docker-compose -f docker/compose/nginx/docker-compose-all.yml up -d

echo '启动php-fpm'
docker-compose -f docker/compose/php-fpm/docker-compose-all.yml up --build --no-deps -d --scale php-fpm=2

echo '启动mysql'
docker-compose -f docker/compose/mysql/docker-compose-all.yml up -d

echo '启动redis'
docker-compose -f docker/compose/redis/docker-compose-all.yml up -d


echo '启动zentao'
docker-compose -f docker/compose/zentao/docker-compose-all.yml up -d

###########service 启动#############################




#判断zentao(每次重新启动需删除此文件)
if [ ! -f ${PROJECT_ROOT}/configs/zentao/data/zbox/app/zentao/www/upgrade.php ];then
echo "文件不存在，不操作"
else
rm -rf ${PROJECT_ROOT}/configs/zentao/data/zbox/app/zentao/www/upgrade.php
fi

##解决一些log文件权限的问题
if [ ! $PROJECT_ENV = "local" ];then
    if [[ $EUID -ne 0 ]];
    then
        echo '非root'
        sudo chmod -R 777 ${PROJECT_ROOT}
    else
        echo 'root'
        chmod -R 777 ${PROJECT_ROOT}
    fi
fi



