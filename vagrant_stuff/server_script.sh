#!/bin/bash

# Firewall : adding port 1337/tcp and udp
systemctl start firewalld
setenforce 0
firewall-cmd --add-port=1337/tcp --permanent
firewall-cmd --add-port=22/tcp --permanent
firewall-cmd --add-port=22/udp --permanent
firewall-cmd --add-port=1337/udp --permanent
firewall-cmd --add-port=8080/udp --permanent
firewall-cmd --add-port=8080/tcp --permament
firewall-cmd --reload

# install vim, wget & Java
sudo yum install vim -y
sudo yum install wget -y
sudo yum install java-11-openjdk -y

# downloads the server's JAR
wget https://cdn.getbukkit.org/spigot/spigot-1.16.5.jar
mv spigot-1.16.5.jar server.jar
chmod +x /home/vagrant/server.jar

# disabling SELinux
setenforce 0

# making the launching script:
cat > /home/vagrant/start.sh <<EOF
#!/bin/bash

java -jar -Xmx1G /home/vagrant/server.jar
EOF
sudo chown vagrant start.sh
chmod 701 /home/vagrant/start.sh

touch /home/vagrant/eula.txt
cat > /home/vagrant/eula.txt <<EOF
#By changing the setting below to TRUE you are indicating your agreement to our EULA (https://account.mojang.com/documents/minecraft_eula).
#Thu Mar 25 15:15:57 UTC 2021
eula=true
EOF

# Grafana installation
# sudo ARCH=amd64 GCLOUD_STACK_ID="184246" GCLOUD_API_KEY="eyJrIjoiZTFhMzJhZDkwYmUwZTg5YTkwNTgwMjNhNjIwNGFlZmZhNjY3MjM0YSIsIm4iOiJiZHhnYW5nLWVhc3lzdGFydC1wcm9tLXB1Ymxpc2hlciIsImlkIjo0NzYzMzd9" /bin/sh -c "$(curl -fsSL https://raw.githubusercontent.com/grafana/agent/release/production/grafanacloud-install.sh)"

# sudo systemctl restart grafana-agent.service

# remote konsole/admin setup
wget https://github.com/mesacarlos/WebConsole/releases/download/v2.1/WebConsole-2.1.jar
#
mkdir /home/vagrant/plugins
sudo mv WebConsole-2.1.jar /home/vagrant/plugins/
chown vagrant:vagrant /home/vagrant/plugins
##
mkdir /home/vagrant/plugins/WebConsole
cat > /home/vagrant/plugins/WebConsole/config.yml <<EOF
useSSL: false
StoreType: JKS
KeyStore: plugins/WebConsole/keystore.jks
StorePassword: storepassword
KeyPassword: keypassword
host: 0.0.0.0
port: 8080
language: en
passwords:
  admin:
    user1: password
  viewer: {}
EOF

# changing the ownership of the files in /home/vagrant
sudo chown -R vagrant:vagrant /home/vagrant/
echo "SETUP COMPLETE"
echo "   "
echo "   "
echo "GOOD LUCK HAVE FUN"
