#!/bin/bash

# Firewall : adding port 1337/tcp and udp
systemctl start firewalld
setenforce 0
firewall-cmd --add-port=1337/tcp --permanent
firewall-cmd --add-port=1337/udp --permanent
firewall-cmd --reload

# copy file to vm and make it run everytime