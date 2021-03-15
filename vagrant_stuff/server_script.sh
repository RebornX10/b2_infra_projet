#!/bin/bash

# Firewall : adding port 1337/tcp and udp
systemctl start firewalld
setenforce 0
firewall-cmd --add-port=1337/tcp --permanent
firewall-cmd --add-port=1337/udp --permanent
firewall-cmd --reload

# install vim
sudo yum install vim -y
sudo yum install wget -y 
# "server" user creation
useradd server
echo 'server' | passwd --stdin server

# creation of the server directory
mkdir /home/server

# set home for the server
usermod -d /home/server server

# downloads the server's JAR
wget https://launcher.mojang.com/v1/objects/1b557e7b033b583cd9f66746b7a9ab1ec1673ced/server.jar
mkdir /home/server/binary
mv server.jar home/server/binary

# disabling SELinux
setenforce 0

# changing ownership of the directories
chown /home/server server:server
chmod 510 /home/server
