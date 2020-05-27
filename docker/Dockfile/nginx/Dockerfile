FROM nginx:alpine

LABEL maintainer="juccexu" email="juccexu@gmail.com"

#设定工作目录
WORKDIR /var/www
#创建指定用户 apline 镜像用户组
RUN addgroup -g 1000 -S www
RUN adduser -u 1000 -D -S -G  www www



