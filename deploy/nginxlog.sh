#!/bin/bash
#此脚本用于自动分割Nginx的日志，包括access.log和error.log
#每天00:00执行此脚本 将前一天的access.log重命名为access-xxxx-xx-xx.log格式，并重新打开日志文件
#Nginx日志文件所在目录
LOGS_PATH=/usr/local/var/log/nginx
#linux 昨天日期
#YESTERDAY=$(date -d "yesterdaxy" +%Y%m%d)
#osx 昨天日期
YESTERDAY=$(date -v -1d +%Y-%m-%d)

#分割日志
mv ${LOGS_PATH}/access.log ${LOGS_PATH}/access_${YESTERDAY}.log
mv ${LOGS_PATH}/error.log ${LOGS_PATH}/error_${YESTERDAY}.log

#向Nginx主进程发送USR1信号，重新打开日志文件
#kill  -USR1 `ps axu | grep "nginx: master process" | grep -v grep | awk '{print $2}'`

#另外一种向Nginx主进程发送USR1信号，重新打开日志文件
#获取pid文件路径
PID=/usr/local/var/run/nginx.pid
#向Nginx主进程发送USR1信号，重新打开日志文件
kill -USR1 `cat ${PID}`

#删除7天前的日志
cd ${LOGS_PATH}
find . -mtime +7 -name "*20[1-9][3-9]*" | xargs rm -f