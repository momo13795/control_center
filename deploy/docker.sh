#!/bin/bash
#docker docker-compose 创建
curl -sSL https://get.daocloud.io/docker | sh
sudo usermod -aG docker ${USER}
sudo curl -L https://github.com/docker/compose/releases/download/1.25.5/docker-compose-`uname -s`-`uname -m` -o /usr/bin/docker-compose
sudo chmod +x /usr/bin/docker-compose
sudo systemctl enable docker
sudo systemctl start docker

